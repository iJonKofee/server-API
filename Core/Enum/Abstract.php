<?php

abstract class Core_Enum_Abstract
{

	use Core_Singleton;

    //---------------------------------------------------------------------------------------------------------------------------------------

    /**
     * @var ReflectionClass
     */
    protected $_objReflection;

    /**
     * @var array
     */
    protected $_arrValues;

    /**
     * @var array
     */
    protected $_rulesMap = [];

    //---------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_objReflection = new ReflectionClass($this);
        $this->_arrValues = array_flip($this->_objReflection->getConstants());
        if (!is_array($this->_arrValues)) {
            throw new Core_Enum_Exception('No values in ' . $this->_objReflection->getName());
        }
    }

    /**
     * Validate if value exists in list.
     * @param mixed $mixValue
     * @throws Core_Enum_Exception
     * @return boolean
     */
    public function validate($mixValue, $bThrowException = TRUE)
    {
        $bExists = isset($this->_arrValues[$mixValue]);
        if (!$bExists && $bThrowException) {
            throw new Core_Enum_Exception($mixValue . ' not found in ' . $this->_objReflection->getName());
        }

        return $bExists;
    }

    //---------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Get all enum items
     * Format [name => value]
     *
     * @return array
     */
    public function getAll()
    {
        return $this->_objReflection->getConstants();
    }

    /**
     * Get constant name by value
     * @param mix $mixValue
     * @return string
     */
    public function getName($mixValue)
    {
        $this->validate($mixValue);
        return $this->_arrValues[$mixValue];
    }

    /**
     * @param string $strName
     * @throws System_Enum_Exception
     * @return mixed
     */
    public function getValue($strName)
    {
    	$value = $this->_objReflection->getConstant($strName);
    	if ($value === FALSE)
    	{
    		throw new Core_Enum_Exception($strName . ' name not found in ' . $this->_objReflection->getName());
    	}

    	return $value;
    }

}