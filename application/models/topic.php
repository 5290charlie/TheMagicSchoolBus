<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Make sure to include the above line about BASEPATH, and to extend every model from CI_Model
class Topic extends CI_Model {

	var $tid;
	var $title;
	var $details;
	var $category;
	var $user;
	var $updated;
	
	public function getTopics($cid)
	{
		$data = array(
			'category' => $cid
		);
		return $this->db->get_where('topics', $data);
	}
	
	public function getTopic($tid)
	{
		$data = array(
			'tid' => $tid
		);
		$query = $this->db->get_where('topics', $data, 1, 0);
		foreach($query->result() as $r)
			return $r;
		return FALSE;
	}
	
	public function newTopic($title, $details, $category, $user)
	{
		$this->title = $title;
		$this->details = $details;
		$this->user = $user;
		$this->category = $category;
		$this->updated = time();
		return $this->db->insert('topics', $this);
	}
	
	public function getCategory($tid)
	{
		$data = array(
			'tid' => $tid
		);
		$query = $this->db->get_where('topics', $data, 1, 0);
		foreach($query->result() as $r)
		{
			return $r->category;
		}
		return -1;
	}
	
	public function update($tid)
	{	
		$data = array(
			'tid' => $tid
		);
		$query = $this->db->get_where('topics', $data);
		foreach($query->result() as $r)
		{
			$data1 = array(
				'title' => $r->title,
				'details' => $r->details,
				'category' => $r->category,
				'user' => $r->user,
				'updated' => time(),
			);
		}
		
		$this->db->where('tid', $tid);
		return $this->db->update('topics', $data1);
	}
}
