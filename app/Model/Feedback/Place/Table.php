<?php

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
    private $feedback_id;

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
    protected function getFeedbackId()
    {
        return $this->feedback_id;
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
    protected function setFeedbackId($id)
    {
        $this->feedback_id = $id;
        
        return $this;
    }
    
    public function initialize()
    {
        $this->belongsTo("feedback_id", "Feedback_Table", "id");
        $this->belongsTo("place_id", "Place_Table", "id");
    }
    
}
