<?php

/**
 * Abstract table class
 * @method id()
 */
abstract class Core_Db_Table_Abstract extends \Phalcon\Mvc\Model
{

	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @param integer $id
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Allows to query a set of records that match the specified conditions
	 *
	 * @param mixed $parameters
	 * @return Specusers[]
	 */
	public static function find($parameters = null)
	{
		return parent::find($parameters);
	}

	/**
	 * Allows to query the first record that match the specified conditions
	 *
	 * @param mixed $parameters
	 * @return Specusers
	 */
	public static function findFirst($parameters = null)
	{
		return parent::findFirst($parameters);
	}

	/**
	 * Returns table name mapped in the model.
	 *
	 * @return string
	 */
	public function getSource()
	{
		return $this->_tableName;
	}
	
	public function __call($method, $argument)
	{
	    //Если геттера или сеттера нет - вызываем родительский
	    if (!method_exists($this, 'set' . $method) && !method_exists($this, 'get' . $method))
	    {
	        parent::__call($method, $argument);
	    }
	    
	    if (boolval($argument))
	    {
	        $newMethod = 'set' . $method;
	        
	        return $this->$newMethod($argument[0]);
	    }
	    else
	    {
	        $newMethod = 'get' . $method;
	        
	        return $this->$newMethod();
	    }
	}
	
	public function isEmpty()
	{
	    return !$this->toArray();
	}

}
