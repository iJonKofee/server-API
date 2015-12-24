<?php

class Core_Media_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($name, $type, $size, $path)
    {
        $tbl = new Media_Table();
        
        $tbl
            ->name($name)
            ->type($type)
            ->size($size)
            ->path($path)
        ;
        
        $tbl->datetime_create = date("Y-m-d H:i:s");
            
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
}