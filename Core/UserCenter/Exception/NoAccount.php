<?php
class Core_UserCenter_Exception_NoAccount extends Core_Exception
{
	public function __construct()
	{
		parent::__construct("User account not found in session");
	}
}