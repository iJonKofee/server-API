<?php

class Core_UserCenter_Table extends Core_Db_Table_Abstract
{

	/**
	 * @var string
	 */
	protected $_tableName = 'uc_account';

    /**
     *
     * @var string
     */
    private $login;

    /**
     *
     * @var string
     */
    private $password;

    /**
     *
     * @var integer
     */
    private $type;

    /**
     *
     * @var string
     */
    private $hash;

    /**
     * Method to set the value of field login
     *
     * @param string $login
     * @return $this
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field type
     *
     * @param integer $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method to set the value of field type
     *
     * @param integer $type
     * @return $this
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Returns the value of field login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field type
     *
     * @return integer
     */
    public function getHash()
    {
        return $this->hash;
    }

}
