<?php
/**
 * workout.php
 * [view]
 * This is an interface that clients trying to register a workout will enter 
 * through.
 * 
 * $Id: workout.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
include_once 'imports.php';

// headers need to be drawn first thing in the morning.
$title = _("workouts");
$html->drawHeader("$title | "._APPLICATION_TITLE);

echo "<!-- looping though input, to see why we are here. \n";
foreach($_POST as $key => $value)
{
	echo "_POST[$key]=$value\n";
}
echo "--> \n";


if(isset($_POST["sign_in"]))
{
	// invoke register user function
	UsersController::login();
}
$logged_in = UsersController::user_logged_in();

		$header = _("New workout:");
		$html->drawBanner($title);
		if(!$logged_in){
			$html->drawLoginForm($_SERVER['PHP_SELF']);
		}
		
		if($logged_in)
		{ ?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="logout.php">Sign out</a></div>		
		</div>	
		<?php 
		 
		// if the user is logged in - otherwise nothing to do here 
		// this is a little deep in complexity!
		if(isset($_POST['s_workout']))
		{
			if(isset($_POST['exercise']))
			{
				if(ExerciseController::update($_POST))
				{
					echo _("your exercise has been updated!\n");
				}
			}
			elseif(ExerciseController::insert($_POST))
			{
				echo _("thanks for inserting the data!\n");
			}
		} 
		else
		{
			$exercise = new Exercise();
			
			if(isset($_GET["exercise"]))
			{
				echo "<br/>loading exercise: {$_GET["exercise"]}<br/>\n";
				$exercise = ExerciseController::getObject($_GET["exercise"]);

				$header = _("Edit workout:");
			}
				
		// New workout form
		// we should check if we are editing and decide if we want to load an 
		// exercise object
		 ?>
	<div style="float:left; padding: 10px;">
		<h2><?php echo $header; ?></h2>
		<form action="workout.php" accept-charset="utf-8" method="post">
					
			<?php
			if(isset($_GET["exercise"]))
			{
				?>	
				<input type="hidden" name="exercise" value="<?php echo $_GET["exercise"]; ?>"/>
				<?php
			}
			?>
			<input type="hidden" id="city" name="city"/>
			<input type="hidden" id="lat" name="lat"/>
			<input type="hidden" id="lng" name="lng"/>
			<input type="hidden" id="postcode" name="postcode"/>
			<input type="hidden" id="country" name="country"/>
			<script type="text/javascript">
			//<![CDATA[
				var currentActivity = "Run";
				
				function changeFitSelection(newItem) 
				{
					if(currentActivity != newItem)
					{
						document.getElementById(currentActivity).style.display = "none";
						currentActivity = newItem;
						document.getElementById(newItem).style.display = "block";
					} else {
						alert("already got " + newItem);
					}
				}
			//]]>
			</script>
			
			<fieldset style="width:500px;">
				<label style="float:left; width:100px; clear:both;">Exercise type:</label> 
				<select name="workout_type" style="float:left; width:300px;" onChange="changeFitSelection(this.options[this.selectedIndex].text);">
					<?php 
					$workout_type = $exercise->get("workout_type");
					ExerciseTypes::draw_options($workout_type);
					?>
				</select>
				
				<div id="Run" style="display:block; float:left; width:100px; clear:both;"> <h1>Run</h1> </div>
				<div id="Erg" style="display:none;float:left; width:100px; clear:both;"> <h1>Erg</h1> 
				</div>
				<div id="Row" style="display:none;float:left; width:100px; clear:both;"> <h1>Row</h1> </div>
				<div id="Cycle" style="display:none;float:left; width:100px; clear:both;"> <h1>Cycle</h1> </div>
				<div id="Cross trainer" style="display:none;float:left; width:100px; clear:both;"> <h1>Cross trainer</h1> </div>
				<div id="Gym" style="display:none;float:left; width:100px; clear:both;"> <h1>Gym</h1> </div>
				<div id="Swim" style="display:none;float:left; width:100px; clear:both;"> <h1>Swim</h1> </div>
				<div id="Mountain biking" style="display:none;float:left; width:100px; clear:both;"> <h1>Mountain biking</h1> </div>
				<div id="Other" style="display:none;float:left;clear:both;"> <h1>Other</h1> 
					Other sessions can be used to record any sort of activity that is 
					not well measured using the current options.<br/>
					<label style="float:left; width:100px; clear:both;">Other type:</label> 
					<input style="float:left; width:300px;" name="other_type" value="<?php echo $exercise->get("other_type"); ?>"/>
				</div>
				
				<label style="float:left; width:100px; clear:both;">Record type:</label> 
				<select name="record" style="float:left; width:300px;">
					<option value="0">Log entry, have completed this session.</option>
					<option value="1">Calendar entry, I will complete it later.</option>
				</select>
				
				<label style="float:left; width:100px; clear:both;">Date:</label> <input name="date" style="float:left; width:80px;" value="<?php 
				
				$workout_time = $exercise->get("time");
				if($workout_time)
				{
					$workout_time = strtotime($workout_time);
				}
				else
				{
					$workout_time = time();
				}
				echo date("Y-m-d", $workout_time); ?>"/>
				<label style="float:left; width:80px; margin-left: 20px;">Time:</label> <input name="time" style="float:left; width:100px;" value="<?php echo date("h:i a", $workout_time); ?>"/>
				
				<label style="float:left; width:100px; clear:both;">Distance:</label> 
				<input style="float:left; width:300px;" id="distance" name="distance" value="<?php echo $exercise->get("distance"); ?>"/>
				
				<label style="float:left; width:100px; clear:both;">Duration:</label> 
					<input name="hours" style="float:left; width:40px;" value="<?php echo $exercise->get("hours"); ?>"/> <label style="float:left; margin-right:10px;">hour</label>
					<input name="mins" style="float:left; width:40px;" value="<?php echo $exercise->get("mins"); ?>"/> <label style="float:left; margin-right:10px;">min</label>
					<input name="secs" style="float:left; width:40px;" value="<?php echo $exercise->get("secs"); ?>"/> <label style="float:left; margin-right:10px;">sec</label>
				
				<label style="float:left; width:100px; clear:both;">Ave HR:</label> 
				<input name="ave_hr" style="float:left; width:300px;" value="<?php echo $exercise->get("ave_hr"); ?>"/>
				
				<label style="float:left; width:100px; clear:both;">Max HR:</label> 
				<input name="max_hr" style="float:left; width:300px;" value="<?php echo $exercise->get("max_hr"); ?>"/>
				
				<label style="float:left; width:100px; clear:both;">Ave Watts:</label> 
				<input style="float:left; width:300px;" name="ave_watts" value="<?php echo $exercise->get("ave_watts"); ?>"/>
				
				<label style="float:left; width:100px; clear:both;">Kcal:</label> 
				<input name="kcal" style="float:left; width:300px;" value="<?php echo $exercise->get("kcal"); ?>"/>
								
				<label style="float:left; width:100px; clear:both;">Weight:</label> 
					<input name="weight" style="float:left; width:40px;" value="<?php echo $exercise->get("weight"); ?>"/> <label style="float:left;">kg</label>
					<label style="float:left; margin-left:18px;">Mood:</label> <input name="mood" style="float:left; width:40px;" value="<?php echo $exercise->get("mood"); ?>"/> 
					<label style="float:left; margin-left:18px;">Difficulty:</label> 
					<select name="difficulty" style="float:left; width:90px;"><?php 
					$workout_difficulty = $exercise->get("workout_type"); ?>
						<option value="0" <?php if($workout_difficulty == 0) echo "selected"; ?>>Very Easy</option>
						<option value="1" <?php if($workout_difficulty == 1) echo "selected"; ?>>Easy</option>
						<option value="2" <?php if($workout_difficulty == 2) echo "selected"; ?>>Average</option>
						<option value="3" <?php if($workout_difficulty == 3) echo "selected"; ?>>Hard</option>
						<option value="4" <?php if($workout_difficulty == 4) echo "selected"; ?>>Very Hard</option>
					</select>
					
				<label style="float:left; width:100px; clear:both;">Notes:</label> 
				<textarea name="notes" style="float:left; width:300px;" id="notes" name="notes"><?php echo $exercise->get("notes"); ?></textarea>
				
				<fieldset style="float:left; clear:both; border:0; padding:0; margin:0;" >
					<label style="float:left; width:100px;">Location:</label> 
					<input style="float:left; width:300px;" name="location_name" id="location_name" value="<?php if(isset($exercise->location)) echo $exercise->location->get("location_name"); ?>"/><input style="float:left;" type="button" value="find" onclick="showAddress(document.getElementById('location_name').value); return false;"/>
				</fieldset>
				
				<label style="float:left; width:100px; clear:both;">Path:</label> <input type="hidden" name="path" id="path" value="<?php echo $exercise->get("path"); ?>"/>
				<input style="float:left; width:80px;" type="button" value="Start path" onclick="startPath(); return false;"/> 
				<input style="float:left; width:100px;" type="button" value="Remove last" onclick="removeLast(); return false;"/> 
				<input style="float:left; width:80px;" type="button" value="Stop path" onclick="stopPath(); return false;"/>

				<br style="clear:both"/><br/>
				<?php //div style="float:left; width:500px; height: 300px; background-color: #f4d7d7;" id="map_canvas"></div>?>
				<br/>
				
				<input style="clear:both; margin-left:20px;" type="submit" name="s_workout" value="Save workout" />
			</fieldset>
		</form>
	</div>

	
	<?php
	}// end edit workout if
	?>
	<div style="float:left; width:600px; height: 600px; background-color: #f4d7d7;" id="map_canvas"></div>
	<br/>
	<div style="float:left; padding: 10px; width:500px; border: dashed 1px blue; clear:right;">
		<h2>Last 12 workouts:</h2>		
		<ul>
	<?php 
		$ex_sessions = ExerciseController::getLastSessions(12);
		foreach($ex_sessions as $value)
		{
			echo "\t\t\t<li><a href='workout.php?exercise={$value->get("id")}'>{$value->get("description")}, {$value->get("distance")}, {$value->get("city")}</a></li>\n";
		}
	?>
		</ul>
	</div>	
	
	<div style="float:left; padding: 10px; width:500px; border: dashed 1px blue;">
		<h2>Next 5 planned:</h2>
		<ul>
	<?php 
		$ex_sessions = ExerciseController::getNextSessions(5);
		foreach($ex_sessions as $value)
		{
			echo "\t\t\t<li><a href='workout.php?exercise={$value->get("id")}'>{$value->get("description")}, {$value->get("distance")}, {$value->get("city")}</a></li>\n";
		}
	?>
		</ul>
	</div>
<?php 
}// end logged in workout section
if(isset($exercise)){
	$html->footer(true, $exercise->location, $exercise->get("path")); 
}
else
{
	$html->footer(true); 
}
?>