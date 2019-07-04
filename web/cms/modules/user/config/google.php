<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	this config for google authentication developer
 */ 
$config['google_id'] = array(
		
		'clientId' 		=> '87559158167-pi3ptpd1u5vcf40c8it437o7tjugc5vi.apps.googleusercontent.com',
		
		'clientSecret' 	=> 'CFFMfimskK-jZPriiqTnxrJb',
		
		'redirectUri' 	=> 'http://localhost:8081/user/otentication/google',
		
		'developerKey' 	=> 'AIzaSyCcVI3ZFbq43yEujbLLiLirCVVHsz2ULnI',
		
		'scope'	=> array(
			'https://www.googleapis.com/auth/plus.me',
			'https://www.googleapis.com/auth/userinfo.email',
			'https://www.googleapis.com/auth/userinfo.profile'
		)
		
);