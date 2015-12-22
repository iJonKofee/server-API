<?php

/**
 * @method name()
 */
class Category_Company_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'company_category';

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
        $this->hasMany("id", "Company_Table", "category_id");
    }
    
}
