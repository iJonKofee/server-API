<?php

class MediaController extends Core_Controller_Abstract
{

	public function uploadAction()
	{
	    $this->view->disable();
	    
	    $name              = $_FILES['media']['name'];
	    $type              = $_FILES['media']['type'];
	    $tmpName           = $_FILES['media']['tmp_name'];
	    $size              = $_FILES['media']['size'];
	    
	    $cfg               = new Phalcon\Config\Adapter\Ini('../app/Config/config.ini');
	    
	    $hashName          = hash_file('md5', $tmpName);
	    
	    $path              = $cfg->media->path . '/' . $hashName;
	    
	    $pathFull          = getcwd() . $path;
	    
	    if(file_exists($pathFull))
	    {
	        echo json_encode(Media_Table::findFirst("path = '$path'")->toArray());
	        return;
	    }
	    
	    
    	if (!move_uploaded_file($tmpName, $pathFull))
    	{
    	    return;
        }
        
	    $row = Core_Media_Manager::getInstance()->add($name, $type, $size, $path);
	    
	    echo json_encode($row->toArray());
	}

}