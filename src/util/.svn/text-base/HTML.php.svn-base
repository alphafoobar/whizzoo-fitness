<?php
/**
 * util/HTML.php
 * [utility]
 * We'll use these functions to draw basic HTML. Create an instance for logging.
 * $Id: HTML.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
// use this to count queries
$_sql_counter = 0;
class HTML
{

	// Resolve the class type
	public $class = "HTML";
	private $timer;
	
	
	/**
	 * Start timer and session... but don't draw the header.
	 */
	public function __construct()
	{
		session_start();
		$this->timer = microtime();
	}
	
	/**
	 * Draw header information, needs to be done almost immediately.
	 *
	 * @param string $title the title of the page.
	 * @param boolean redirect if 
	 */
	public function drawHeader($title, $redirect=null)
	{
		if($redirect)
		{
			// redirect? if user not logged in.. or some other reason?
			$host = $_SERVER['HTTP_HOST'];
			$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			header("Location: http://$host$uri/$redirect");
		}
		
		// presuming UTF-8 is what we are using!!
		header("content-type: text/html; charset: utf-8");
				
		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" charset="utf-8" media="screen" type="text/css"></link>
<title><?php echo _($title); ?></title>
</head>
<body onunload="GUnload()">
		<?php
	}
	
	/**
	 * We'll be putting google analytics here as well
	 *
	 */
	public function footer($maps = false, $location = null, $path = null)
	{
		global $_sql_counter;
    	// timing info:
		$this->timer = microtime() - $this->timer;
		$running_time = _("Running time").": {$this->timer} "._("seconds");
		$queries = _("Queries");
    	echo "
    <div id='footer' style='clear:all;'>{$running_time}<br/>
    	{$queries}: {$_sql_counter}
    </div>";
    
		/* load javascript at the end...  */
		if($maps)
		{
			?>
	<script src="http://maps.google.com/maps?file=api&amp;v=2.x&amp;key=@gmaps.key@" type="text/javascript"></script>    
	<script src="js/fitnessMaps.js" type="text/javascript"></script>
	<script type="text/javascript">
	<?php	
		if($location && $location->get('location_name')
			&& $location->get('lat') && $location->get('lng'))
		{
			$localStr = addslashes($location->get('location_name'));
			
			if($location->get('lat') && $location->get('lng'))
			{
		 		echo "initialize('{$localStr}', {$location->get('lat')}, {$location->get('lng')});\n";
			}
			else
			{
				echo "initialize();\n";
				echo "showAddress(document.getElementById('location_name').value);\n";
			}
		}
		else
		{
			echo "initialize();\n";
		}
		if($path)
		{
			// regex match all the points
			$regex = "/\-?[0-9]{0,3}\.[0-9]*\,\-?[0-9]{0,3}\.[0-9]*/";
        	preg_match_all($regex, $path, $matches);

	        // if there is some result... process it and return it
	        if(isset($matches[0]))
	        {
	        	foreach($matches[0] as $point)
	        	{
					echo "pathpoints.addPoint(new GLatLng($point));\n";
				}
	        } 
		}
	?>
    </script>
    <?php 
		} // end if: maps
    ?>
</body>
</html> <?php
	}	
	
	/**
	 * Draw the login form and send the user to back to where they came from.
	 *
	 * @param string $redirect
	 */
	public function drawLoginForm($redirect)
	{
		?>
	<div style="margin:2px; padding:0; ">
		<form accept-charset="utf-8" method="post" <?php if(isset($redirect)) echo "action=\"$redirect\"" ?>>
			<fieldset style="border:0;">
				<input style="float:left; width:100px; margin-right: 5px;" type="text" name="email"/>
				<input style="float:left; width:100px; margin-right: 5px;" type="password" name="password"/>
				<input style="float:right; margin-right: 5px" type="submit"  name="sign_in" value="Sign in" />
			</fieldset>
		</form>
	</div>	
		<?php
	}
	
	public function drawBanner($current)
	{
		$pages = array(
			"workouts" => "workout.php",
			"ladder" => "ladder.php",
			"settings" => "settings.php",
			"profile" => "profile.php",
			"blog" => "blog.php"
		);
		?>
	<div id="banner_shadow">
		<div id="banner">
			<div class="header">
				<span style="font-size: 14px; font-style:italic;">your</span>
				<span style="font-size: 36px;">fitness</span>
				<span style="font-size: 14px; font-style:italic;">complete and online</span>
			</div>
			<?php
			foreach($pages as $title => $link)
			{
				$selected = "";
				if($current == $title)
				{
					$selected = "<img src=\"images/lightstar.png\" alt=\"you are viewing the $title\" width=\"13\" height=\"13\"/>";
				}
				echo "
			<span class=\"tabs\"><a href=\"$link\">$title</a>
				<span style=\"width:13px;\"> $selected </span>
			</span>";
			}
			?>			
		</div>
		<?php
	}
}
?>