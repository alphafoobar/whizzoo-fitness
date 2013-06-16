<?php
/**
 * exercise/ExerciseException.php
 * [exception]
 * For when we have issues in the user department.
 * $Id: ExerciseException.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

class ExerciseException extends Exception
{ 
	public function __construct($msg)
	{
       parent::__construct($msg);	
	}
}