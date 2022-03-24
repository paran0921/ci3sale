<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_m extends CI_Model {

	public function getlist($text1, $start, $limit)
	{
		// $sql="select * from gubun order by name";
		// return $this->db->query($sql)->result();
		if(!$text1)
		{
			// $sql = "select * from gubun order by name ASC limit $start, $limit";
			return $this->db
			   ->limit($limit, $start)
			   ->order_by('name', 'ASC')
			   ->get('gubun')->result();
		}
		else
		{
			// $sql = "select * from gubun where name like '%$text1%' order by name ASC limit $start, $limit";
			return $this->db
			   ->like("name", $text1, "both")
			   ->limit($limit, $start)
			   ->order_by('name', 'ASC')
			   ->get('gubun')->result();
		}
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1)
	{
		if (!$text1)
		{
			// $sql = "select * from gubun";
			return $this->db->get('gubun')->num_rows();
		}
		else 
		{
			return $this->db
			   ->like("name", $text1, "both")
			   ->get('gubun')->num_rows();
			// $sql = "select * from gubun where name like '%$text1%'";
		}
		// return $this->db->query($sql)->num_rows();
	}

	public function getrow($no)
	{
		// $sql="select * from gubun where no=$no";
		// return $this->db->query($sql)->row();
		// $row = $this->db->get_where('gubun', array('no'=>$no))->row();
		$where = array("no"=>$no);
		return $this->db->get_where('gubun', $where)->row();
	}

	public function deleterow($no)
	{
		// $sql = "delete from gubun where no=$no";
		// return $this->db->query($sql);
		// return $this->db->delete('gubun', array('no' => $no));
		$where = array("no"=>$no);
		return $this->db->delete('gubun', $where);
	}

	public function insertrow($row)
	{
		return $this->db->insert("gubun", $row);
	}

	public function updaterow($row, $no)
	{
		$where = array("no"=>$no);
		return $this->db->update("gubun", $row, $where);
	}
}
