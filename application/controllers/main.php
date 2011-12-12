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
		if ($this->session->userdata('logged_in')) 
			$data['user'] = $this->user->getUser(array('username' => $this->session->userdata('username')));		
		else
			redirect('/main/login/');
			
		$data['category'] = $this->category->getAll();
		$data['topic'] = array();
		
		foreach($data['category']->result() as $c)
		{
			$data['topic'][$c->cid] = $this->topic->getTopics($c->cid);
		}
		
		// Sean: You shoud be loading the header view here rather 
		// than require_once in the main_index file.
		
		// Load the main_index.php view, passing the data array
		$this->load->view('header', $data);
		$this->load->view('main_index', $data);
		$this->load->view('footer', $data);
	}
	
	public function topic($t)
	{
		if ($this->session->userdata('logged_in'))
			$data['user'] = $this->user->getUser(array('username' => $this->session->userdata('username')));		
		else
			redirect('/main/login/');
			
		if (($data['topic'] = $this->topic->getTopic($t)) 
			&& ($data['post'] = $this->post->getPosts($t)))
		{
			$this->load->view('header', $data);
			$this->load->view('main_topic', $data);
			$this->load->view('footer', $data);
		}
		else
			echo 'failure';
	}
	
	public function logout()
	{
		$this->session->set_userdata('logged_in', FALSE);
		redirect('/');
	}
	
	public function login() 
	{
		$data['user'] = false;
		$this->load->view('header', $data);
		$this->load->view('main_login');
		$this->load->view('footer', $data);
	}
	
	public function authenticate()
	{
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		
		if ($this->user->login($user, $pass))	
		{

			$this->session->set_userdata('username', $user);
			$this->session->set_userdata('logged_in', TRUE);
			
			if ($this->session->userdata('logged_in'))
				echo 'logged in!!!!! USERDATA = ' . $this->session->userdata('username');
			else
				echo 'user data not set!';
			redirect('/');
		}
			else
			redirect('/main/login/');
	}
	
	public function register()
	{
		$data['user'] = false;
		$this->load->view('header', $data);
		$this->load->view('main_register');
		$this->load->view('footer');
	}
	
	public function addUser()
	{
		$data['firstname'] = $this->input->post('firstname');
		$data['lastname'] = $this->input->post('lastname');
		$data['email'] = $this->input->post('email');
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');
		$conf = $this->input->post('confirm');
		
		if (($data['password'] == $conf) && ($this->user->addUser($data)))
			redirect('/main/login/');
		else
			redirect('/main/register/');
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
		$cid = $this->input->post('category');
		$uid = $this->input->post('user');
		$title = $this->input->post('title');
		$details = $this->input->post('details');
		
		if ($cid && $uid && $title && $details)
		{
			if ($this->topic->newTopic($title, $details, $cid, $uid) && $this->category->update($cid))
				redirect('/main/index');
			else
				echo 'failure';
		}
	}
	
	public function newPost()
	{
		// Sean: Should be using $this->input->post('topic') etc.
		// No need for checking issets or using $_POST.
		// C: Fucking. Sweet.
		$tid = $this->input->post('topic');
		$uid = $this->input->post('user');
		$text = $this->input->post('text');
		
		if (!empty($tid) && !empty($uid) && !empty($text))
		{
		  if ($this->post->newPost($text, $tid, $uid) && $this->topic->update($tid) && $this->category->update($this->topic->getCategory($tid)))
			  redirect('/main/topic/' . $tid);
		  else
			  echo 'failure';
		}
		else
		{
			echo "$tid, $uid, $text";
		}
	}
}