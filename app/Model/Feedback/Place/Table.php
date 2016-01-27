<?php

/**
 * @method dishId()
 * @method photo()
 * @method taste()
 * @method satiety()
 * @method quality()
 * @method comment()
 */
class Feedback_Place_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'place_feedback';

    /**
     * @var integer
     */
    private $place_id;

    /**
     * @var integer
     */
    private $photo;


    /**
     * @var integer
     */
    private $taste;

    /**
     * @var integer
     */
    private $satiety;

    /**
     * @var integer
     */
    private $quality;

    /**
     * @var string
     */
    private $comment;

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
    protected function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return number
     */
    protected function getTaste()
    {
        return $this->taste;
    }

    /**
     * @return number
     */
    protected function getSatiety()
    {
        return $this->satiety;
    }

    /**
     * @return number
     */
    protected function getQuality()
    {
        return $this->quality;
    }

    /**
     * @return string
     */
    protected function getComment()
    {
        return $this->comment;
    }

    /**
     * @param integer $id
     * @return Feedback_Place_Table
     */
    protected function setPlacehId($id)
    {
        $this->place_id = $id;
        
        return $this;
    }
    
    /**
     * @param integer $id
     * @return Feedback_Place_Table
     */
    protected function setPhoto($id)
    {
        $this->photo = $id;
        
        return $this;
    }
    
    /**
     * @param integer $number
     * @return Feedback_Place_Table
     */
    protected function setTaste($number)
    {
        $this->taste = $number;
        
        return $this;
    }
    
    /**
     * @param integer $number
     * @return Feedback_Place_Table
     */
    protected function setSatiety($number)
    {
        $this->satiety = $number;
        
        return $this;
    }
    
    /**
     * @param integer $number
     * @return Feedback_Place_Table
     */
    protected function setQuality($number)
    {
        $this->quality = $number;
        
        return $this;
    }
    
    /**
     * @param string $str
     * @return Feedback_Place_Table
     */
    protected function setComment($str)
    {
        $this->comment = $str;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->belongsTo("place_id", "Place_Table", "id");
        $this->belongsTo("photo", "Media_Table", "id");
    }
    
}
