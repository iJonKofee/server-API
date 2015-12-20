<?php

abstract class Core_Model_Manager extends Phalcon\Di\Injectable
{

	/**
	 * @var Core_Db_Table_Abstract
	 */
	private $_table;

	/**
	 * @return Core_Db_Table_Abstract
	 */
	public function getTable()
	{
		if (is_null($this->_table))
		{
			$selfClassName = get_class($this);
			$strTableClassName = str_replace('_Manager', '_Table', $selfClassName);

			$this->_table = new $strTableClassName();
		}

		return $this->_table;
	}

}