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
	
	public function getAll()
	{
		return $this->db->get('topics');
	}
	
	public function getTopics($cid)
	{
		$data = array(
			'cid' => $cid
		);
		$this->db->select('*');
		$this->db->from('topics');
		$this->db->where($data);
		$this->db->join('users', 'topics.uid = users.uid');
		$this->db->order_by('updated', 'desc');
		return $this->db->get();
	}
	
	public function getTopic($tid)
	{
		if (!$this->viewTopic($tid)) return false;
		$data = array(
			'tid' => $tid
		);
		$this->db->select('*');
		$this->db->from('topics');
		$this->db->where($data);
		$this->db->join('users', 'topics.uid = users.uid');
		$query = $this->db->get_where();
		
		foreach($query->result() as $r)
			return $r;
		return FALSE;
	}
	
	public function deleteTopic($tid)
	{
		return $this->db->delete('topics', array('tid' => $tid));
	}
	
	public function numPosts($tid)
	{
		$this->db->where('tid', $tid);
		$this->db->from('posts');
		return $this->db->count_all_results();
	}
	
	public function newTopic($title, $details, $category, $user)
	{	
		$this->title = $title;
		$this->details = $details;
		$this->uid = $user;
		$this->cid = $category;
		$this->updated = time();
		$this->views = 0;
		if ($this->db->insert('topics', $this))
			return $this->db->insert_id();
		else
			return false;
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
			$data1['updated'] = time();
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
