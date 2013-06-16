<?php
/**
 * login.php
 * [view]
 * HI, Welcome to James Little's Fitness Program online.
 * 
 * $Id: login.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

include_once 'imports.php';

// headers need to be drawn first thing in the morning.
$html->drawHeader("fitness online v0.1", null);

// actually would rather forward to the correct page if not logged in.

$html->drawBanner($title);
?>
	
		<?php if(UsersController::user_logged_in()) { 
		// logged in user? 
		?>
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Welcome 
			<?php user_getName(true);?><a href="logout.php">Sign out</a></div>
	</div>	
	It appears you are already logged in.
		<?php } else { 
		// not logged in
			?>			
		<div style="text-align:right; color: #e3e2db; padding-right: 15px;">Already a user? <a href="login.php">Sign in</a></div>
	</div>		
		<?php
			$html->drawLoginForm($_GET["back"]);
		} 

$html->footer(); 

?>