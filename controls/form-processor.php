<?php
include_once '../controls/session.php';
include_once '../controls/application.php';
include_once '../model/view-controller.php';
class Process
{
	function Process()
	{
		if(isset($_POST['procLogin']))
		{
			$this->procLogin();
		}
		elseif(isset($_POST['procRoomChange']))
		{
			$this->procLoadRoom();
		}
		else
		{
			$this->procLogout();
		}
	}
	
	function procLogin()
	{
		global $session;
		$password = $_POST['pass'];
		$remember = $_POST['remember'];
		$result = $session->login($password, $remember);
		
		header("Location: ../index.php");
	}
	
	function procLoadRoom()
	{
		global $viewController;
		echo $viewController->getRoomResults();
	}
	
	function procLogout()
	{
		global $session;
		$session->logout();
		header("Location: ../index.php");
	}
	
	
	
};
$process = new Process;