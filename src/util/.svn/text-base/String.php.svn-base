<?php
/**
 * /fitness/src/util/String.php
 *
 * THe idea here is to provide string functions.
 * @copyright James Little Ltd. 2008
 *
 * Date: Oct 9, 2008 9:43:04 PM
 * Author: james 
 *
 * $Id: String.php 32 2009-03-12 02:07:49Z alphafoobar $
 */
class String
{
	// Resolve the class type
	public $class = "String";

	public function __construct(){}
	
	
	/**
	 * Generate a random length string of between $min and $max length.
	 *
	 * @param int $min
	 * @param int $max
	 * @return string
	 */
	public static function random_string($min, $max)
	{
		// construct our input string.
		$input = "abcdefghijklmnopqrstuvwxyz".
			"ABCDEFGHIJKLMNOPQRSTUVWXYZ".
			"0123456789".
			"~!@%^*()_-+{}[]|:;,.";
		$result = "";
		$in_len = strlen($input);
		$max = mt_rand($min, $max);
		$i = 0;
		while($i++<$max)
		{
			$result .= substr($input,mt_rand(0, $in_len), 1);
		}
		return $result;
	}
}

// functional test
// echo FString::random_string(96,128)."\n";
?>