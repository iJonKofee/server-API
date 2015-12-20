<?php

class TestController extends Core_Controller_Abstract
{

	public function indexAction()
	{
		$this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
	}
}