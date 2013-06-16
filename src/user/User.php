<?php
/**
 * user/User.php
 * [model]
 * 
 * Copyright © 2009 James Little
 * 
 * The User class manages data and contains validation rules.
 * $Id: User.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

class User extends Model
{ 
	var $name = 'users';
	
	var $validate = array(
		'name' => '/^.{3,100}$/', /* At least 6 characters and no more than 40. */
		'password' => '/^.{6,40}$/',
		'email' => '/^.{3,100}$/'
	);

	var $values = array(
	 // provides a data store
	);
	
	var $table_data = array( 
	// these need to match the values in the DB table
	  	'id',  
	  	'name',  
		'location',
		'thumb_id',
		'email',
		'about' 
	);
	
	private $userID;
	private $username;
	private $email;
	private $password;
	private $aboutme;
	private $location;
	private $city;
	private $postcode;
	private $avatar;
	private $country;

	public function __construct(){}
	
	/**
	 * Create a new user from the webpage:register.
	 *
	 * @param string $email
	 * @param password $password
	 * @param string $aboutme 
	 * @param int $location The user location
	 * @param int $photo The user avatar
	 */
	public function setRegisterData(
		$username,
		$email,
		$password,
		$aboutme,
		$location,
		$photo
	){
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->aboutme = $aboutme;
		$this->location = $location;
		$this->photo = $photo;
	}
	
	/**
	 * Login User constructor.
	 *
	 * @param unknown_type $email
	 * @param unknown_type $password
	 */
	public function setLoginData(
		$username,
		$email,
		$password
	){
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}
	
	/**
	 * Create a new user from the webpage:register.
	 *
	 * @param string $email
	 * @param password $password
	 * @param string $aboutme
	 * @param int $location
	 * @param int $photo
	 */
	public static function newRegisterUser(
		$username,
		$email,
		$password,
		$aboutme,
		$location = null,
		$photo = null
	)
	{
		$newUser = new User();
		$newUser->setRegisterData($username, $email, $password, $aboutme,
			$location, $photo);
		return $newUser;
	}

	public static function newLoginUser($email, $password)
	{
		$newUser = new User();
		$newUser->setLoginData(null, $email, $password);
		return $newUser;
	}
	
	public static function getUser($user_key)
	{
		$newUser = new User();
		$results = $this->runQuery($this->userKeyQuery());

		if($row = mysqli_fetch_assoc($quer)) 
		{
		//	draw_link_str("p", $row['uid'], $row['whizzoo'], $row['count']);
		}	
		return $newUser;
	}
	
	public function initialise($user)
	{
		if(isset($user))
		{
			foreach($user as $key => $value)
			{
				$this->values[$key] = $value;
			}
		}
		else
		{
			echo "user is not set?<br/>\n";
		}
	}

	public static function newLoginOpenID($openid, $password)
	{
		
	}
	
	public static function newLoginFacebook($facebook)
	{
		
	}

	public function insert()
	{
		return $this->runQuery($this->insertQuery());
	}
	
	public function update()
	{
		return $this->runQuery($this->updateQuery());
	}
	
	public function login()
	{
		return $this->runQuery($this->loginQuery());
	}
	
	public function logout()
	{
	}
		
	private function loginQuery()
	{/*
		if(!(isset($_SESSION["user_key"]) && isset($_SERVER["REMOTE_ADDR"])))
		{
			throw new UserException('Cannot log in, user details are invalid!');
		}*/
		if(!(isset($_POST["email"]) && isset($_POST["password"])))
		{
			throw new UserException('Cannot log in, please provide an email and password!');
		}
		$email = $_POST["email"];
		$passwd = $_POST["password"];
		
		$sql = "SELECT id, name, email FROM users WHERE email = '$email' AND password = '$passwd';";
		return $sql;
	}
	
	private function userKeyQuery()
	{
		if(!(isset($_SESSION["user_key"]) && isset($_SERVER["REMOTE_ADDR"])))
		{
			throw new UserException('Can not confirm user is logged in, user details are invalid!');
		}
		
		$sql = "SELECT sessions.user, users.name FROM sessions, users WHERE key = '".
			$_SESSION["user_key"]."' AND client = '".$_SERVER["REMOTE_ADDR"]."' AND sessions.user=users.id;";
		
		return $sql;
	}
}
?>