<?php

class Core_UserCenter_Security extends Phalcon\Mvc\User\Plugin
{

	private function _getAcl()
	{
		//используется только при дебаге, чтобы всегда ACL был новый
		$this->persistent->destroy();

		if (!isset($this->persistent->acl))
		{
			$userEnum = Core_UserCenter_Enum::getInstance();

			$acl = new Phalcon\Acl\Adapter\Memory();
			$acl->setDefaultAction(Phalcon\Acl::DENY);

			//Регистрация роллей из Core_UserCenter_Enum
			foreach ($userEnum->getAll() as $name => $value) 
			{
				$acl->addRole($name);
			}

			//Public area resources
			$publicResources = [
				'test' =>
					[
						'index'
					],
				'auth' =>
					[
						'login',
					]
			];
			
			$privateResources = [
			    'test' =>
			    [
			        'bla',
			        'getlist'
			    ],
			    'index' =>
			    [
			        'index'
			    ],
			    'auth' =>
			    [
			        'logout'
			    ]
			];
			
			foreach (array_merge_recursive($privateResources, $publicResources) as $resource => $actions) 
			{
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}
			
			//Grant access to public areas to both users and guests
			foreach ($publicResources as $resource => $actions) 
			{
				foreach ($actions as $action)
				{
					$acl->allow('*', $resource, $action);
				}
			}
			
			foreach ($privateResources as $resource => $actions) 
			{
				foreach ($actions as $action)
				{
					$acl->allow($userEnum->getName($userEnum::ADMIN), $resource, $action);
				}
			}

			//Разрешаем для группы ADMIN ВЕЗДЕ доступ
			$acl->allow($userEnum->getName($userEnum::ADMIN), '*', '*');

			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
		}
		return $this->persistent->acl;
	}

	public function beforeExecuteRoute(Phalcon\Events\Event $event, Phalcon\Mvc\Dispatcher $dispatcher)
    {
    	$userEnum = Core_UserCenter_Enum::getInstance();

        // Получаем активные контроллер и действие от диспетчера
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        // Получаем список ACL
        $acl = $this->_getAcl();
        if ($acl->isAllowed($userEnum->getName($userEnum::GUEST), $controller, $action)) return TRUE;

        // Проверяем, установлен ли в сессии user
        $isAuth = $this->session->has('user');
        
        //Если не авторизован, но перенаправляем на страницу авторизации
        if (!$isAuth)
        {
        	return $this->_forwardToLogin();
        }
        
        $user = $this->session->get('user');

        $role = $user->type;
        
        // Проверяем, имеет ли данная роль доступ к контроллеру (ресурсу)
        $allowed = $acl->isAllowed($userEnum->getName($role), $controller, $action);

        if ($allowed != Phalcon\Acl::ALLOW)
        {
            throw new Core_UserCenter_Exception_AccessDenied($controller, $action, $role);
        }
    }

    private function _forwardToLogin()
    {
		// Если доступа нет, перенаправляем его на контроллер "auth".
		 // HTTP редирект
        $this->response->redirect('login');

		// Возвращая "false" мы приказываем диспетчеру прекратить текущую операцию
		return FALSE;
    }

}