<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gigan_m extends CI_Model {

	public function getlist($text1, $text2, $text3, $start, $limit)
	{
		if ($text3 == "0")
		{
			/*
			$sql = " select jangbu.*, product.name as product_name
					from jangbu left join product on jangbu.product_no = product.no
					where jangbu.writeday between '$text1' and '$text2' 
					order by jangbu.no limit $start, $limit ";
			 */
			$where = array("jangbu.writeday BETWEEN '$text1' AND '$text2'");
			return $this->db
			   ->limit($limit, $start)
			   ->order_by('jangbu.no', 'ASC')
			   ->select('jangbu.*, product.name as product_name')
			   ->join('product', 'jangbu.product_no = product.no', 'left')
			   ->get_where('jangbu', $where)->result();
			// return $this->db->query($sql)->result();
		}
		else 
		{
			/*
			$sql = " select jangbu.*, product.name as product_name
					from jangbu left join product on jangbu.product_no = product.no
					where jangbu.writeday between '$text1' and '$text2' and jangbu.product_no = '$text3'
					order by jangbu.no limit $start, $limit ";
			 */
			$where = array("jangbu.writeday BETWEEN '$text1' AND '$text2'", "jangbu.product_no" => $text3);
			return $this->db
			   ->limit($limit, $start)
			   ->order_by('jangbu.no', 'ASC')
			   ->select('jangbu.*, product.name as product_name')
			   ->join('product', 'jangbu.product_no = product.no', 'left')
			   ->get_where('jangbu', $where)->result();
			// return $this->db->query($sql)->result();
		}
	}

	// Excel 출력용 리스트
	public function getlist_all($text1, $text2, $text3)
	{
		if ($text3 == "0")
		{
			/*
			$sql = " select jangbu.*, product.name as product_name
					from jangbu left join product on jangbu.product_no = product.no
					where jangbu.writeday between '$text1' and '$text2' 
					order by jangbu.no ";
			 */
			$where = array("jangbu.writeday BETWEEN '$text1' AND '$text2'");
			return $this->db
			   ->order_by('jangbu.no', 'ASC')
			   ->select('jangbu.*, product.name as product_name')
			   ->join('product', 'jangbu.product_no = product.no', 'left')
			   ->get_where('jangbu', $where)->result();
			// return $this->db->query($sql)->result();
		}
		else 
		{
			/*
			$sql = " select jangbu.*, product.name as product_name
					from jangbu left join product on jangbu.product_no = product.no
					where jangbu.writeday between '$text1' and '$text2' and jangbu.product_no = '$text3'
					order by jangbu.no ";
			 */
			$where = array("jangbu.writeday BETWEEN '$text1' AND '$text2'", "jangbu.product_no" => $text3);
			return $this->db
			   ->order_by('jangbu.no', 'ASC')
			   ->select('jangbu.*, product.name as product_name')
			   ->join('product', 'jangbu.product_no = product.no', 'left')
			   ->get_where('jangbu', $where)->result();
			// return $this->db->query($sql)->result();
		}
	}

	public function rowcount($text1, $text2, $text3)
	{
		if($text3 == "0") 
		{
			// $sql = " select * from jangbu where writeday between '$text1' and '$text2' ";
			$where = array("writeday BETWEEN '$text1' AND '$text2' ");
			return $this->db
			   ->get_where('jangbu', $where)->num_rows();
			// return $this->db->query($sql)->num_rows();
		}
		else 
		{
			// $sql = " select * from jangbu where writeday between '$text1' and '$text2' and product_no = '$text3' ";
			$where = array("writeday BETWEEN '$text1' AND '$text2'", "product_no" => $text3 );
			return $this->db
			   ->get_where('jangbu', $where)->num_rows();
			// return $this->db->query($sql)->num_rows();

		}
	}

	// for product list (selectbox > option)
	public function getlist_product()
	{
		// $sql = "select * from product order by name";
		// return $this->db->query($sql)->result();
		return $this->db
			  ->order_by('name', 'ASC')
			  ->get('product')->result();
	}
}
