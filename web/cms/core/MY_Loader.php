<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

	/**
	 * g3n1k was here
	 *
	 * overide view to get
	 */
	public function view($view, $vars = array(), $return = FALSE) {

		list($path, $_view) = $this->get_template_view($view);

		if ($path == FALSE) list($path, $_view) = Modules::find($view, $this->_module, 'views/');

		if ($path != FALSE) {

			$this->_ci_view_paths = array($path => TRUE) + $this->_ci_view_paths;

			$view = $_view;
		}

		/*
		//buat yg sampai baca kode ini, pelajari dump value2 ini
		dump('===========================================================','separate'); // line
		dump($this->_module,'module'); // pages
		dump($path, 'path'); // cms/modules/pages/views/
		dump($this->_ci_view_paths, 'ci_view_path'); //["cms/modules/pages/views/"] => bool(true) ["cms/views/"] => bool(true)
		dump($view, 'view'); // mainpage
		/**/

		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
	}

	public function get_template_view($view){

		$template = (is_login('group_name') !== 'admin' ? get_option('template') : get_option('admin_template'));
		// buat template
        //
        //dump($template, '$template');
		$path = TEMPLATE_DIR.$template.'/';
		#dump($path.$view.EXT, '$path.$view.EXT 1');
		if(is_file($path.$view.EXT)) return array($path, $view);

		// buat module load view module sendiri
		$path .= 'modules/'.$this->_module.'/';
		#dump($path.$view.EXT, '$path.$view.EXT 2');
		if(is_file($path.$view.EXT)) return array($path, $view);

		// buat module load view module lain
		$path = TEMPLATE_DIR.$template.'/modules/';
		#dump($path.$view.EXT, '$path.$view.EXT 2');
		if(is_file($path.$view.EXT)) return array($path, $view);

		return array(FALSE, $view);	
	}
}
