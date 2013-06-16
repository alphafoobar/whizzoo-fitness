<?php
/**
 * user/UsersController.php
 * [controller]
 * This will handle User requests, login, logout, register, edit... etc.
 * $Id: UsersController.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
include_once "util/String.php";

class UsersController
{
	
	function register()
	{
		if(isset($_POST['password']) && isset($_POST['password2']) &&
		$_POST['password'] == $_POST['password2'])
		{
			$user = User::newRegisterUser(
				isset($_POST['name'])?$_POST['name']:null,
				$_POST['email'],
				$_POST['password'],
				$_POST['aboutme']
			);
			// must check user is new and contact info is new
			// insert new user
			// insert new contact
			// connect to db
			return $user->insert();
		}
		
		return false;
	}
	
	public static function login()
	{
		if(isset($_POST['password']) && isset($_POST['email']))
		{
			// check user is not already logged in
			// login in user
			$user = User::newLoginUser(
				$_POST['email'],
				$_POST['password']
			);
			
			// connect to db
			$_SESSION['user_key'] = String::random_string(96,128);

			// check if username is unique
			$result = $user->login();
			 
		}
		
		if (!$result)
		{
			throw new Exception('Could not log you in.');
		}
		
		if (1 == $result->num_rows)
		{	
			$_SESSION['user_key'] = String::random_string(96,128);
			
			if($row = mysqli_fetch_assoc($result)) 
			{
				$_SESSION['user_id'] = $row['id'];
				$_SESSION['user_name'] = $row['name'];
			}
			return true;
		}
		else 
		{
			throw new UserException('Could not log you in.');
		}	
		
		return false;
	}
	
	static function get($key)
	{
		if("id" == $key)
		{
			return $_SESSION['user_id'];
		}
		elseif("name" == $key)
		{
			return $_SESSION['user_name'];
		}
	}
	
	function logout()
	{
		// logout user		
		unset($_SESSION['user_key']);
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		return session_destroy();
	}
	
	function delete($user)
	{
		// remove the current user
	}
	
	function view($user)
	{
		// populate all information about this user
	}
	
	static function show_all()
	{
		// find all the current users
	}
	
	static function online_now()
	{
		// find all the users currently online
	}
	
	/**
	 * Checks to see if the user is actually available.
	 *
	 * @return boolean
	 */
	static function user_logged_in()
	{
		return isset($_SESSION['user_key']);
	}
}

?>