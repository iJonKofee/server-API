<?php

/**
 * @method name()
 */
class Category_Place_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'place_category';

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
     * @return string
     */
    protected function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->hasMany("id", "Place_Table", "category_id");
    }
    
}
