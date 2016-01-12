<?php

class CategoryDishController extends Core_Controller_Abstract
{

    public function manageAction()
    {
        $rows           = Category_Dish_Table::getInstance()->find();
        $meanPrice      = array();
        $meanWeight     = array();
        
        foreach ($rows as $key => $row)
        {
            $dishs = $row->Dish_Table;
            
            if (!$dishs->toArray()) continue;
            
            $sumWeight = 0;
            $sumPrice  = 0;
            
            foreach ($dishs as $dish)
            {
                $sumPrice  += $dish->price();
                $sumWeight += $dish->weight();
            }
            
            $meanPrice[$row->id()]  = round($sumPrice / count($dishs), 2);
            $meanWeight[$row->id()] = round($sumWeight / count($dishs), 2);
        }
        
        $this->view->meanPrice      = $meanPrice;
        $this->view->meanWeight     = $meanWeight;
        $this->view->rows           = $rows;
        
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
        $imageId = $this->getPost('image_id');
        
        try 
        {
            $row = Category_Dish_Manager::getInstance()->add($name, $imageId);
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
        
        $row = Category_Dish_Table::getInstance()->findFirst($id);
        
        $this->view->row = $row;
        
        if (!$this->request->isPost())
        {
            return ;
        }
        
        $this->view->disable();
        
        // Получение переменных методом POST
        $name = $this->getPost('name');
        $imageId = $this->getPost('image_id');
        
        $row
            ->name($name)
            ->imageId($imageId)
            ->save()
        ;
        
        echo json_encode($row->toArray());
    }
    
    public function deleteAction()
    {
        $this->view->disable();
        
        $id = $this->getParam('id');
        
        $row = Category_Dish_Table::getInstance()->find($id);
        
        $row->delete();
    }
    
}