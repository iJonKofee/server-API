<?php

/**
 * @method placeId()
 */
class Place_Tag_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'place_tag';

    /**
     * @var integer
     */
    private $place_id;

    /**
     * @var integer
     */
    private $tag_id;

    /**
     * @return integer
     */
    protected function getPlaceId()
    {
        return $this->place_id;
    }
    /**
     * @return integer
     */
    protected function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * @param integer $id
     * @return Place_Tag_Table
     */
    protected function setPlaceId($id)
    {
        $this->place_id = $id;
        
        return $this;
    }

    /**
     * @param integer $id
     * @return Place_Tag_Table
     */
    protected function setTagId($id)
    {
        $this->tag_id = $id;
        
        return $this;
    }
    
}
