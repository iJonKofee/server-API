<?php

class City_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($name)
    {
        $tbl = $this->getTable();
        
        $tbl
            ->name($name)
        ;
        
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
}