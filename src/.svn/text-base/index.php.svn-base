<?php
/**
 * index.php
 * [view]
 * HI, Welcome to James Little's Fitness Program online.
 * 
 * $Id: index.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

include_once 'imports.php';

// headers need to be drawn first thing in the morning.
$html->drawHeader("fitness online v0.1");

// actually would rather forward to the correct page if not logged in.

// would want the banner to be in common lib... drawn with header?
?>
	<div id="banner_shadow">
		<div id="banner">
			<!--  banner  -->
			<div class="header">
				<span style="font-size: 14px; font-style:italic;">your</span>
				<span style="font-size: 36px;">fitness</span>
				<span style="font-size: 14px; font-style:italic;">complete and online</span>
			</div>
			<!-- link tabs -->
			<span class="tabs"><a href="workout.php">training</a>
				<span style="width:13px;"> </span>
			</span>
			<span class="tabs"><a href="ladder.html">ladder</a>
				<span style="width:13px;"> </span>
			</span>
			<span class="tabs"><a href="settings.html">settings</a>
				<span style="width:13px;"> </span>
			</span>
			<span class="tabs">
				<a href="register.php">profile</a>
				<span style="width:13px;"> </span>
			</span>
			
		</div>
		<?php if(UsersController::user_logged_in()) { 
		// logged in user? 
		?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="logout.php">Sign out</a></div>
	</div>	
		<?php } else { 
		// not logged in
			?>			
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Already a user? <a href="login.html">Sign in</a></div>
	</div>	
	
	<div style="float:right; margin:2px; padding:0; ">
		<form accept-charset="utf-8" method="post">
			<fieldset style="border:0;">
				<input style="float:left; width:100px; margin-right: 5px;" type="text" name="email"/>
				<input style="float:left; width:100px; margin-right: 5px;" type="password" name="password"/>
				<input style="float:right; margin-right: 5px" type="submit"  name="sign_in" value="Sign in" />
			</fieldset>
		</form>
	</div>	
	
	From here you can choose workouts to add a new workout, ladder to see who is
	the fastest or fittest, or settings to change how things work. Your profile
	shows the world what you have been doing and how it feels.
		<?php } 

$html->footer(); 

?>