<?php

class Core_UserCenter_Manager extends Core_Model_Manager
{

    use Core_Singleton;

    public function getAccount()
    {
    	$user = $this->session->user;

    	if (!$user)
    	{
    		throw new Core_UserCenter_Exception_NoAccount();
    	}

    	return $user;
    }

}