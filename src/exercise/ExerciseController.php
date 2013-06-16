<?php
/**
 * exercise/ExerciseController.php
 * [controller]
 * This will handle Exercise updates
 * $Id: ExerciseController.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

class ExerciseController
{ 
	public function insert($workout_data)
	{
		// wrap some exception handling
		// - perhaps validation messages as well
		// wrap some timing
		// 
		// check the user is logged in	
		// construct user_id from logged in user.
		$workout_data['user_id'] = UsersController::get("id");
		$time = false;
		if(isset($workout_data['date']))
		{
			$time = date("Y-m-d", strtotime($workout_data['date']));
		}
		if(isset($workout_data['time']))
		{
			$time = $time ." ".$workout_data['time'];
		}
		else
		{
			$time = "$time 12:01";
		}
		
		$temp = array();
		foreach($workout_data as $key => $value)
		{
			$temp[$key] = $value;
		}
		// then load time:
		if($time)
		{
			$temp["time"] = date("Y-m-d H:i", strtotime($time));
			echo "time::" . $temp["time"]."\n";
		}
		
		$location = LocationController::insert($workout_data);
		$exercise = new Exercise($temp);
		$exercise->set("location", $location);
		return $exercise->insert();
	}
	
	public function update($workout_data)
	{
		$workout_data['user_id'] = UsersController::get("id");
		$time = false;
		if(isset($workout_data['date']))
		{
			$time = date("Y-m-d", strtotime($workout_data['date']));
		}
		if(isset($workout_data['time']))
		{
			$time = $time ." ".$workout_data['time'];
		}
		else
		{
			$time = "$time 12:01";
		}
		
		$temp = array();
		foreach($workout_data as $key => $value)
		{
			$temp[$key] = $value;
		}
		// then load time:
		if($time)
		{
			$temp["time"] = date("Y-m-d H:i", strtotime($time));
			echo "time::" . $temp["time"]."\n";
		}
		// this might be a legitimate new place?
		$location = LocationController::insert($workout_data);
		
		$exercise = new Exercise($temp);
		$exercise->set("location", $location);
		return $exercise->update();
	
	}
	/**
	 * Load a location and deliver it to the user.
	 *
	 * @param int $id
	 * @return Location object loaded from $id
	 */
	public function getObject($id)
	{
		$exercise = new Exercise();
		$exercise->load($id);
		return $exercise;
	}
	
	/**
	 * Returns a sessions object, which can be used to generate HTML etc.
	 *
	 * @param Session $n
	 */
	public function getNextSessions($n)
	{
		// ExerciseList
		return Exercise::getNextSessions($n);
	}
	
	/**
	 * Returns a sessions object, which can be used to generate HTML etc.
	 *
	 * @param Session $n
	 */
	public function getLastSessions($n)
	{
		// ExerciseList
		return Exercise::getLastSessions($n);
	}
	
	/**
	 * Returns a set matching the query params.
	 */
	public function top($n, $type, $period, $distance, $time)
	{
		// ExerciseList
		return Exercise::top(12,$type, $period, $distance, $time);
	}
}
?>