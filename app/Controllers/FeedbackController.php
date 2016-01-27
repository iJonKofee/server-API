<?php

class FeedbackController extends Core_Controller_Abstract
{

    public function dishAction()
    {
        $this->view->rows = Feedback_Dish_Table::getInstance()->find();
    }
    
    public function placeAction()
    {
        $this->view->rows = Feedback_Place_Table::getInstance()->find();
    }

}