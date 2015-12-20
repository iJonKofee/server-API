<?php

class AuthController extends Core_Controller_Abstract
{

	public function logoutAction()
	{
		$this->session->destroy();

		return $this->response->redirect();
	}

    public function loginAction()
    {
    	if ($this->session->get('user'))
    	{
    		$this->response->redirect();
    	}

    	$this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

    	if (!$this->request->isPost())
    	{
			return ;
    	}

    	// Получение переменных методом POST
    	$userName = $this->getPost('username');
    	$password = $this->getPost('password');
    	
    	$mng = Core_UserCenter_Manager::getInstance();

    	if ($mng->authorization($userName, $password))
    	{
	    	$this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_MAIN_LAYOUT);
    		return $this->response->redirect();
    	}
    }
}