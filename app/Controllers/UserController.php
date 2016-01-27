<?php

class UserController extends Core_Controller_Abstract
{

    public function manageAction()
    {
        $this->view->rows = (new Core_UserCenter_Table)->find();
    }
    
    public function deleteAction()
    {
        $this->view->disable();
        
        $id = $this->getParam('id');
        
        $row = Core_UserCenter_Table::getInstance()->find($id);
        
        $row->delete();
    }

}