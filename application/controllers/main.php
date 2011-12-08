<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// This is the main controller where default connections will be set
// (can be changed in config/routes.php)
class Main extends CI_Controller {

	// Constructor for controller
	public function __construct()
	{
		// Call parent constructor
		parent::__construct();
		// Load CodeIgniter session library
		$this->load->library('session');
		// Load user-defined user.php model
		$this->load->model('User', 'user', TRUE);
		$this->load->model('Category', 'category', TRUE);
		$this->load->model('Topic', 'topic', TRUE);
		$this->load->model('Post', 'post', TRUE);
		$this->load->helper('url');
	}
	
	public function index()
	{
		// Create session array with id/ip info for authentication
		$session['id'] = $this->session->userdata('session_id');
		$session['ip'] = $this->session->userdata('ip_address');
		
		if (!($data['user'] = $this->user->is_auth($session)))
			$data['user'] = FALSE;
			
		$data['category'] = $this->category->getAll();
		$data['topic'] = array();
		
		foreach($data['category']->result() as $c)
		{
			$data['topic'][$c->cid] = $this->topic->getTopics($c->cid);
		}
		
		// Load the main_index.php view, passing the data array
		$this->load->view('main_index', $data);
	}
	
	public function topic($t)
	{
		// Create session array with id/ip info for authentication
		$session['id'] = $this->session->userdata('session_id');
		$session['ip'] = $this->session->userdata('ip_address');
		
		if (!($data['user'] = $this->user->is_auth($session)))
			$data['user'] = FALSE;
			
		if (($data['topic'] = $this->topic->getTopic($t)) 
			&& ($data['post'] = $this->post->getPosts($t)))
			$this->load->view('main_topic', $data);
		else
			echo 'failure';
	}
	
	public function newCat()
	{
		$title = 'test';
		$user = 1;
		if ($this->category->newCategory($title, $user))
			echo 'success';
		else
			echo 'failure';
	}
	
	public function newTop($c)
	{
		$title = 'new topic';
		$details = 'testing details hahahaha';
		$user = 1;
		if ($this->topic->newTopic($title, $details, $c, $user))
			echo 'success';
		else
			echo 'failure';
	}
	
	public function newTopic()
	{
		if (isset($_POST['category']) && isset($_POST['user']) && isset($_POST['title']) && isset($_POST['details']))
		{
			$cid = $_POST['category'];
			$uid = $_POST['user'];
			$title = $_POST['title'];
			$details = $_POST['details'];
			
			if (($cid != '') && ($uid != '') && ($title != '') && ($details))
			{
				if ($this->topic->newTopic($title, $details, $cid, $uid) && $this->category->update($cid))
					redirect('/main/index');
				else
					echo 'failure';
			}
		}
	}
	
	public function newPost()
	{
		if (isset($_POST['topic']) && isset($_POST['user']) && isset($_POST['text']))
		{
			$tid = $_POST['topic'];
			$uid = $_POST['user'];
			$text = $_POST['text'];
			
			if (($tid != '') && ($uid != '') && ($text != ''))
			{
				if ($this->post->newPost($text, $tid, $uid) && $this->topic->update($tid) && $this->category->update($this->topic->getCategory($tid)))
					redirect('/main/topic/' . $tid);
				else
					echo 'failure';
			}
		}
	}
}