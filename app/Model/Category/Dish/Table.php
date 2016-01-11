<?php

/**
 * @method name()
 * @method imageId()
 */
class Category_Dish_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'dish_category';

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $image_id;

    /**
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @return integer
     */
    protected function getImageId()
    {
        return $this->image_id;
    }
    
    /**
     * @return string
     */
    protected function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * @return integer
     */
    public function setImageId($id)
    {
        $this->image_id = $id;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->hasMany("id", "Dish_Table", "image_id");
        $this->belongsTo("image_id", "Media_Table", "id");
    }

    public function beforeDelete()
    {
        if ($this->Dish_Table->toArray())
        {
            return FALSE;
        }
    
        return TRUE;
    }
    
}
