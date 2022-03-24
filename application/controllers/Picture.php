<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Picture extends CI_Controller {
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
		$this->load->model("picture_m");
		$this->load->helper(array("url","date"));
		$this->load->library("pagination");
		$this->load->library("upload");
	}
	
	// picture Controller Default	
	public function index()
	{
		// 구분 목록
		$this->lists();
	}

	// 구분 목록
	public function lists()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]):"";

		if ($text1 == "")
			$base_url = "/picture/lists/page";
		else 
			$base_url = "/picture/lists/text1/$text1/page";
		$page_segment = substr_count(substr($base_url, 0, strpos($base_url, "page")), "/")+1;

		$config["per_page"] = 5;
		$config["total_rows"] = $this->picture_m->rowcount($text1);
		$config["url_segment"] = $page_segment;
		$config["base_url"] = $base_url;
		$this->pagination->initialize($config);

		$data["page"] = $this->uri->segment($page_segment,0);
		$data["pagination"] = $this->pagination->create_links();

		$start = $data["page"];
		$limit = $config["per_page"];

		$data["text1"] = $text1;
		$data["lists"] = $this->picture_m->getlist($text1, $start, $limit);

		$this->load->view("main_header");
		$this->load->view("picture_list", $data);
		$this->load->view("main_footer");
	}

	// 제품 확대이미지
	public function zoom() 
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$iname = array_key_exists("iname", $uri_array) ? urldecode($uri_array["iname"]):"";
		$pname = array_key_exists("pname", $uri_array) ? urldecode($uri_array["pname"]):"";
		
		$data['iname'] = $iname;
		$data['pname'] = $pname;

		$this->load->view("main_header_nomenu");
		$this->load->view("picture_zoom", $data);
		$this->load->view("main_footer");
	}
}
