<?php
/**
 * location/LocationController.php
 * [controller]
 * Location stuff... course
 * $Id: LocationController.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
class LocationController
{
	/**
	 * Insert based on POST data.
	 *
	 * @return int The unique id.
	 */
	public static function insert($location_data)
	{
		// wrap some exception handling
		// - perhaps validation messages as well
		// wrap some timing
		// 
		// check the user is logged in
		
		$location = new Location($location_data);
		return $location->insert();
	}	
	
	/**
	 * Load a location and deliver it to the user.
	 *
	 * @param int $id
	 * @return Location object loaded from $id
	 */
	public static function getObject($id)
	{
		$location = new Location();
		$location->load($id);
		return $location;
	}
}
?>