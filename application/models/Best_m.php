<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Best_m extends CI_Model {

	public function getlist($text1, $text2, $start, $limit)
	{
		
		// $sql = " select product.name as product_name, count(jangbu.numo) as cnumo
		// 		from jangbu left join product on jangbu.product_no = product.no
		// 		where jangbu.io = 1 and jangbu.writeday between '$text1' and '$text2' 
		// 		group by product_name
		// 		order by cnumo DESC limit $start, $limit ";
		
		$where = array("jangbu.io"=>1, "jangbu.writeday BETWEEN '$text1' AND '$text2'");
		return $this->db
			->limit($limit, $start)
			->group_by('product_name')
			->order_by('cnumo', 'DESC')
			->select('product.name as product_name, count(jangbu.numo) as cnumo')
			->join('product', 'jangbu.product_no = product.no', 'left')
			->get_where('jangbu', $where)->result();
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1, $text2)
	{
		// $sql = " select product.name as product_name, count(jangbu.numo) as cnumo 
		//			from jangbu left join product on jangbu.product_no = product.no
		//			where jangbu.io = 1 and jangbu.writeday between '$text1' and '$text2'
		//			group by product.name
		//			order by cnumo desc; ";

		$where = array("jangbu.io"=>1, "jangbu.writeday BETWEEN '$text1' AND '$text2'");
		return $this->db
			->group_by('product_name')
			->select('product.name as product_name, count(jangbu.numo) as cnumo')
			->join('product', 'jangbu.product_no = product.no', 'left')
			->get_where('jangbu', $where)->num_rows();
		// return $this->db->query($sql)->num_rows();
	}
}
