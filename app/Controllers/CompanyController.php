<?php

class CompanyController extends Core_Controller_Abstract
{

    public function manageAction()
    {
        $this->view->rows = $this->getTable()->find();
        
    }
    
    public function addAction()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        
        $tblCategoty = Category_Company_Table::getInstance();
        
        $rowsCategory = $tblCategoty->find();
        
        $this->view->rowsCategory = $rowsCategory;
        
        if (!$this->request->isPost())
        {
            return ;
        }
        
        $this->view->disable();
        
        // Получение переменных методом POST
        $name = $this->getPost('name');
        $logo = $this->getPost('logo');
        $categoryId = $this->getPost('category_id');
        
        try 
        {
            $row = Company_Manager::getInstance()->add($name, $logo, $categoryId);
        }
        catch (Core_Db_Table_Exception $e)
        {
            //Заглушка
            throw new Core_Db_Table_Exception($e->getMessage());
        }
        
        //Меняем id категории на название
        $row->categoryId($row->Category_Company_Table->name);
        
        echo json_encode($row->toArray());
    }
    
    public function deleteAction()
    {
        $this->view->disable();
        
        $id = $this->getParam('id');
        
        $row = $this->getTable()->find($id);
        
        $row->delete();
    }
    
}