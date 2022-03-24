<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public $data;
	/*
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model("login_m");
		$this->load->helper(array("url","date"));
	}
	
	// login Controller Default	
	public function index()
	{
	}
	
	public function check()
	{
		$uid = $this->input->post("uid", TRUE);
		$pwd = $this->input->post("pwd", TRUE);

		$row = $this->login_m->getrow($uid, $pwd);
		if ($row) 
		{
			$data = array(
				"uid" => $row->uid,
				"rank" => $row->rank
			);
			$this->session->set_userdata($data);
		}

		$this->load->view("main_header");
		$this->load->view("main_footer");
	}

	public function logout()
	{
		$data = array('uid', 'rank');
		$this->session->unset_userdata($data);

		$this->load->view("main_header");
		$this->load->view("main_footer");
	}
}
