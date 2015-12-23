<?php

class Place_Tag_Manager extends Core_Model_Manager
{

    use Core_Singleton;
    
    public function add($placeId, $tagId)
    {
        $tbl = new Place_Tag_Table();
        
        $tbl
            ->placeId($placeId)
            ->tagId($tagId)
        ;
        
        if (!$tbl->save())
        {
            throw new Core_Db_Table_Exception();
        }
        
        return $tbl;
    }
    
    public static function synchronizationFromIdArray($placeId, array $arrTagId)
    {
        $tagsArr = $arrTagId;
        
        $rows = Place_Tag_Table::getInstance()->find("place_id = $placeId");
        
        foreach ($rows as $row)
        {
            if (in_array($row->tagId(), $tagsArr) === FALSE)
            {
                $row->delete();
            }
            else
            {
                unset($tagsArr[array_search($row->id(), $tagsArr)]);
            }
        }
        
        foreach ($tagsArr as $tagId)
        {
            self::add($placeId, $tagId);
        }
    }
    
}