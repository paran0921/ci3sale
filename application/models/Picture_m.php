<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Picture_m extends CI_Model {

	public function getlist($text1, $start, $limit)
	{
		if(!$text1)
		{
			/*
			$sql = "select product.*, gubun.name as gubun_name
					from product left join gubun on product.gubun_no = gubun.no
					order by product.name limit $start, $limit ";
			 */
			return $this->db
			   ->limit($limit, $start)
			   ->order_by('product.name', 'ASC')
			   ->select('product.*, gubun.name as gubun_name')
			   ->join('gubun', 'product.gubun_no = gubun.no', 'left')
			   ->get('product')->result();
		}
		else
		{
			/*
			$sql = "select product.*, gubun.name as gubun_name
					from product left join gubun on product.gubun_no = gubun.no
					where product.name like '%$text1%'
					order by product.name limit $start, $limit ";
			 */
			return $this->db
			   ->like("product.name", $text1, "both")
			   ->limit($limit, $start)
			   ->order_by('product.name', 'ASC')
			   ->select('product.*, gubun.name as gubun_name')
			   ->join('gubun', 'product.gubun_no = gubun.no', 'left')
			   ->get('product')->result();
		}
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1)
	{
		if (!$text1)
		{
			// $sql = "select * from product";
			return $this->db->get('product')->num_rows();
		}
		else
		{
			return $this->db
			   ->like("name", $text1, "both")
			   ->get('product')->num_rows();
			// $sql = "select * from product where name like '%$text1%'";
		}
		// return $this->db->query($sql)->num_rows();
	}
}
