<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gubun extends CI_Controller {
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
		$this->load->model("gubun_m");
		$this->load->helper(array("url","date"));
		$this->load->library("pagination");
	}
	
	// gubun Controller Default	
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
			$base_url = "/gubun/lists/page";
		else 
			$base_url = "/gubun/lists/text1/$text1/page";
		$page_segment = substr_count(substr($base_url, 0, strpos($base_url, "page")), "/")+1;

		$config["per_page"] = 5;
		$config["total_rows"] = $this->gubun_m->rowcount($text1);
		$config["url_segment"] = $page_segment;
		$config["base_url"] = $base_url;
		$this->pagination->initialize($config);

		$data["page"] = $this->uri->segment($page_segment,0);
		$data["pagination"] = $this->pagination->create_links();

		$start = $data["page"];
		$limit = $config["per_page"];

		$data["text1"] = $text1;
		$data["lists"] = $this->gubun_m->getlist($text1, $start, $limit);

		$this->load->view("main_header");
		$this->load->view("gubun_list", $data);
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
		$data['row']=$this->gubun_m->getrow($no);

		$this->load->view("main_header");
		$this->load->view("gubun_view", $data);
		$this->load->view("main_footer");
	}
	
	// 구분 삭제
	public function del()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$no = array_key_exists("no", $uri_array) ? $uri_array["no"]:"";
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->gubun_m->deleterow($no);

		redirect("/gubun/lists".$text1.$page);
	}

	// 구분 추가 
	public function add()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->load->library("form_validation");

		$this->form_validation->set_rules("name", "이름", "required|max_length[20]");

		// if(!$_POST) // 구분 목록에서 오는 경우
		if($this->form_validation->run()==FALSE) // 구분 목록에서 오는 경우
		{
			$this->load->view("main_header");
			$this->load->view("gubun_add");
			$this->load->view("main_footer");
		}
		else // 구분정보 입력폼에서 오는 경우 
		{
			$data = array(
				'name' => $this->input->post("name", TRUE)
			);
			$result = $this->gubun_m->insertrow($data);
			
			redirect("/gubun/lists".$text1.$page);
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

		$this->form_validation->set_rules("name", "이름", "required|max_length[20]");

		// if(!$_POST) // 구분 목록에서 오는 경우
		if($this->form_validation->run()==FALSE) // 구분 목록에서 오는 경우
		{
			$this->load->view("main_header");
			$data['row']=$this->gubun_m->getrow($no);
			$this->load->view("gubun_edit", $data);
			$this->load->view("main_footer");
		}
		else // 구분정보 입력폼에서 오는 경우 
		{
			$data = array(
				'name' => $this->input->post("name", TRUE)
			);
			$result = $this->gubun_m->updaterow($data, $no);
				
			redirect("/gubun/lists".$text1.$page);
		}
	}
}
