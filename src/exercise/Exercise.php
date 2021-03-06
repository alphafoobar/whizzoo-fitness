<?php
/**
 * exercise/Exercise.php
 * [model]
 * 
 * Copyright © 2009 James Little
 * 
 * The User class manages data and contains validation rules.
 * $Id: Exercise.php 38 2009-03-17 02:37:27Z alphafoobar $
 */

class Exercise extends Model
{ 
	var $name = 'workout';
	
	/**
	 * Regex validation commands for the data
	 *
	 * @var array of strings pairs
	 */
	var $validate = array(
		//'name' => '/^.{3,100}$/', /* At least 6 characters and no more than 40. */
		//'password' => '/^.{6,40}$/',
		//'email' => '/^.{3,100}$/',
		//'time' => '/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}/'
	);
	
	/**
	 * Possible data values
	 *
	 * @var array of strings pairs
	 */
	var $values = array(
	 // provides a data store
	);
	
	var $table_data = array( 
	// these need to match the values in the DB table
		'id',
		'user_id',
		'workout_type' ,
		'record_type',
		'other_type',
		'time' ,
		'distance',
		'hours',
		'mins',
		'secs',
		'ave_hr',
		'max_hr',
		'kcal',
		'location',
		'weight',
		'mood',
		'difficulty',
		'path',
		'notes'
	);
	
	/**
	 * The location of the workout can be stored in this special variable.
	 *
	 * @var Location
	 */
	var $location;
	
	
	/**
	 * Populates our values using an array
	 *
	 * @param array $workout
	 */
	public function initialise($workout)
	{
		if(isset($workout))
		{
			foreach($workout as $key => $value)
			{
				$this->values[$key] = $value;
			}
		}
		else
		{
			echo "workout is not set?<br/>\n";
		}
		
		if(isset($this->values["location"]))
		{
			$this->location = LocationController::getObject($this->values["location"]);
		}
		else
		{
			$this->location = new Location();
		}
	}
	
	/**
	 *Return the Location.
	 *
	 * @return Location
	 */
	public function getLocation()
	{
		return $this->location;
	}
	
	/**
	 * Create a new user from the webpage:register.
	 *
	 */
	public function __construct($workout = null)
	{
		if($workout != null)
		{
			$this->initialise($workout);
			// if we've passed an arg, then we want to view or edit... or
			// possibly delete... but perhaps we can use something else for that?
			$this->validation();
		}
		else { /* Do some stuff here... perhaps handle get requests */ }
	}
	
	/**
	 *
	 * @param int $n (default = 5)
	 * @return array of Exercises
	 */
	public static function getNextSessions($n = 5)
	{
		return Exercise::runExerciseSetQuery(Exercise::getNextQry($n));
	}
	/**
	 *
	 * @param int $n (default = 5)
	 * @return array of Exercises
	 */
	public static function getLastSessions($n = 5)
	{
		return Exercise::runExerciseSetQuery(Exercise::getLastQry($n));
	}
	
	/**
	 *
	 * @param int $n (default = 5)
	 * @return array of Exercises
	 */
	public static function getTemplates($n = 5)
	{
		return Exercise::runExerciseSetQuery(Exercise::getTemplatesQry($n));
	}
	
	
	private static function runExerciseSetQuery($sql)
	{
		$result = Model::runQuery($sql);
		if($result)
		{
			/* determine number of rows result set */
			$row_cnt = $result->num_rows;
			$exercises = array();
			$i = 0;
			while ($row = $result->fetch_assoc()) {
				$exercises[$i] = new Exercise($row);
				$i++;
				//$exercises[$i]
			}
			$result->close();
		}
		else
		{
			throw new Exception("Can't run query");
		}
		return $exercises;
	}
	
	private static function getUsrStr()
	{
		$userStr = "";
		if(UsersController::user_logged_in())
		{
			$userStr = "and workout.user_id = ".UsersController::get("id");
		}
		return $userStr;
	}
	
	private static function getNextQry($n)
	{
		$userStr = Exercise::getUsrStr();
		$sql = "select workout.id as id, workout_type.description as description, workout.time as time, workout.distance as distance, locations.city as city ".
			"from workout right join workout_type on workout.workout_type = workout_type.workout_type ".
			"left join locations on workout.location = locations.id ".
			"where workout.time > now() $userStr ORDER BY workout.time LIMIT 0,$n;";
		return $sql;
	}
	
	private static function getLastQry($n)
	{
		$userStr = Exercise::getUsrStr();
		$sql = "select workout.id as id, workout_type.description as description, workout.time as time, workout.distance as distance, locations.city as city ".
			"from workout right join workout_type on workout.workout_type = workout_type.workout_type ".
			"left join locations on workout.location = locations.id ".
			"where workout.time < now() $userStr ORDER BY workout.time desc LIMIT 0,$n;";
		return $sql;
	}
	public static function top($n, $type, $period, $distance, $time)
	{
		$where = " where workout.time < now()";
		if(isset($type))
		{
			$where .= " AND workout_type = {$type}";
		}
		if(isset($period))
		{
			//need to do some date manipulation
			//$where .= " AND workout_type = {$type}";
		}
		if(isset($distance))
		{
			//$where .= " AND distance = {$distance}";
		}
		if(isset($time))
		{
			//time manipulation required? or more params
			//$where .= " AND workout_type = {$time}";
		}
		$sql = "select sum(workout.distance) as distance, users.name as name ". 
				"from workout left join users on workout.user_id = users.id ".
				$where.
				" GROUP BY workout.user_id".
				" ORDER BY workout.distance desc LIMIT 0,$n";
		return Exercise::runExerciseSetQuery($sql);
	}
}
?>