<?php
/**
 * location/Location.php
 * [model]
 * The Location class manages data and contains validation rules.
 * $Id: Location.php 36 2009-03-16 09:26:43Z alphafoobar $
 */

class Location extends Model
{ 
	var $name = 'locations';
	var $validate = array(
		// validation against table_data
	);

	/**
	 * Possible data values
	 *
	 * @var array of strings pairs
	 */
	var $values = array(
		// this is just a display store
	);	
	
	var $table_data = array(
		 // these need to match the values in the DB table
		'location_name',
		'user_id',
		'detail',
		'city',
		'postcode',
		'country',
		'lat',
		'lng'
	);
	
	/**
	/**
	 * Create a new user from the webpage:register.
	 * 
	 * @param array $location
	 */
	public function __construct($location = null)
    {
		// if location is not null, then its a db load.
		if($location != null)
		{
			$this->initialise($location);
			// if we've passed an arg, then we want to view or edit... or
			// possibly delete... but perhaps we can use something else for that?
			$this->validation();
		}
		else { /* Do some stuff here... perhaps handle get requests */ }
	}		
}
?>