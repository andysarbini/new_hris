<?php 
if ( ! function_exists('gen_user_pass'))
{
	function gen_user_pass($pass)
	{
		$CI =& get_instance();
		
		$CI->config->load('user/user');
		
		return md5($pass. $CI->config->item('hash'));
	}
}
