<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class captcha extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	function index()
	{
		//Let's generate a totally random string using md5
		$md5 = md5(rand(0,999));
		//We don't need a 32 character long string so we trim it down to 5
		$pass = substr($md5, rand(0,27), 5);
		
		// set to session
		$this->session->set_userdata('captcha_word',$pass);
		
		//Set the image width and height
		$width = 100;
		$height = 20;
	
		//Create the image resource
		$image = ImageCreate($width, $height);
	
		//We are making three colors, white, black and gray
		$white = ImageColorAllocate($image, 255, 255, 255);
		$black = ImageColorAllocate($image, 0, 0, 0);
		$grey = ImageColorAllocate($image, 153, 153, 153);
	
		//Make the background black
		ImageFill($image, 0, 0, $white);
	
		
		//Throw in some lines to make it a little bit harder for any bots to break
		ImageRectangle($image,0,0,$width-1,$height-1,$white);
		imageline($image, 0, $height/2, $width, $height/2, $white);
		imageline($image, $width/2, 0, $width/2, $height, $white);
	
		//Add randomly generated string in white to the image
		ImageString($image, 7, 30, 3, $pass, $grey);
	
		//Tell the browser what kind of file is come in
		header("Content-Type: image/jpeg");
	
		//Output the newly created image in jpeg format
		ImageJpeg($image);
		 
		//Free up resources
		ImageDestroy($image);
	
		exit();
	}
}