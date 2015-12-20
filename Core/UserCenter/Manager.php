<?php

class Core_UserCenter_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function authorization($login, $password)
    {
        /*@var Core_UserCenter_Table $tbl*/
        $tbl = $this->getTable();
        
        /*@var Core_UserCenter_Table $rowUser*/
        $rowUser = $tbl::findFirst("login = '$login'");
    
        if (!$rowUser)
        {
            return FALSE;
        }
    
        if ($rowUser->getPassword() != $password)
        {
            return FALSE;
        }
    
        $this->_writeToSession($rowUser);
    
        return TRUE;
    }

    /**
     * Вытягивает из сессию row текущего пользователя 
     * @throws Core_UserCenter_Exception_NoAccount
     * @return Core_UserCenter_Table
     */
    public function getAccount()
    {
        /*$var Core_UserCenter_Table $rowUser*/
    	$rowUser = $this->session->user;

    	if (!$rowUser)
    	{
    		throw new Core_UserCenter_Exception_NoAccount();
    	}
    	
    	return $rowUser;
    }
    
    /**
     * Сохраняет в сессию row текущего аккаунта
     * @param Core_UserCenter_Table $user
     */
    private function _writeToSession(Core_UserCenter_Table $user)
    {
        $this->session->set('user', $user);
    }

}