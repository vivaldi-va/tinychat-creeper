<?php

class Session
{
	var $loggedIn = false;
	var $userID;
	var $ip;
	var $password = "spacedicks";
	var $cookieTime;
	
	function Session(){
		$this->startSession();
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}
	
	function startSession()
	{
		session_start();
		
		$this->loggedIn = $this->checkLogin();
		$this->cookieTime = 60*60*24*1;
		
	}
	
	function checkLogin()
	{
		if(isset($_COOKIE['cookid']))
		{
			$this->userID = $_SESSION['userid'] = $_COOKIE['cookid'];
		}
		
		if(isset($_SESSION['userid']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function login($password, $keepLoggedIn = false)
	{
		if(md5($password) == md5($this->password))
		{
			$this->loggedIn = true;
			$this->userID = $this->generateString(5);
			$_SESSION['pass'] = md5($password);
			$_SESSION['userid'] = md5($this->userID);
			
			if($keepLoggedIn)
			{
				
				setcookie("cookid", $this->userID, time()+$this->cookieTime, "/");
			}
		}
		
	}
	
	function logout()
	{
		if(isset($_COOKIE['cookid']))
		{
			setcookie("cookid", "", time()-$this->cookieTime, "/");
		}
		
		unset($_SESSION['pass']);
		unset($_SESSION['userid']);
		
		$this->loggedIn = false;
	}
	
	/**
	 * Generate a random string for md5 salt
	 * 
	 * @param int $length
	 * @return string
	 */
	function generateString($length = 5)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';
		for ($i = 0; $i < $length; $i++)
		{
			$string .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $string;
	}
};

$session = new Session;