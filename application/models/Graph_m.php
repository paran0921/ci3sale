<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph_m extends CI_Model {

	public function getlist($text1, $text2)
	{
		
		// $sql = " select gubun.name as gubun_name, count(jangbu.numo) as cnumo 
		// 		from (gubun right join product on gubun.no = product.gubun_no)
		//			right join jangbu on product.no=jangbu.product_no
		// 		where jangbu.io = 1 and jangbu.writeday between '$text1' and '$text2' 
		// 		group by gubun.name 
		// 		order by cnumo DESC limit 10 ";
		
		$where = array("jangbu.io"=>1, "jangbu.writeday BETWEEN '$text1' AND '$text2'");
		return $this->db
			->limit(14)
			->group_by('gubun_name')
			->order_by('cnumo', 'DESC')
			->select('gubun.name as gubun_name, count(jangbu.numo) as cnumo')
			->join('product', 'gubun.no = product.gubun_no', 'right')
			->join('jangbu', 'product.no = jangbu.product_no', 'right')
			->get_where('gubun', $where)->result();
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1, $text2)
	{
		// $sql = " select gubun.name as gubun_name, count(jangbu.numo) as cnumo 
		// 		from (gubun right join product on gubun.no = product.gubun_no)
		//			right join jangbu on product.no=jangbu.product_no
		// 		where jangbu.io = 1 and jangbu.writeday between '$text1' and '$text2' 
		// 		group by gubun.name 
		// 		limit 10 ";
		
		$where = array("jangbu.io"=>1, "jangbu.writeday BETWEEN '$text1' AND '$text2'");
		return $this->db
			->limit(14)
			->group_by('gubun_name')
			->select('gubun.name as gubun_name, count(jangbu.numo) as cnumo')
			->join('product', 'gubun.no = product.gubun_no', 'right')
			->join('jangbu', 'product.no = jangbu.product_no', 'right')
			->get_where('gubun', $where)->result();
		// return $this->db->query($sql)->num_rows();
	}
}
