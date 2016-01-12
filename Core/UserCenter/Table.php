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
    private $email;

    /**
     *
     * @var string
     */
    private $phone;

    /**
     *
     * @var integer
     */
    private $picture;

    /**
     *
     * @var integer
     */
    private $city_id;

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
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @param integer $media_id
     * @return $this
     */
    public function setPicture($media_id)
    {
        $this->picture = $media_id;

        return $this;
    }

    /**
     * @param integer $id
     * @return $this
     */
    public function setCityId($id)
    {
        $this->city_id = $id;

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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return integer
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return integer
     */
    public function getCityId()
    {
        return $this->city_id;
    }
    
    public function initialize()
    {
        $this->belongsTo("picture", "Media_Table", "id");
    }

}
