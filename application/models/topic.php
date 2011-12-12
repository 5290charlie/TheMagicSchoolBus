<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Make sure to include the above line about BASEPATH, and to extend every model from CI_Model
class Topic extends CI_Model {

	var $tid;
	var $title;
	var $details;
	var $cid;
	var $uid;
	var $updated;
	var $views;
	
	public function getTopics($cid)
	{
		$data = array(
			'cid' => $cid
		);
		$this->db->select('*');
		$this->db->from('topics');
		$this->db->where($data);
		$this->db->join('users', 'topics.uid = users.uid');
		return $this->db->get();
	}
	
	public function getTopic($tid)
	{
		if (!$this->viewTopic($tid)) return false;
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
		$query = $this->db->get_where('categories', array('cid' => $category), 1, 0);
		foreach ($query->result() as $r)
		{
			$data = array(
				'topics' => $r->topics+1
			);
		}
		$this->db->where('cid', $category);
		if (!$this->db->update('categories', $data)) return false;
		
		$this->title = $title;
		$this->details = $details;
		$this->uid = $user;
		$this->cid = $category;
		$this->updated = time();
		$this->views = 0;
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
			return $r->cid;
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
				'updated' => time()
			);
		}
		
		$this->db->where('tid', $tid);
		return $this->db->update('topics', $data1);
	}
	
	public function viewTopic($tid)
	{
		$data = array(
			'tid' => $tid
		);
		$query = $this->db->get_where('topics', $data, 1, 0);
		foreach($query->result() as $r)
		{
			$data1 = array(
				'views' => $r->views+1
			);
		}
		$this->db->where('tid', $tid);
		return $this->db->update('topics', $data1);
	}
}
