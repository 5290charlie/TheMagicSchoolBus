<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Make sure to include the above line about BASEPATH, and to extend every model from CI_Model
class Category extends CI_Model {
	
	var $cid;
	var $title;
	var $user;
	var $updated;
	
	public function getAll() 
	{
		return $this->db->get('categories');
	}
	
	public function getTopics()
	{
		$data = array(
			'category' => $this->cid
		);
		return $this->db->get_where('topics', $data);
	}

	public function newCategory($title, $user)
	{
		$this->title = $title;
		$this->user = $user;
		$this->updated = time();
		return $this->db->insert('categories', $this);
	}
	
	public function update($cid)
	{	
		$data = array(
			'cid' => $cid
		);
		$query = $this->db->get_where('categories', $data);
		foreach($query->result() as $r)
		{
			$data1 = array(
				'title' => $r->title,
				'user' => $r->user,
				'updated' => time()
			);
		}
		$this->db->where('cid', $cid);
		return $this->db->update('categories', $data1);
	}
}
