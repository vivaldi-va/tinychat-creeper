<?php
include_once 'functions/xml2array.php';
class Application
{
	var $room;
	var $userCount;
	var $modCount;
	var $roomInfo;
	
	/**
	 * Set the room to view
	 * @param string $roomName
	 * @return boolean
	 */
	function setRoom($roomName)
	{
		if(!empty($roomName))
		{
			$this->room = $roomName;
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getRoomInfo()
	{
		if(isset($this->room))
		{
			// The external xml file with room info
			$xmlFileURL =  "http://tinychat.apigee.com/".$this->room.".xml";
			
			// Turn file into a string
			$xmlContents = file_get_contents($xmlFileURL);
			
			// Generate an array out of the xml string
			//$xmlInfoArray = xml2array($xmlContents);
			$xmlInfoArray = json_decode(json_encode((array)simplexml_load_string($xmlContents)),1);
			if($xmlInfoArray != null)
			{
				//$this->roomInfo = $xmlInfoArray;
				return $xmlInfoArray;
			}
			return false;
		}
	}
	
	
	
	function getUsers()
	{
		
	}
};

$application = new Application;