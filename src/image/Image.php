<?php
/**
 * image/Image.php
 * [model]
 * The Location class manages data and contains validation rules.
 * $Id: Image.php 32 2009-03-12 02:07:49Z alphafoobar $
 */

class Image
{ 
	var $name = 'Image';
	
	var $validate = array(
		'photoname' => '/^.{3,100}$/'
	);
	
	private $thumb;	
	private $photo;	
	private $photoname;	
	private $photoimage;	
	private $photolocation;
}
?>