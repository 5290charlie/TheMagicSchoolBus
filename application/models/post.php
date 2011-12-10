<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Make sure to include the above line about BASEPATH, and to extend every model from CI_Model
class Post extends CI_Model {
	
	var $pid;
	var $text;
	var $views;
	var $topic;
	var $date;
	var $user;
	
	public function getPosts($tid)
	{
		$data = array(
			'topic' => $tid
		);
		return $this->db->get_where('posts', $data);
	}
	
	public function newPost($text, $topic, $user)
	{
		$this->text = $text;
		$this->views = 0;
		$this->user = $user;
		$this->topic = $topic;
		$this->date = time();
		return $this->db->insert('posts', $this);
	}
}
