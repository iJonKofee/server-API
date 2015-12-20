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
			foreach ($userEnum->getAll() as $name => $value) {
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
						//Костыль, костылёк из-за "CoreException: For the role 'user' access denied to controller 'auth' in action 'logout'"
						'logout'
					],
				'index' =>
					[
						'index'
					]
			];
			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Grant access to public areas to both users and guests
			foreach ($publicResources as $resource => $actions) {
				foreach ($actions as $action){
					$acl->allow('*', $resource, $action);
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

        // Проверяем, установлена ли в сессии переменная "auth" для определения активной роли.
        $auth = $this->session->has('auth_type');

        //Если токена нет, но перенаправляем на страницу авторизации
        if (!$auth)
        {
        	return $this->_forwardToLogin();
        }

        $role = $this->session->get('auth_type')['type'];

        // Проверяем, имеет ли данная роль доступ к контроллеру (ресурсу)
        $allowed = $acl->isAllowed($role, $controller, $action);

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