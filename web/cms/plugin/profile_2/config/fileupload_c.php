<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// variable untuk area 
// misal lat 6.832901 maka user yang berada di
// lat - lon_lat_r atau lat + lon_lat_r acceptable 
#$config['lon_lat_r']         = 0.000001;
$config['lon_lat_r']         = 0.0001;

$config['profilupload'] = array(
    'upload_path' => 'uploads',
    'allowed_types' => 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx',
    'encrypt_name' => false,
);