<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph extends CI_Controller {
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
		$this->load->model("graph_m");
		$this->load->helper(array("url","date"));
		date_default_timezone_set("Asia/Seoul");
	}
	
	// graph Controller Default	
	public function index()
	{
		// 구분 목록
		$this->lists();
	}

	// 구분 목록
	public function lists()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]): date("Y-m-d", strtotime("-1 month"));
		$text2 = array_key_exists("text2", $uri_array) ? urldecode($uri_array["text2"]): date("Y-m-d");

		$data["rowcount"] = $this->graph_m->rowcount($text1, $text2);
		$data["text1"] = $text1;
		$data["text2"] = $text2;
		$data["lists"] = $this->graph_m->getlist($text1, $text2);

		$this->load->view("main_header");
		$this->load->view("graph_list", $data);
		$this->load->view("main_footer");
	}
}
