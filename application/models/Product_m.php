<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_m extends CI_Model {

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

	public function getrow($no)
	{
		/*
		$sql="select product.*, gubun.name as gubun_name
			  from product left join gubun on product.gubun_no = gubun.no
			  where product.no=$no";
		return $this->db->query($sql)->row();
		 */
		$where = array("product.no"=>$no);
		return $this->db
			  ->select('product.*, gubun.name as gubun_name')
			  ->join('gubun', 'product.gubun_no = gubun.no', 'left')
			  ->get_where('product', $where)->row();
	}

	public function deleterow($no)
	{
		// $sql = "delete from product where no=$no";
		// return $this->db->query($sql);
		// return $this->db->delete('product', array('no' => $no));
		$where = array("no"=>$no);
		return $this->db->delete('product', $where);
	}

	public function insertrow($row)
	{
		return $this->db->insert("product", $row);
	}

	public function updaterow($row, $no)
	{
		$where = array("no"=>$no);
		return $this->db->update("product", $row, $where);
	}

	// for gubun list (selectbox > option)
	public function getlist_gubun()
	{
		// $sql = "select * from gubun order by name";
		// return $this->db->query($sql)->result();
		return $this->db
			  ->order_by('name', 'ASC')
			  ->get('gubun')->result();
	}

	// for ?????? ?????? 
	public function cal_jaego()
	{
		// ????????? ????????? tmp ???????????? ????????? ??????.
		$sql = " drop table if exists temp; ";
		$this->db->query($sql);

		// temp ????????? ??????
		$sql = " CREATE TABLE `temp` (
				no int not null auto_increment,
				product_no int,
				jaego int default 0,
				primary key(no)
			); ";
		$this->db->query($sql);
		
		// product ???????????? jaego ????????? 0?????? ????????? 
		$sql = " update product set jaego=0; ";
		$this->db->query($sql);

		// jangbu ??????????????? ????????????  ??? ??????(numi) - ??? ??????(numo) ??? ????????????
		// temp ???????????? ?????? ??????.
		$sql = " insert into temp (product_no, jaego)
					select product_no, sum(numi) - sum(numo) from jangbu
					group by product_no; ";
		$this->db->query($sql);

		// ????????? ????????? product ???????????? ??????	
		$sql = " update product inner join temp on product.no = temp.product_no 
					set product.jaego = temp.jaego; ";
		$this->db->query($sql);
		
	}
}
