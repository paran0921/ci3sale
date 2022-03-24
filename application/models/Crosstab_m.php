<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crosstab_m extends CI_Model {

	public function getlist($text1, $start, $limit)
	{
		// $sql = "select product.name as product_name,
		// 			sum( if(month(jangbu.writeday)=1, jangbu.numo, 0) ) as s1,
		// 			sum( if(month(jangbu.writeday)=2, jangbu.numo, 0) ) as s2,
		// 			sum( if(month(jangbu.writeday)=3, jangbu.numo, 0) ) as s3,
		// 			sum( if(month(jangbu.writeday)=4, jangbu.numo, 0) ) as s4,
		// 			sum( if(month(jangbu.writeday)=5, jangbu.numo, 0) ) as s5,
		// 			sum( if(month(jangbu.writeday)=6, jangbu.numo, 0) ) as s6,
		// 			sum( if(month(jangbu.writeday)=7, jangbu.numo, 0) ) as s7,
		// 			sum( if(month(jangbu.writeday)=8, jangbu.numo, 0) ) as s8,
		// 			sum( if(month(jangbu.writeday)=9, jangbu.numo, 0) ) as s9,
		// 			sum( if(month(jangbu.writeday)=10, jangbu.numo, 0) ) as s10,
		// 			sum( if(month(jangbu.writeday)=11, jangbu.numo, 0) ) as s11,
		// 			sum( if(month(jangbu.writeday)=12, jangbu.numo, 0) ) as s12
		// 		from jangbu left join product on jangbu.procuct_no = product.no
		// 		where year(jangbu.writeday)=$text1
		// 		group by jangbu.product_no
		// 		order by product.name limit $start, $limit ";	
		$select = "product.name as product_name,
					sum( if(month(jangbu.writeday)=1, jangbu.numo, 0) ) as s1,
					sum( if(month(jangbu.writeday)=2, jangbu.numo, 0) ) as s2,
					sum( if(month(jangbu.writeday)=3, jangbu.numo, 0) ) as s3,
					sum( if(month(jangbu.writeday)=4, jangbu.numo, 0) ) as s4,
					sum( if(month(jangbu.writeday)=5, jangbu.numo, 0) ) as s5,
					sum( if(month(jangbu.writeday)=6, jangbu.numo, 0) ) as s6,
					sum( if(month(jangbu.writeday)=7, jangbu.numo, 0) ) as s7,
					sum( if(month(jangbu.writeday)=8, jangbu.numo, 0) ) as s8,
					sum( if(month(jangbu.writeday)=9, jangbu.numo, 0) ) as s9,
					sum( if(month(jangbu.writeday)=10, jangbu.numo, 0) ) as s10,
					sum( if(month(jangbu.writeday)=11, jangbu.numo, 0) ) as s11,
					sum( if(month(jangbu.writeday)=12, jangbu.numo, 0) ) as s12 ";
		$where = array("year(writeday)"=>$text1);
		return $this->db
			->limit($limit, $start)
			->group_by('jangbu.product_no')
			->order_by('product.name', 'ASC')
			// ->select('product.name as product_name')
			->select($select)
			->join('product', 'jangbu.product_no = product.no', 'left')
			->get_where('jangbu', $where)->result();
		// return $this->db->query($sql)->result();
	}

	public function rowcount($text1)
	{
		// $sql = "select product_no from jangbu
		// Where year(writeday) = '$text1'
		// group by product_no ";
		$where = array("year(writeday)"=>$text1);
		return $this->db
			->group_by('product_no')
			->select('product.name as product_name, count(jangbu.numo) as cnumo')
			->join('product', 'jangbu.product_no = product.no', 'left')
			->get_where('jangbu', $where)->num_rows();
		// return $this->db->query($sql)->num_rows();
	}
}
