<?php

/**
 * @method name()
 * @method companyId()
 * @method categoryId()
 * @method cityId()
 * @method logo()
 * @method address()
 * @method geoPoint()
 * @method phone()
 */
class Place_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'place';

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $company_id;

    /**
     * @var integer
     */
    private $category_id;

    /**
     * @var integer
     */
    private $city_id;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $geo_point;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $datetime_create;
    /**
     * @var string
     */
    private $description;

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
    protected function getCompanyId()
    {
        return $this->company_id;
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
    protected function getCityId()
    {
        return $this->city_id;
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
    protected function getAddress()
    {
        return $this->address;
    }

    /**
     * @return string
     */
    protected function getGeoPoint()
    {
        return $this->geo_point;
    }

    /**
     * @return string
     */
    protected function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    protected function getDatetimeCreate()
    {
        return $this->datetime_create;
    }
    
    /**
     * @return string
     */
    protected function getDescription()
    {
        return $this->description;
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
     * @return Place_Table
     */
    protected function setCompanyId($id)
    {
        $this->company_id = $id;
        
        return $this;
    }
    
    /**
     * @param integer $id
     * @return Place_Table
     */
    protected function setCategoryId($id)
    {
        $this->category_id = $id;
        
        return $this;
    }
    
    /**
     * @param integer $id
     * @return Place_Table
     */
    protected function setCityId($id)
    {
        $this->city_id = $id;
        
        return $this;
    }
    
    /**
     * @param string $logo
     * @return Place_Table
     */
    protected function setLogo($logo)
    {
        $this->logo = $logo;
        
        return $this;
    }
    
    /**
     * @param string $address
     * @return Place_Table
     */
    protected function setAddress($address)
    {
        $this->address = $address;
        
        return $this;
    }
    
    /**
     * @param string $point
     * @return Place_Table
     */
    protected function setGeoPoint($point)
    {
        $this->geo_point = $point;
        
        return $this;
    }
    
    /**
     * @param string $number
     * @return Place_Table
     */
    protected function setPhone($number)
    {
        $this->phone = $number;
        
        return $this;
    }
    
    /**
     * @param string $string
     * @return Place_Table
     */
    protected function setDatetimeCreate($string)
    {
        $this->datetime_create = $string;
        
        return $this;
    }
    
    /**
     * @param string $string
     * @return Place_Table
     */
    protected function setDescription($string)
    {
        $this->description = $string;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->hasManyToMany(
            "id",
            "Place_Tag_Table",
            "place_id", "tag_id",
            "Tag_Table",
            "id"
        );
        
        $this->hasMany('id', 'Place_Tag_Table', 'place_id');
        
        $this->belongsTo("category_id", "Category_Place_Table", "id");
        $this->belongsTo("company_id", "Company_Table", "id");
        $this->belongsTo("city_id", "City_Table", "id");
        $this->belongsTo("logo", "Media_Table", "id");
    }
    
    public function afterDelete()
    {
        //Удаляем связь с тэгом
        foreach ($this->Place_Tag_Table as $placeTag)
        {
            $placeTag->delete();
        }
    }
    
}
