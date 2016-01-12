<?php

class PlaceController extends Core_Controller_Abstract
{

    public function manageAction()
    {
        $this->view->rows = $this->getTable()->find();
    }
    
    public function addAction()
    {
        $this->view->rowsCategory   = Category_Place_Table  ::getInstance()->find();
        $this->view->rowsCompany    = Company_Table         ::getInstance()->find();
        $this->view->rowsCity       = City_Table            ::getInstance()->find();
        $this->view->rowsTag        = Tag_Table             ::getInstance()->find();
    
        if (!$this->request->isPost())
        {
            return ;
        }
        
        $this->view->disable();
    
        // Получение переменных методом POST
        $name = $this->getPost('name');
        $companyId = $this->getPost('company_id');
        $categoryId = $this->getPost('category_id');
        $logo = $this->getPost('logo');
        $cityId = $this->getPost('city_id');
        $address = $this->getPost('address');
        $geoPoint = $this->getPost('geo_point');
        $phone = $this->getPost('phone');
        $arrTags = explode(',', $this->getPost('tags'));
        
        try
        {
            $row = $this->getManager()->add($name, $companyId, $categoryId, $cityId, $logo, $address, $geoPoint, $phone);
            
            foreach ($arrTags as $tag)
            {
                Place_Tag_Manager::getInstance()->add($row->id(), $tag);
            }
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
    
        $this->view->rowsCategory   = Category_Place_Table  ::getInstance()->find();
        $this->view->rowsCompany    = Company_Table         ::getInstance()->find();
        $this->view->rowsCity       = City_Table            ::getInstance()->find();
        $this->view->rowsTag        = Tag_Table             ::getInstance()->find();
        $this->view->row            = $row;
    
        if (!$this->request->isPost())
        {
            return ;
        }
    
        $this->view->disable();
    
        // Получение переменных методом POST
        $name = $this->getPost('name');
        $companyId = $this->getPost('company_id');
        $categoryId = $this->getPost('category_id');
        $logo = $this->getPost('logo');
        $cityId = $this->getPost('city_id');
        $address = $this->getPost('address');
        $geoPoint = $this->getPost('geo_point');
        $phone = $this->getPost('phone');
        $arrTags = explode(',', $this->getPost('tags'));
        
        $row
            ->name($name)
            ->logo($logo)
            ->categoryId($categoryId)
            ->companyId($companyId)
            ->address($address)
            ->geoPoint($geoPoint)
            ->phone($phone)
            ->cityId($cityId)
            ->save()
        ;

        Place_Tag_Manager::synchronizationFromIdArray($row->id(), $arrTags);
    }
    
    public function deleteAction()
    {
        $this->view->disable();
        
        $id = $this->getParam('id');
        
        $row = $this->getTable()->find($id);
        
        $row->delete();
    }
    
}