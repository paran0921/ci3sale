<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jangbui extends CI_Controller {
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
		$this->load->model("jangbui_m");
		$this->load->helper(array("url","date"));
		$this->load->library("pagination");
		date_default_timezone_set("Asia/Seoul");
	}
	
	// jangbui Controller Default	
	public function index()
	{
		// 구분 목록
		$this->lists();
	}

	// 구분 목록
	public function lists()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]): date("Y-m-d");

		$base_url = "/jangbui/lists/text1/$text1/page";
		$page_segment = substr_count(substr($base_url, 0, strpos($base_url, "page")), "/")+1;

		$config["per_page"] = 5;
		$config["total_rows"] = $this->jangbui_m->rowcount($text1);
		$config["url_segment"] = $page_segment;
		$config["base_url"] = $base_url;
		$this->pagination->initialize($config);

		$data["page"] = $this->uri->segment($page_segment,0);
		$data["pagination"] = $this->pagination->create_links();

		$start = $data["page"];
		$limit = $config["per_page"];

		$data["text1"] = $text1;
		$data["lists"] = $this->jangbui_m->getlist($text1, $start, $limit);

		$this->load->view("main_header");
		$this->load->view("jangbui_list", $data);
		$this->load->view("main_footer");
	}

	// 구분 보기 
	public function view()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$no = array_key_exists("no", $uri_array) ? $uri_array["no"]:"";
		$text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? urldecode($uri_array["page"]):"";

		$data["text1"] = $text1;
		$data["page"] = $page;
		$data['row']=$this->jangbui_m->getrow($no);

		$this->load->view("main_header");
		$this->load->view("jangbui_view", $data);
		$this->load->view("main_footer");
	}
	
	// 구분 삭제
	public function del()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$no = array_key_exists("no", $uri_array) ? $uri_array["no"]:"";
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->jangbui_m->deleterow($no);

		redirect("/jangbui/lists".$text1.$page);
	}

	// 구분 추가 
	public function add()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->load->library("form_validation");

		$this->form_validation->set_rules("writeday", "날짜", "required");
		$this->form_validation->set_rules("product_no", "제품명", "required");

		// if(!$_POST) // 구분 목록에서 오는 경우
		if($this->form_validation->run()==FALSE) // 구분 목록에서 오는 경우
		{
			// gubun list (selectbox > option)
			$data["list"] = $this->jangbui_m->getlist_product();

			$this->load->view("main_header");
			$this->load->view("jangbui_add", $data);
			$this->load->view("main_footer");
		}
		else // 구분정보 입력폼에서 오는 경우 
		{
			$data = array(
				'io' => 0,
				'writeday' => $this->input->post("writeday", TRUE),
				'product_no' => $this->input->post("product_no", TRUE),
				'price' => $this->input->post("price", TRUE),
				'numi' => $this->input->post("numi", TRUE),
				'numo' => 0,
				'prices' => $this->input->post("prices", TRUE),
				'bigo' => $this->input->post("bigo", TRUE)
			);

			$result = $this->jangbui_m->insertrow($data);
			
			redirect("/jangbui/lists".$text1.$page);
		}
	}

	// 구분 수정 
	public function edit()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$no = array_key_exists("no", $uri_array) ? $uri_array["no"]:"";
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->load->library("form_validation");

		$this->form_validation->set_rules("writeday", "날짜", "required");
		$this->form_validation->set_rules("product_no", "제품명", "required");

		// if(!$_POST) // 구분 목록에서 오는 경우
		if($this->form_validation->run()==FALSE) // 구분 목록에서 오는 경우
		{
			$data["list"] = $this->jangbui_m->getlist_product();

			$this->load->view("main_header");
			$data['row']=$this->jangbui_m->getrow($no);
			$this->load->view("jangbui_edit", $data);
			$this->load->view("main_footer");
		}
		else // 구분정보 입력폼에서 오는 경우 
		{
			$data = array(
				'io' => 0,
				'writeday' => $this->input->post("writeday", TRUE),
				'product_no' => $this->input->post("product_no", TRUE),
				'price' => $this->input->post("price", TRUE),
				'numi' => $this->input->post("numi", TRUE),
				'numo' => 0,
				'prices' => $this->input->post("prices", TRUE),
				'bigo' => $this->input->post("bigo", TRUE)
			);

			$result = $this->jangbui_m->updaterow($data, $no);
				
			redirect("/jangbui/lists".$text1.$page);
		}
	}
}
