<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * di sini kita mendeklarasikan id provinsi & id_kab/kota 
 * yang menggunakan applikasi
 */ 
$config['propkab'] = array(
	'id_prop'	=> 0,		// 0 = seluruh propinsi
	'id_kab' => 0			// 0 = seluruh kabupaten kota dalam provinsi
);
