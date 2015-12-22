<?php

/**
 * @method name()
 * @method categoryId()
 * @method logo()
 * @method datetimeCreate()
 */
class Company_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'company';

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $category_id;

    /**
     * @var string
     */
    private $logo;
    
    /**
     * @var string
     */
    private $datetime_create;
    
    /**
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }
    
    /**
     * @return number
     */
    protected function getCategoryId()
    {
        return $this->category_id;
    }
    
    /**
     * @return string
     */
    protected function getLogo()
    {
        return $this->logo;
    }
    
    /**
     * @return string
     */
    public function getDatetimeCreate()
    {
        return $this->datetime_create;
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
    
    /**
     * @param integer $id
     * @return Company_Table
     */
    protected function setCategoryId($id)
    {
        $this->category_id = $id;
        
        return $this;
    }
    
    /**
     * @param string $string
     * @return Company_Table
     */
    protected function setLogo($string)
    {
        $this->logo = $string;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->belongsTo("category_id", "Category_Company_Table", "id");
    }

}
