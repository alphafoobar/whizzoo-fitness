<?php
/**
 * [WeatherStation]
 * /fitness/src/weather/WeatherStation.php
 *
 * This class is a model for a Weather Station.
 *
 * Copyright © 2009 James Little
 *
 * Date: Mar 16, 2009 8:09:22 PM
 * Author: James Little 
 *
 * $Id$
 */
class WeatherStation extends Model
{
	// Resolve the class type
	public $name = "weather_station";
	
	var $validate = array(
		// name must be unique
		// lat and lon must exist and be valid floats
	);
	
	/**
	 * This array matches the database table, only these values can be persisted.
	 *
	 * @var mixed array
	 */
	var $table_data = array( 
	// these need to match the values in the DB table
		'id',
		'lat',
		'lng' ,
		'description',
		'location_count',
		'success',
		'attempt',
		'last_path'
	);
	
	public function __construct()
	{
		// implement constructor for WeatherStation
	}
}
?>