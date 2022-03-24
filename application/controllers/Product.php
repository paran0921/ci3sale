<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
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
		$this->load->model("product_m");
		$this->load->helper(array("url","date"));
		$this->load->library("pagination");
		$this->load->library("upload");
		$this->load->library("image_lib");
	}
	
	// product Controller Default	
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
			$base_url = "/product/lists/page";
		else 
			$base_url = "/product/lists/text1/$text1/page";
		$page_segment = substr_count(substr($base_url, 0, strpos($base_url, "page")), "/")+1;

		$config["per_page"] = 5;
		$config["total_rows"] = $this->product_m->rowcount($text1);
		$config["url_segment"] = $page_segment;
		$config["base_url"] = $base_url;
		$this->pagination->initialize($config);

		$data["page"] = $this->uri->segment($page_segment,0);
		$data["pagination"] = $this->pagination->create_links();

		$start = $data["page"];
		$limit = $config["per_page"];

		$data["text1"] = $text1;
		$data["lists"] = $this->product_m->getlist($text1, $start, $limit);

		$this->load->view("main_header");
		$this->load->view("product_list", $data);
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
		$data['row']=$this->product_m->getrow($no);

		$this->load->view("main_header");
		$this->load->view("product_view", $data);
		$this->load->view("main_footer");
	}
	
	// 구분 삭제
	public function del()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$no = array_key_exists("no", $uri_array) ? $uri_array["no"]:"";
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->product_m->deleterow($no);

		redirect("/product/lists".$text1.$page);
	}

	// 구분 추가 
	public function add()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):"";

		$this->load->library("form_validation");

		$this->form_validation->set_rules("gubun_no", "구분명", "required");
		$this->form_validation->set_rules("name", "이름", "required|max_length[50]");
		$this->form_validation->set_rules("price", "단가", "required|numeric");

		// if(!$_POST) // 구분 목록에서 오는 경우
		if($this->form_validation->run()==FALSE) // 구분 목록에서 오는 경우
		{
			// gubun list (selectbox > option)
			$data["list"] = $this->product_m->getlist_gubun();

			$this->load->view("main_header");
			$this->load->view("product_add", $data);
			$this->load->view("main_footer");
		}
		else // 구분정보 입력폼에서 오는 경우 
		{
			$data = array(
				'gubun_no' => $this->input->post("gubun_no", TRUE),
				'name' => $this->input->post("name", TRUE),
				'price' => $this->input->post("price", TRUE),
				'jaego' => $this->input->post("jaego", TRUE)
			);

			$picname = $this->call_upload();
			if($picname) $data["pic"] = $picname;

			$result = $this->product_m->insertrow($data);
			
			redirect("/product/lists".$text1.$page);
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

		$this->form_validation->set_rules("gubun_no", "구분명", "required");
		$this->form_validation->set_rules("name", "이름", "required|max_length[50]");
		$this->form_validation->set_rules("price", "단가", "required|numeric");

		// if(!$_POST) // 구분 목록에서 오는 경우
		if($this->form_validation->run()==FALSE) // 구분 목록에서 오는 경우
		{
			$data["list"] = $this->product_m->getlist_gubun();

			$this->load->view("main_header");
			$data['row']=$this->product_m->getrow($no);
			$this->load->view("product_edit", $data);
			$this->load->view("main_footer");
		}
		else // 구분정보 입력폼에서 오는 경우 
		{
			$data = array(
				'gubun_no' => $this->input->post("gubun_no", TRUE),
				'name' => $this->input->post("name", TRUE),
				'price' => $this->input->post("price", TRUE),
				'jaego' => $this->input->post("jaego", TRUE),
			);

			$picname = $this->call_upload();
			if($picname) $data["pic"] = $picname;

			$result = $this->product_m->updaterow($data, $no);
				
			redirect("/product/lists".$text1.$page);
		}
	}

	// 이미지 파일 업로드
	public function call_upload()
	{
		$config['upload_path'] = './product_img/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
		$config['max_size'] = 10000000;
		$config['max_width'] = 10000;
		$config['max_height'] = 10000;
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('pic'))
		{
			$picname = "";
		}
		else
		{
			$picname = $this->upload->data("file_name");

			// thumb config
			$config['image_library'] = "gd2";
			$config['source_image'] = "./product_img/".$picname;
			$config['thumb_marker'] = "";
			$config['new_image'] = "./product_img/thumb";
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 200;
			$config['height'] = 150;
			$this->image_lib->initialize($config);

			$this->image_lib->resize();
		}

		return $picname;
	}

	// 재고 계산
	public function jaego()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? "/text1/".urldecode($uri_array["text1"]):"";
		$page = array_key_exists("page", $uri_array) ? "/page/".urldecode($uri_array["page"]):0;
		
		$data['text1'] = $text1;
		$data['page'] = $page;
		$this->product_m->cal_jaego();

		redirect("/product/lists" . $text1 . $page);
	}
}
