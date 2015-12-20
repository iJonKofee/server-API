<?php

/**
 * Abstract controller class
 */
abstract class Core_Controller_Abstract extends Phalcon\MVC\Controller
{

	/**
	 * @var Core_Db_Table_Abstract
	 */
	private $_table;

	/**
	 * @var Core_Model_Manager
	 */
	private $_manager;
	
	/**
	 * @var Core_Db_Table_Select
	 */
	protected $_select;

	/**
	 * @return Core_Db_Table_Abstract
	 */
	protected function getTable()
	{
		if (is_null($this->_table))
		{
			$selfClassName = get_class($this);
			$strTableClassName = str_replace('Controller', '_Table', $selfClassName);
			$this->_table = new $strTableClassName();
		}

		return $this->_table;
	}

	/**
	 * @return Core_Model_Manager
	 */
	protected function getManager()
	{
		if (is_null($this->_manager))
		{
			$selfClassName = get_class($this);
			$strManagerClassName = str_replace('Controller', '_Manager', $selfClassName);
			$this->_manager = $strManagerClassName::getInstance();
		}

		return $this->_manager;
	}
	
	/**
	 * @return Core_Db_Table_Select
	 */
	protected function getSelect()
	{
	    if (is_null($this->_select))
	    {
	        $tbl = $this->getTable();
	        
	        $this->_select = $tbl::query();
	    }
	    
	    return $this->_select;
	}
	
	/**
	 * Вытягиваем из $_GET значение по ключу, если такового нет - отдает значение по умолчанию, которое переданно 2м параметром
	 * @param string|number $name
	 * @param string|number $default
	 * @return string|number
	 */
	protected function getParam($name, $default = NULL)
	{
	    $value = $this->request->getQuery($name);
	    
	    return $value ? $value : $default;
	}
	
	/**
	 * Вытягиваем из $_POST значение по ключу, если такового нет - отдает значение по умолчанию, которое переданно 2м параметром
	 * @param string|number $name
	 * @param string|number $default
	 * @return string|number
	 */
	protected function getPost($name, $default = NULL)
	{
	    $value = $this->request->getQuery($name);
	    
	    return $value ? $value : $default;
	}

	/**
	 * Возвращает общее кол-во строк таблице
	 *
	 * @return integer
	 */
	protected function getRowsCount()
	{
	    
		$tbl = $this->getTable();

		//@todo Придумать что-то побыстрее. К примеру, SELECT COUNT(*) FROM `table`
		$rows = $tbl::find();
		
		return count($rows);
	}

}
