<?php

/**
 * @method name()
 */
class City_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'city';

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
     * @return Company_Table
     */
    protected function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->hasMany("id", "Place_Table", "city_id");
    }
    
    public function beforeDelete()
    {
        if ($this->Place_Table->toArray())
        {
            return FALSE;
        }
    
        return TRUE;
    }
    
}
