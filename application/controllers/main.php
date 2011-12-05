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
}