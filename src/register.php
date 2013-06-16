<?php
/**
 * register.php
 * [view]
 * This is an interface that clients trying to register a person will enter through.
 * $Id: register.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

include_once 'imports.php';

// headers need to be drawn first thing in the morning.
$html->drawHeader("register | fitness online v0.1");
 
function registerUser()
{
	// the start of the function should set up recording metrics
	// and transaction wrappers
		
	if(isset($_POST['register']))
	{

		// must check location is new
		// Location::newLocation(_POST['location'],
		// create User object
		// validate the User object
		
		// invoke register user function
		return UsersController::register();
	}
	else
	{
		// passwords either don't exist or are wrong.
	}
	// the end of the function should catch any exceptions
	// close connections
	// tidy up transactions and recording metrics
	return false;
}

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
			// logged in user?
			// if the user is logged in, then why are we here? Let them edit their profile
			if(registerUser())
			{
				UsersController::login();
			?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="logout.php">Sign out</a></div>
	</div>
	<div style="padding: 10px;">
		You are now logged in...
	</div>
				<?php	
			} 
			elseif(UsersController::user_logged_in()) 
			{
			?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="logout.php">Sign out</a></div>
	</div>
	<div style="padding: 10px;">
		You are already logged in...
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
	
	<div style="float:right; margin:2px; padding:0; ">
		<form action="index.php" accept-charset="utf-8" method="post">
			<fieldset style="border:0; width:500px;">
				<label style="float:left; width:87px; clear:both;">name</label> <input type="text" name="username" style="float:left; width:100px; margin-right: 5px;"/>
				<label style="float:left; width:87px; clear:both;">email</label> <input type="text" name="email" style="float:left; width:100px; margin-right: 5px;"/>
				<label style="float:left; width:87px; clear:both;">password</label> <input type="password" name="password" style="float:left; width:100px; margin-right: 5px;"/>
				<input style="float:right; margin-right: 5px" type="submit" name="login" value="Sign in" />
			</fieldset>
		</form>
	</div>
	<div style="padding: 10px;">
		<h2>Register:</h2>
		<form action="register.php" accept-charset="utf-8" method="post">
			<fieldset style="width:500px;">
				<label style="float:left; width:87px; clear:both;">name:</label> 
				<span style="float:left; width:13px;"><img src="images/darkstar.png" alt="*A* name is required" width="13" height="13"/></span>
				<input style="float:left; width:300px;" name="name"/>
				
				<label style="float:left; width:87px; clear:both;">email:</label> 
				<span style="float:left; width:13px;"><img src="images/darkstar.png" alt="email is required" width="13" height="13"/></span>
				<input style="float:left; width:300px;" name="email"/>
				
				<label style="float:left; width:87px; clear:both;">password:</label> 
				<span style="float:left; width:13px;"><img src="images/darkstar.png" alt="email is required" width="13" height="13"/></span>
				<input style="float:left; width:300px;" type="password" name="password"/>
				
				<label style="float:left; width:87px; clear:both;">password again:</label> 
				<span style="float:left; width:13px;"><img src="images/darkstar.png" alt="email is required" width="13" height="13"/></span>
				<input style="float:left; width:300px;" type="password" name="password2"/>
				
				<label style="float:left; width:100px; clear:both;">about me:</label> 
				<textarea style="float:left; width:300px;" name="aboutme"></textarea>
				
				<!-- label style="float:left; width:100px; clear:both;">photo:</label> 
				<input style="float:left; width:200px;" type="file" name="photo"/ -->
				
				<fieldset style="float:left; clear:both; border:0; padding:0; margin:0;" >
					<label style="float:left; width:100px;">location:</label> 
					<input style="float:left; width:300px;" name="location" id="location"/><input style="float:left;" type="button" value="find" onclick="showAddress(document.getElementById('location').value); return false;"/>
				</fieldset>

				<br style="clear:both"/><br/>
				<div style="width:500px; height: 300px; background-color: #f4d7d7;" id="map_canvas"></div>
				<br/>
				
				<input style="clear:both;" type="submit" name="register" value="Register" />
			</fieldset>
		</form>
	</div>
	
<?php 
} // end else block
$html->footer(); ?>