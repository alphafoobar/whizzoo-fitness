<?php
/**
 * logout.php
 * [view]
 * 
 * $Id: logout.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

include_once 'imports.php';

// headers need to be drawn first thing in the morning.
$html->drawHeader("fitness online v0.1");

// invoke register user function
UsersController::logout();

echo "<!-- looping though input \n";
foreach($_POST as $key => $value)
{
	echo "_POST[$key]=$value\n";
}
echo "--> \n";
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
				<span style="width:13px;"><img src="images/lightstar.png" alt="you are in the profile section" width="13" height="13"/></span>
			</span>
			
		</div>
		<?php 
			if(UsersController::user_logged_in()) 
			{
			?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="login.html">Sign out</a></div>
	</div>
	<div style="padding: 10px;">
		You are logged in...
	</div>
				<?php			
			}
			// perhaps they are already a user, show sign in prompt
			else
			{
			
		?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Already a user? 
			<a href="login.html">Sign in</a></div>
	</div>	
	<div style="padding: 10px;">
		You are logged out!
	</div>

	
<?php 
} // end else block
$html->footer(); ?>