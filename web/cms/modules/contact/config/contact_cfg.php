<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
#$config['mail_cfg'] = array('useragent'=>);
$config['mail_cfg'] = array(
    'protocol' => 'mail',
    'useragent'=> 'Squareteam CMS',
    'mailtype'  => 'html',
    'wordwrap'=> TRUE,
    'charset'   => 'utf-8',
    'mailpath'	=> "/usr/sbin/sendmail -t -i"
);
