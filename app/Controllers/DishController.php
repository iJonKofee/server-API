<?php

class DishController extends Core_Controller_Abstract
{

    public function manageAction()
    {
        $this->view->rows = $this->getTable()->find();
    }
    
    public function addAction()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    
        $this->view->rowsCategory   = Category_Dish_Table::getInstance()->find();
        $this->view->rowsPlace      = Place_Table::getInstance()->find();
        $this->view->weightUnits    = (new Dish_Unit_Enum())->getAll();
    
        if (!$this->request->isPost())
        {
            return ;
        }
        
        $this->view->disable();
    
        // Получение переменных методом POST
        $name = $this->getPost('name');
        $placeId = $this->getPost('place_id');
        $categoryId = $this->getPost('category_id');
        $picture = $this->getPost('picture');
        $price = $this->getPost('price');
        $weight = $this->getPost('weight');
        $weightUnit = $this->getPost('weight_unit');
        $description = $this->getPost('description');
        
        try
        {
            $row = $this->getManager()->add($name, $placeId, $categoryId, $picture, $price, $weight, $weightUnit, $description);
        }
        catch (Core_Db_Table_Exception $e)
        {
            //Заглушка
            throw new Core_Db_Table_Exception($e->getMessage());
        }
    }
    
    public function editAction()
    {
        $this->view->setRenderLevel(Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
    
        $id = $this->getParam('id');
    
        $row = $this->getTable()->findFirst($id);
        
        $this->view->rowsCategory   = Category_Dish_Table::getInstance()->find();
        $this->view->rowsPlace      = Place_Table::getInstance()->find();
        $this->view->weightUnits    = (new Dish_Unit_Enum())->getAll();
        $this->view->row            = $row;
    
        if (!$this->request->isPost())
        {
            return ;
        }
    
        $this->view->disable();
    
        // Получение переменных методом POST
        $name = $this->getPost('name');
        $placeId = $this->getPost('place_id');
        $categoryId = $this->getPost('category_id');
        $picture = $this->getPost('picture');
        $price = $this->getPost('price');
        $weight = $this->getPost('weight');
        $weightUnit = $this->getPost('weight_unit');
        $description = $this->getPost('description');
        
        $row
            ->name($name)
            ->placeId($placeId)
            ->categoryId($categoryId)
            ->picture($picture)
            ->price($price)
            ->weight($weight)
            ->weightUnit($weightUnit)
            ->description($description)
            ->save()
        ;
        
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