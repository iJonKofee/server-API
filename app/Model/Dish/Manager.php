<?php

class Dish_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($name, $placeId, $categoryId, $pictureId, $price, $weight, $weightUnit, $description)
    {
        $tbl = $this->getTable();
        
        $tbl
            ->name($name)
            ->placeId($placeId)
            ->categoryId($categoryId)
            ->picture($pictureId)
            ->price($price)
            ->weight($weight)
            ->weightUnit($weightUnit)
            ->description($description)
        ;
        
        $tbl->datetime_create = date("Y-m-d H:i:s");
        
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
}