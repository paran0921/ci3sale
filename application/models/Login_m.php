<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {

	public function getrow($uid, $pwd)
	{
		// $sql = " select * from member where uid = '$uid' and pwd = '$pwd' ";
		
		$where = array("uid"=>$uid, "pwd"=>$pwd);
		return $this->db
			->get_where('member', $where)->row();
		// return $this->db->query($sql)->row();
	}
}
