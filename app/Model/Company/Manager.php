<?php

class Company_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($name, $logo, $categoryId)
    {
        $tbl = $this->getTable();
        
        $tbl
            ->name($name)
            ->logo($logo)
            ->categoryId($categoryId)
        ;
        
        $tbl->datetime_create = date("Y-m-d H:i:s");
        
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
}