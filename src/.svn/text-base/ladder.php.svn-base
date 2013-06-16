<?php
/**
 * ladder.php
 * [view]
 * The ladder is more of a best of the best queue.
 * 
 * $Id: ladder.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
include_once 'imports.php';

// headers need to be drawn first thing in the morning.
$title = "Ladders";
$html->drawHeader("$title | "._APPLICATION_TITLE);
if(isset($_POST["sign_in"]))
{
	// invoke register user function
	UsersController::login();
}
$logged_in = UsersController::user_logged_in();

		$html->drawBanner($title);
		if(!$logged_in){
			$html->drawLoginForm($_SERVER['PHP_SELF']);
		}
		else
		{ ?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="logout.php">Sign out</a></div>		
		</div>	
		<?php } ?>
	
	<div style="padding: 10px;">
		<h2>The fastest and the strongest:</h2>
		<form action="ladder.php" accept-charset="utf-8" method="post">
			<fieldset style="width:500px;">
				<label style="float:left; width:100px; clear:both;">Exercise type:</label> 
				<select name="type" style="float:left; width:300px;">
					<?php 
					ExerciseTypes::draw_options(-1);
					?>
					<option value="0">All types</option>
					<option value="1">Erg</option>
					<option value="2">Run</option>
					<option value="3">Row</option>
					<option value="4">Cycle</option>
				</select>
				<label style="float:left; width:100px; clear:both;">for Period:</label> 
				<select name="period" style="float:left; width:300px;">
					<option value="0">Today</option>
					<option value="1">Yesterday</option>
					<option value="2">Week</option>
					<option value="3">Month</option>
					<option value="4">Year</option>
					<option value="5">Ever</option>
				</select>
				<label style="float:left; width:100px; clear:both;">for distance:</label> 
				<input name="distance" style="float:left; width:200px;" type="text" value=""/>
				<label style="float:left;">meters</label>
				<label style="float:left; width:100px; clear:both;">for time:</label> 
				<input name="time" style="float:left; width:200px;" type="text" value=""/>
				<label style="float:left;">minutes</label>	
				<br style="clear:both;"/>
				<input style="clear:both;" type="submit" name="s_best" value="Find" />
			</fieldset>
		</form>
	</div>
		
	<div style="float:left; padding: 10px; width:500px; border: dashed 1px blue;">
		<h2>Top 12:</h2>
		<ul>
	<?php 
		$ex_sessions = ExerciseController::top(12,$_POST['type'],$_POST['period'],$_POST['distance'],$_POST['time']);
		foreach($ex_sessions as $value)
		{
			echo "\t\t\t<li><a href='workout.php?exercise={$value->get("id")}'>{$value->get("description")}, {$value->get("distance")}, {$value->get("city")}</a></li>\n";
		}
	?>
		</ul>
	</div>
<?
$html->footer(true); 
?>