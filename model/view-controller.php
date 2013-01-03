<?php
class ViewController
{
	var $rootPath = "../";
	
	function getRoomResults()
	{
		$roomViewString = file_get_contents(htmlspecialchars($this->rootPath . "views/room-views.php"));
		include '../views/room-views.php';
	}
};
$viewController = new ViewController;