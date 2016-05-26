<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('example.php',$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		//$this->site_url('examples/absensi');
		//$this->load->helper('url');
		redirect('examples/presensi');
	}

	public function presensi()
	{
		try{
			$crud = new grocery_CRUD();
			
			//$crud->set_relation_n_n('angkatan', 'presense_angkatan', 'year', 'presensi_id', 'year_id', 'name');
			//$crud->set_relation_n_n('jurusan', 'presense_jurusan', 'jurusan', 'presensi_id', 'jurusan_id', 'name');
			
			$crud->set_relation('angkatan','year','name');
			$crud->set_relation('jurusan','jurusan','name');
			
			$crud->set_theme('datatables');
			$crud->set_table('presensi');
			$crud->set_subject('Presensi');
			$crud->columns('presense_id','name','nim','jurusan','angkatan');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
			}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}	
	}
	
}