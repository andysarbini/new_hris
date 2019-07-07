<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['404_override'] = '_404';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = "dashboard";
$route['404_override'] = '';

/* Location: ./application/config/routes.php */
$route['logout'] 	= 'user/logout';
$route['login'] 	= 'user/login';
#$route['([a-zA-Z_-]+)/admin/add']		= '$1/admin/add_edit';
#$route['([a-zA-Z_-]+)/admin/edit/(:any)']		= '$1/admin/add_edit/$2';

/* routes from pyrocms, for admin */
$route['admin/([a-zA-Z_-]+)']			= '$1/admin/index';
$route['admin/([a-zA-Z_-]+)/add']		= '$1/admin/add_edit';
$route['admin/([a-zA-Z_-]+)/edit/(:any)']	= '$1/admin/add_edit/$2';
$route['admin/([a-zA-Z_-]+)/(:any)']	= '$1/admin/$2';

// override halaman pages -> http://localhost:8081/hmvc_rafa/pages/home
$route['pages/(:any)']			=  'pages/index/$1';

$route['unduhformulir'] 	= 'dashboard/news/98';				// show module unduhformulir
$route['bblearning'] 		= 'dashboard/bblearning';			// module bblearning
$route['bblearning/(:any)'] = 'dashboard/bblearning/$1';		// detail content bb learning
$route['category/(:any)'] 	= 'dashboard/category/$1';			// lihat seluruh category content
$route['view/(:any)'] 		= 'dashboard/view/$1';				// detail content
$route['gallery'] 		    = 'dashboard/gallery';			    // module gallery
$route['gallery/(:any)']    = 'dashboard/gallery_detail/$1';    // detail content gallery
$route['birdbagi-forum'] 		= 'dashboard/forum';			// module Forum
$route['birdbagi-forum/(:any)'] = 'dashboard/forum/$1';		    // detail content Forum
$route['submit-posting-diskusi']= 'dashboard/submit_posting_topic_forum'; // Posting Forum
$route['delete-topic-forum/(:num)'] = 'dashboard/delete_topic_forum/$1';  // Delete Posted Forum$route['news'] 		           = 'news/index';			    // module Artikel Berita
$route['news'] 		           = 'dashboard/news';		        // module Artikel Berita
$route['news/(:any)'] 		   = 'dashboard/news/$1';		    // module kategori Artikel Berita
$route['news/(:any)/(:id)']    = 'dashboard/news/$1/$1';        // detail Artikel Berita

//$route['cuti']				= 'content/view/formulir-cuti/single';

$route['search']			= 'search/index';
$route['search/(:num)']		= 'search/index/$1';
$route['ajax_pagination_newsfeed'] = 'ajax/ajax_pagination_newsfeed';
$route['ajax_pagination_newsfeed/(:num)'] = 'ajax/ajax_pagination_newsfeed/$1';
$route['ajax_pagination_files/(:any)'] = 'ajax/ajax_pagination_files/$1';
$route['ajax_pagination_files/(:any)/(:num)'] = 'ajax/ajax_pagination_files/$1/$1';
$route['ajax_pagination_videos/(:any)'] = 'ajax/ajax_pagination_videos/$1';
$route['ajax_pagination_videos/(:any)/(:num)'] = 'ajax/ajax_pagination_videos/$1/$1';
$route['ajax_pagination_gallery/(:any)/(:any)'] = 'ajax/ajax_pagination_gallery/$1';
$route['ajax_pagination_gallery/(:any)/(:any)/(:num)'] = 'ajax/ajax_pagination_gallery/$1/$1';
$route['ajax_pagination_gallery/(:any)/(:any)/(:any)/(:num)'] = 'ajax/ajax_pagination_gallery/$1/$1/$1';

$route['ajax_get_picture/(:num)'] = 'ajax/ajax_get_picture/$1';
$route['ajax_pagination_forum/(:any)/(:any)/(:num)'] = 'ajax/ajax_pagination_forum_topic/$1/$1/$1';
$route['ajax_pagination_forum/(:num)/(:any)/(:num)'] = 'ajax/ajax_pagination_forum_topic/$1/$1/$1';
$route['ajax_pagination_mytopic/(:num)'] = 'ajax/ajax_pagination_mytopic/$1';

$route['ajax_pagination_news'] = 'ajax/ajax_pagination_news';
$route['ajax_pagination_news/(:any)'] = 'ajax/ajax_pagination_news/$1';
$route['ajax_pagination_news/(:any)/(:num)'] = 'ajax/ajax_pagination_news/$1/$1';
