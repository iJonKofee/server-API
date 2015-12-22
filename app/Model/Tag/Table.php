<?php

/**
 * @method name()
 */
class Tag_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'tag';

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return string
     */
    protected function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * @param string $name
     * @return Tag_Table
     */
    protected function setPlaceId($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->hasManyToMany(
            "id",
            "Place_Tag_Table",
            "tag_id", "place_id",
            "Place_Table",
            "id"
            );
    }
    
}
