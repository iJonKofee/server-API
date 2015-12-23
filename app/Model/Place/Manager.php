<?php

class Place_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($name, $companyId, $categoryId, $cityId, $logo, $address, $geoPoint, $phone)
    {
        $tbl = $this->getTable();
        
        $tbl
            ->name($name)
            ->logo($logo)
            ->categoryId($categoryId)
            ->companyId($companyId)
            ->address($address)
            ->geoPoint($geoPoint)
            ->phone($phone)
            ->cityId($cityId)
        ;
        
        $tbl->datetime_create = date("Y-m-d H:i:s");
        
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
}