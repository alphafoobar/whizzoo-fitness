<?php
/*
 * January 9, 2009 11:59:39 PM
 * 
 * Draws and enables the available types.
 * 
 * Copyright © 2009 James Little
 * Author: James Little
 * $Id: ExerciseTypes.php 32 2009-03-12 02:07:49Z alphafoobar $
 */


class ExerciseTypes
{
	static $types = array(
	'Other', // 0
	'Run',
	'Erg',
	'Row',
	'Cycle',
	'Cross trainer',
	'Gym',
	'Swim',
	'Mountain biking' 
	);
	
	public static function draw_options($selected_item)
	{
	
		foreach(ExerciseTypes::$types as $i => $exercise)
		{
		
			echo "<option value='$i' ";
			if($selected_item == $i)
			{
				echo "selected";
			}
			echo ">$exercise</option>\n";
		}
	}
}
?>