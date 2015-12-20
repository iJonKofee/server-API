<?php

class AuthController extends Core_Controller_Abstract
{

	private function _authorization($login, $password)
	{
		/*@var $rowUser Core_UserCenter_Table*/
		$rowUser = Core_UserCenter_Table::findFirst("login = '$login'");

		if (!$rowUser)
		{
			return FALSE;
		}

		if ($rowUser->password != $password)
		{
			return FALSE;
		}

		$this->_writeHash($rowUser);
		$this->_writeToSession($rowUser);

		return TRUE;
	}

	private function _writeHash(Core_UserCenter_Table $user)
	{
		$hash = $this->_generateHash();

		$user->hash = $hash;
		$user->save();

		return $user;
	}

	private function _generateHash()
	{
		return md5(rand(100000, 999999));
	}

	private function _writeToSession(Core_UserCenter_Table $user)
	{
		$this->session->set('auth_hash', array(
			'hash' => $user->hash
		));

		$this->session->set('auth_type', array(
			'type' => $user->type,
		));
	}

	public function logoutAction()
	{
		$this->session->destroy();

		return $this->response->redirect();
	}

    public function loginAction()
    {
    	if ($this->session->get('auth_hash'))
    	{
    		$this->response->redirect();
    	}

    	$this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

    	if (!$this->request->isPost())
    	{
			return ;
    	}

    	// Получение переменных методом POST
    	$userName = $this->request->getPost('username');
    	$password = $this->request->getPost('password');

    	if ($this->_authorization($userName, $password))
    	{
	    	$this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT);
    		return $this->response->redirect();
    	}
    }
}