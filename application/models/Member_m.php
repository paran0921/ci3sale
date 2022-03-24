<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_m extends CI_Model {

	public function getlist($text1, $start, $limit)
	{
		// $sql="select * from member order by name";
		// return $this->db->query($sql)->result();
		if(!$text1)
		{
			// $sql = "select * from member order by name ASC limit $start, $limit";
			return $this->db
			   ->limit($limit, $start)
			   ->order_by('name', 'ASC')
			   ->get('member')->result();
		}
		else
		{
			// $sql = "select * from member where name like '%$text1%' order by name ASC limit $start, $limit";
			return $this->db
			   ->like("name", $text1, "both")
			   ->limit($limit, $start)
			   ->order_by('name', 'ASC')
			   ->get('member')->result();
		}
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1)
	{
		if (!$text1)
		{
			// $sql = "select * from member";
			return $this->db->get('member')->num_rows();
		}
		else 
		{
			return $this->db
			   ->like("name", $text1, "both")
			   ->get('member')->num_rows();
			// $sql = "select * from member where name like '%$text1%'";
		}
		// return $this->db->query($sql)->num_rows();
	}

	public function getrow($no)
	{
		// $sql="select * from member where no=$no";
		// return $this->db->query($sql)->row();
		// $row = $this->db->get_where('member', array('no'=>$no))->row();
		$where = array("no"=>$no);
		return $this->db->get_where('member', $where)->row();
	}

	public function deleterow($no)
	{
		// $sql = "delete from member where no=$no";
		// return $this->db->query($sql);
		// return $this->db->delete('member', array('no' => $no));
		$where = array("no"=>$no);
		return $this->db->delete('member', $where);
	}

	public function insertrow($row)
	{
		return $this->db->insert("member", $row);
	}

	public function updaterow($row, $no)
	{
		$where = array("no"=>$no);
		return $this->db->update("member", $row, $where);
	}
}
