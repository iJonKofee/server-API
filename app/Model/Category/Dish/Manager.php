<?php

class Category_Dish_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($name, $imageId)
    {
        $tbl = $this->getTable();
        
        $tbl
            ->name($name)
            ->imageId((int)$imageId)
        ;
        
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
}