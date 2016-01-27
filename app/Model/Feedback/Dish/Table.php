<?php

class Feedback_Dish_Table extends Core_Db_Table_Abstract
{
    
    use Core_Singleton;

	/**
	 * @var string
	 */
	protected $_tableName = 'dish_feedback';

	/**
	 * @var integer
	 */
	private $dish_id;
	
	/**
	 * @var integer
	 */
	private $feedback_id;
	
    /**
     * @return number
     */
    protected function getDishId()
    {
        return $this->dish_id;
    }

    /**
     * @return number
     */
    protected function getFeedbackId()
    {
        return $this->feedback_id;
    }

    /**
     * @param integer $id
     * @return Feedback_Dish_Table
     */
    protected function setDishId($id)
    {
        $this->dish_id = $id;
        
        return $this;
    }
    
    /**
     * @param integer $id
     * @return Feedback_Dish_Table
     */
    protected function setFeedbackId($id)
    {
        $this->feedback_id = $id;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->belongsTo("feedback_id", "Feedback_Table", "id");
        $this->belongsTo("dish_id", "Dish_Table", "id");
    }
    
}
