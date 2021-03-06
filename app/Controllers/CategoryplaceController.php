<?php

class CategoryPlaceController extends Core_Controller_Abstract
{

    public function manageAction()
    {
        $this->view->rows = Category_Place_Table::getInstance()->find();
        
    }
    
    public function addAction()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        if (!$this->request->isPost())
        {
            return ;
        }
        
        $this->view->disable();
        
        // Получение переменных методом POST
        $name = $this->getPost('name');
        
        try 
        {
            $row = Category_Place_Manager::getInstance()->add($name);
        }
        catch (Core_Db_Table_Exception $e)
        {
            //Заглушка
            throw new Core_Db_Table_Exception($e->getMessage());
        }
        
        echo json_encode($row->toArray());
    }
    
    public function editAction()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        $id = $this->getParam('id');
        
        $row = Category_Place_Table::getInstance()->findFirst($id);
        
        $this->view->row = $row;
        
        if (!$this->request->isPost())
        {
            return ;
        }
        
        $this->view->disable();
        
        // Получение переменных методом POST
        $name = $this->getPost('name');
        
        $row
            ->name($name)
            ->save()
        ;
        
        echo json_encode($row->toArray());
    }
    
    public function deleteAction()
    {
        $this->view->disable();
        
        $id = $this->getParam('id');
        
        $row = Category_Place_Table::getInstance()->find($id);
        
        $row->delete();
    }
    
}