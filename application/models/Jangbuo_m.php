<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jangbuo_m extends CI_Model {

	public function getlist($text1, $start, $limit)
	{
			/*
			$sql = " select jangbu.*, product.name as product_name
					from jangbu left join product on jangbu.product_no = product.no
					where jangbu.io = 1 AND jangbu.writeday = '$text1' 
					order by jangbu.no limit $start, $limit ";
			 */
			$where = array("jangbu.io"=>1, "jangbu.writeday"=>$text1);
			return $this->db
			   ->limit($limit, $start)
			   ->order_by('jangbu.no', 'ASC')
			   ->select('jangbu.*, product.name as product_name')
			   ->join('product', 'jangbu.product_no = product.no', 'left')
			   ->get_where('jangbu', $where)->result();
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1)
	{
		// $sql = " select * from jangbu where io=1 AND writeday='$text1' ";
		$where = array("io"=>1, "writeday"=>$text1);
		return $this->db
		   ->get_where('jangbu', $where)->num_rows();
		// return $this->db->query($sql)->num_rows();
	}

	public function getrow($no)
	{
		/*
		$sql="select jangbu.*, product.name as product_name
			  from jangbu left join product on jangbu.product_no = product.no
			  where jangbu.no=$no";
		return $this->db->query($sql)->row();
		 */
		$where = array("jangbu.no"=>$no);
		return $this->db
			  ->select('jangbu.*, product.name as product_name')
			  ->join('product', 'jangbu.product_no = product.no', 'left')
			  ->get_where('jangbu', $where)->row();
	}

	public function deleterow($no)
	{
		// $sql = "delete from jangbu where no=$no";
		// return $this->db->query($sql);
		// return $this->db->delete('jangbu', array('no' => $no));
		$where = array("no"=>$no);
		return $this->db->delete('jangbu', $where);
	}

	public function insertrow($row)
	{
		return $this->db->insert("jangbu", $row);
	}

	public function updaterow($row, $no)
	{
		$where = array("no"=>$no);
		return $this->db->update("jangbu", $row, $where);
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
