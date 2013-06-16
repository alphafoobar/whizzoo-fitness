<?php
/**
 * /fitness/src/imports.php
 *
 * Provides functional imports for the system.
 * 
 * @copyright James Little Ltd. 2008
 *
 * Date: Oct 9, 2008 10:09:51 PM
 * Author: james 
 *
 * $Id: imports.php 17 2009-02-04 19:01:30Z alphafoobar $
 */
 
 
		// Set language to Cantonese HK
		//setlocale(LC_ALL, 'zh-hk.UTF8');
		putenv ("LC_ALL=zh-hk"); 
		

		// Specify location of translation tables
		bindtextdomain("messages", "locale");

		// Choose domain
		textdomain("messages");
		
// we should only import common elements here
include_once 'config/Constants.php';
include_once 'util/String.php';
include_once 'util/HTML.php';
include_once 'util/Database.php';
include_once 'util/DatabaseException.php';
include_once 'config/DatabaseConfig.php';
include_once 'util/Model.php';
// should pobably import users...
include_once 'user/UserException.php';
include_once 'user/User.php';
include_once 'user/UsersController.php';
// exercise...
include_once 'exercise/ExerciseTypes.php';
include_once 'exercise/ExerciseException.php';
include_once 'exercise/Exercise.php';
include_once 'exercise/ExerciseController.php';
// location..
include_once "location/Location.php";
include_once "location/LocationController.php";
// etc...

 /**
  * if display is true - display it, otherwise return it.
  */
function user_getName($display)
{
	$name = UsersController::get("name");
	if($display) { echo $name; }
	return $name;
}

/**
 * variable can be used to create html headers and footers and time process.
 */
$html = new HTML();

?>