<?php
/**
 * /fitness/src/exercise/Plan.php
 *
 * A plan is a sort of exercise set. You might create a plan as a training
 * program/plan. It might just be a session you want to do, or an event. You 
 * can create events of course, but perhaps you don't want to.. or it is more 
 * personal.
 * 
 * A plan will contain at least one session... otherwise it isn't much of a 
 * plan!
 * 
 * @copyright James Little Ltd. 2008
 *
 * Date: Sep 18, 2008 12:23:49 AM
 * Author: james 
 *
 * $Id: Plan.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
class Plan
{
	// Resolve the class type
	public $class = "Plan";
	
	public function __construct()
	{
		// implement constructor for Plan
	}
}
?>