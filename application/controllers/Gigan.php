<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
require_once __DIR__."/../libraries/PhpSpreadsheet/autoload.php";

class Gigan extends CI_Controller {
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
		$this->load->model("gigan_m");
		$this->load->helper(array("url","date"));
		$this->load->library("pagination");
		date_default_timezone_set("Asia/Seoul");
	}
	
	// gigan Controller Default	
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
		$text3 = array_key_exists("text3", $uri_array) ? urldecode($uri_array["text3"]): "0";

		$base_url = "/gigan/lists/text1/$text1/text2/$text2/text3/$text3/page";
		$page_segment = substr_count(substr($base_url, 0, strpos($base_url, "page")), "/")+1;

		$config["per_page"] = 5;
		$config["total_rows"] = $this->gigan_m->rowcount($text1, $text2, $text3);
		$config["url_segment"] = $page_segment;
		$config["base_url"] = $base_url;
		$this->pagination->initialize($config);

		$data["page"] = $this->uri->segment($page_segment,0);
		$data["pagination"] = $this->pagination->create_links();

		$start = $data["page"];
		$limit = $config["per_page"];

		$data["text1"] = $text1;
		$data["text2"] = $text2;
		$data["text3"] = $text3;
		$data["lists"] = $this->gigan_m->getlist($text1, $text2, $text3, $start, $limit);
		$data["list_product"] = $this->gigan_m->getlist_product();

		$this->load->view("main_header");
		$this->load->view("gigan_list", $data);
		$this->load->view("main_footer");
	}

	// Excel
	public function excel()
	{
		$uri_array = $this->uri->uri_to_assoc(3);
		$text1 = array_key_exists("text1", $uri_array) ? urldecode($uri_array["text1"]): date("Y-m-d", strtotime("-1 month"));
		$text2 = array_key_exists("text2", $uri_array) ? urldecode($uri_array["text2"]): date("Y-m-d");
		$text3 = array_key_exists("text3", $uri_array) ? urldecode($uri_array["text3"]): "0";
		$page = array_key_exists("page", $uri_array) ? "/page/" . urldecode($uri_array["page"]): 0;
		
		$count = $this->gigan_m->rowcount($text1, $text2, $text3);
		$list = $this->gigan_m->getlist_all($text1, $text2, $text3);
		
		// 엑셀 클래스 변수 선언
		$sheet = new Spreadsheet();

		// 각 컬럼 (너비, 정렬)
		$sheet->getActiveSheet()->getColumnDimension("A")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("B")->setWidth(25);
		$sheet->getActiveSheet()->getColumnDimension("C")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("D")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("E")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("F")->setWidth(12);
		$sheet->getActiveSheet()->getColumnDimension("G")->setWidth(12);

		$sheet->getActiveSheet()->getStyle("A")->getAlignment()->setHorizontal("center");
		$sheet->getActiveSheet()->getStyle("B")->getAlignment()->setHorizontal("left");
		$sheet->getActiveSheet()->getStyle("C:F")->getAlignment()->setHorizontal("right");
		$sheet->getActiveSheet()->getStyle("G")->getAlignment()->setHorizontal("left");

		// 제목 (글자 크기, 굵게)
		$sheet->setActiveSheetIndex(0)->setCellValue("A1", "매출입장");
		$sheet->getActiveSheet()->getStyle("A1")->getFont()->setSize(13);
		$sheet->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

		// 기간 (정렬)
		$sheet->setActiveSheetIndex(0)->setCellValue("G1", "기간: " . $text1 . "-" . $text2);
		$sheet->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal("right");

		// 2행 : 헤더 가운데 정렬
		$sheet->getActiveSheet()->getStyle("A2:G2")->getAlignment()->setHorizontal("center");
		// 헤더 배경색 (밝은 회색)
		$sheet->getActiveSheet()->getStyle("A2:G2")->getFill()
			 ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
             ->getStartColor()->setARGB("FFCCCCCC");

		// 헤더 글자 출력
		$sheet->setActiveSheetIndex(0)
			->setCellValue("A2", "날짜")
			->setCellValue("B2", "제품명")
			->setCellValue("C2", "단가")
			->setCellValue("D2", "매입수량")
			->setCellValue("E2", "매출수량")
			->setCellValue("F2", "금액")
			->setCellValue("G2", "비고");

		// 3행 부터 자료 출력
		$i=3;
		foreach ($list as $row)
		{
			$sheet->setActiveSheetIndex(0)
				->setCellValue("A$i", $row->writeday)
				->setCellValue("B$i", $row->product_name)
				->setCellValue("C$i", $row->price ? $row->price : "")
				->setCellValue("D$i", $row->numi ? $row->numi : "")
				->setCellValue("E$i", $row->numo ? $row->numo : "")
				->setCellValue("F$i", $row->prices ? $row->prices : "")
				->setCellValue("G$i", $row->bigo);
			$i++;
		}

		$sheet->setActiveSheetIndex(0);

		// 파일 이름 생성
 		$fname = "매출입장(".$text1."_".$text2.").xlsx";	
		// UTF-8 -> EUC-KR 로 변환
		$fname = iconv("UTF-8", "EUC-KR", $fname);
		header("Content-Type: application/vnd.ms-excel");
		// header("Content-Disposition: attachment:filename=$fname");
		// header("Content-Disposition: attachment:filename=매출입장.xlsx");
		header('Content-Disposition: attachment;filename="'.$fname.'"');
		header("Cache-Control: max-age=0");
		header("Cache-Control: max-age=1");
		// Redirect output to a client’s web browser (Xlsx)
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment;filename="01simple.xlsx"');
		// header('Content-Disposition: attachment;filename="'.$fname.'"');
		// header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		// header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		// header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		// header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		// header('Pragma: public'); // HTTP/1.0

		// xlsx 형식으로 파일 출력
		$writer = IOFactory::createWriter($sheet, "Xlsx");
		$writer->save("php://output");
		exit;
	}
}
