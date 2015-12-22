<?php

date_default_timezone_set('Europe/Moscow');

try
{

    //Read the configuration
    $config = new Phalcon\Config\Adapter\Ini('../app/Config/config.ini');
    //Register an autoloader
    $loader = new Phalcon\Loader();
    $loader->registerDirs(
        array(
            '../',
            '../' . $config->application->controllersDir,
            '../' . $config->application->modelsDir,
        )
    );
	$loader->register();
    //Create a DI
    $di = new Phalcon\Di\FactoryDefault();
    //Определяем кастомные маршруты
    $di->set('router', function () use ($di)
    {
    	$router = new Phalcon\Mvc\Router();

    	$router->add(
    		"/login",
    		array(
    			"controller" => "auth",
    			"action"     => "login"
    		)
    	);
    	$router->add(
    		"/logout",
    		array(
    			"controller" => "auth",
    			"action"     => "logout"
    		)
    	);

    	return $router;
    });

    // Коннект к базе данных создается соответственно параметрам в конфигурационном файле
    $di->set('db', function() use ($config)
    {
        return new Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname,
            "options" => [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]
        ));
    });

    //Отлавливаем авторизацию
    $di->set('dispatcher', function() use ($di)
    {
    	// Получаем стандартный менеджер событий с помощью DI
    	$eventsManager = $di->getShared('eventsManager');
    	// Инстанцируем плагин безопасности
    	$security = new Core_UserCenter_Security($di);
    	// Плагин безопасности слушает события, инициированные диспетчером
    	$eventsManager->attach('dispatch', $security);
    	$dispatcher = new Phalcon\Mvc\Dispatcher();
    	// Связываем менеджер событий с диспетчером
    	$dispatcher->setEventsManager($eventsManager);
    	return $dispatcher;
    });

    //Setting up the view component
    $di->set('view', function() use ($config)
    {
        $view = new Phalcon\Mvc\View();
        $view->setViewsDir('../' . $config->application->viewsDir . $config->application->theme);
        return $view;
    });

    // Сессии запустятся один раз, при первом обращении к объекту
    $di->setShared('session', function () {
    	$session = new Phalcon\Session\Adapter\Files();
    	$session->start();
    	return $session;
    });

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);
    echo $application->handle()->getContent();
}
catch(\Phalcon\Exception $e)
{
     echo "PhalconException: ", $e;
}
catch (Core_Exception $e)
{
	echo "CoreException: ", $e->getMessage();
}