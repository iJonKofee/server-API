<?php

/**
 * @method name()
 * @method type()
 * @method path()
 * @method size()
 * @method datetimeCreate()
 */
class Core_Media_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'media';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var integer
     */
    protected $size;

    /**
     * @var string
     */
    protected $datetime_create;
    
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
    protected function getType()
    {
        return $this->type;
    }
    
    /**
     * @return string
     */
    protected function getPath()
    {
        return $this->path;
    }
    
    /**
     * @return integer
     */
    protected function getSize()
    {
        return $this->path;
    }
    
    /**
     * @return string
     */
    protected function getDatetimeCreate()
    {
        return $this->datetime_create;
    }
    
    /**
     * @param string $name
     * @return Core_Media_Table
     */
    protected function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * @param string $type
     * @return Core_Media_Table
     */
    protected function setType($type)
    {
        $this->type = $type;
        
        return $this;
    }
    
    /**
     * @param string $path
     * @return Core_Media_Table
     */
    protected function setPath($path)
    {
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * @param integer $size
     * @return Core_Media_Table
     */
    protected function setSize($size)
    {
        $this->size = $size;
        
        return $this;
    }
    
    /**
     * @param string $string
     * @return Core_Media_Table
     */
    protected function setDatetimeCreate($string)
    {
        $this->datetime_create = $string;
        
        return $this;
    }
    
}
