<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Make sure to include the above line about BASEPATH, and to extend every model from CI_Model
class Post extends CI_Model {
	
	var $pid;
	var $text;
	var $tid;
	var $date;
	var $uid;
	
	public function getPosts($tid)
	{
		$data = array(
			'tid' => $tid
		);
		$this->db->select('*');
		$this->db->from('posts');
		$this->db->where($data);
		$this->db->join('users', 'posts.uid = users.uid');
		$this->db->order_by('date', 'desc');
		return $this->db->get();
	}
	
	public function newPost($text, $topic, $user)
	{
		$this->text = $text;
		$this->uid = $user;
		$this->tid = $topic;
		$this->date = time();
		return $this->db->insert('posts', $this);
	}
	
	public function topicOf($pid)
	{
		$query = $this->db->get_where('posts', array('pid' => $pid), 1, 0);
		foreach($query->result() as $r)
			return $r->tid;
		return FALSE;
	}
	
	public function deleteFromTopic($tid)
	{
		return $this->db->delete('posts', array('tid' => $tid));
	}
	
	public function deletePost($pid)
	{
		return $this->db->delete('posts', array('pid' => $pid));
	}
}
