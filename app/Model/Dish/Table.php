<?php

/**
 * @method name()
 * @method placeId()
 * @method categoryId()
 * @method picture()
 * @method price()
 * @method weight()
 * @method weightUnit()
 */
class Dish_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'dish';

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $place_id;

    /**
     * @var integer
     */
    private $category_id;


    /**
     * @var string
     */
    private $picture;

    /**
     * @var float
     */
    private $price;

    /**
     * @var float
     */
    private $weight;

    /**
     * @var number
     */
    private $weight_unit;

    /**
     * @var string
     */
    private $description;

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
    protected function getPlaceId()
    {
        return $this->place_id;
    }

    /**
     * @return number
     */
    protected function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * @return number
     */
    protected function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    protected function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return number
     */
    protected function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return number
     */
    protected function getWeightUnit()
    {
        return $this->weight_unit;
    }

    /**
     * @return string
     */
    protected function getDescription()
    {
        return $this->description;
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
     * @return Dish_Table
     */
    protected function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    /**
     * @param integer $id
     * @return Dish_Table
     */
    protected function setPlaceId($id)
    {
        $this->place_id = $id;
        
        return $this;
    }
    
    /**
     * @param integer $id
     * @return Dish_Table
     */
    protected function setCategoryId($id)
    {
        $this->category_id = $id;
        
        return $this;
    }
    
    /**
     * @param float $price
     * @return Dish_Table
     */
    protected function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }
    
    /**
     * @param string $picture
     * @return Dish_Table
     */
    protected function setPicture($picture)
    {
        $this->picture = $picture;
        
        return $this;
    }
    
    /**
     * @param string $weight
     * @return Dish_Table
     */
    protected function setWeight($weight)
    {
        $this->weight = $weight;
        
        return $this;
    }
    
    /**
     * @param integer $value
     * @return Dish_Table
     */
    protected function setWeightUnit($value)
    {
        $this->weight_unit = $value;
        
        return $this;
    }
    
    /**
     * @param string $value
     * @return Dish_Table
     */
    protected function setDescription($value)
    {
        $this->description = $value;
        
        return $this;
    }
    
    /**
     * @param string $string
     * @return Dish_Table
     */
    protected function setDatetimeCreate($string)
    {
        $this->datetime_create = $string;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->belongsTo("category_id", "Category_Dish_Table", "id");
        $this->belongsTo("place_id", "Place_Table", "id");
        $this->belongsTo("picture", "Media_Table", "id");
    }
    
}
