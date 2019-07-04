<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// make your password encrypted more strong
$config['hash'] = 'Your string Here.#to Make good stronG HaSH pa55word';

$config['redirect_after_login_admin'] = base_url().'admin';

$config['redirect_after_login_register'] = base_url().'register';

$config['redirect_after_logout'] = base_url().'login';

// login google
