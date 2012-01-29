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
		$data['numTopics'] = array();
		$data['numPosts'] = array();
		
		foreach($data['category']->result() as $c)
		{
			$data['numTopics'][$c->cid] = $this->category->numTopics($c->cid);
			$data['topic'][$c->cid] = $this->topic->getTopics($c->cid);
			
			foreach ($data['topic'][$c->cid]->result() as $t)
			{
				$data['numPosts'][$t->tid] = $this->topic->numPosts($t->tid);
			}
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
			$data['numPosts'] = $this->topic->numPosts($t);
			$this->load->view('header', $data);
			$this->load->view('main_topic', $data);
			$this->load->view('footer', $data);
		}
		else
			echo 'failure';
	}
	
	public function admin()
	{
		if ($this->session->userdata('logged_in'))
			$data['user'] = $this->user->getUser(array('username' => $this->session->userdata('username')));	
		elseif ($data['user']->rank < 2)
			redirect('/');	
		else
			redirect('/main/login/');
			
		$data['user_list'] = $this->user->getAll();
		$data['category_list'] = $this->category->getAll();
		$data['topic_list'] = $this->topic->getAll();
			
		$this->load->view('header', $data);
		$this->load->view('main_admin', $data);
		$this->load->view('footer', $data);
	}
	
	public function deleteTopic($tid)
	{
		$this->topic->deleteTopic($tid);
		$this->post->deleteFromTopic($tid);
		redirect('/main/admin/');
	}
	
	public function deletePost($pid)
	{
		if ($tid = $this->post->topicOf($pid))
			echo $tid;
		else
			echo 'fail';
		$this->post->deletePost($pid);
		redirect('/main/topic/' . $tid);
	}
	
	public function account($user)
	{
		if ($this->session->userdata('logged_in'))
			$data['user'] = $this->user->getUser(array('username' => $this->session->userdata('username')));		
		else
			redirect('/main/login/');
		
		$data['display_user'] = $this->user->getUser(array('username' => $user));
		
		$this->load->view('header', $data);
		$this->load->view('main_account', $data);
		$this->load->view('footer', $data);
	}
	
	public function updateAccount($uid)
	{
		$user = $this->session->userdata['username'];
		$data['uid'] = $uid;
		$data['firstname'] = $this->input->post('firstname');
		$data['lastname'] = $this->input->post('lastname');
		$data['email'] = $this->input->post('email');
		$data['track'] = $this->input->post('track');
		$data['year'] = $this->input->post('year');
		$data['bio'] = $this->input->post('bio');
		
		if (isset($_FILES['photo']))
		{
			$image = $_FILES['photo']['name'];
			
			if ($image)
			{
				$file = stripslashes($_FILES['photo']['name']);
				$i = strrpos($file,".");
				$l = strlen($file) - $i;
				$ext = substr($file,$i+1,$l);
				$ext = strtolower($ext);
				
				if (($ext != 'jpg') && ($ext != 'jpeg') && ($ext != 'png') && ($ext != 'gif') && ($ext != 'bmp'))
					die('bad filetype');
				else
				{
					$image_name = $user . '.' . $ext;
					$localname = DIR_USER_IMAGES . $image_name;
					$avatar = '/static/images/users/' . $image_name;
				
					if(copy($_FILES['photo']['tmp_name'], $localname))
						$data['avatar'] = $avatar;
					else
						$data['avatar'] = '/static/images/users/default.jpg';
				}
			}
		}
				
		if ($this->input->post('password') != '')
			if ($this->input->post('password') == $this->input->post('confirm'))
				$data['password'] = $this->input->post('password');
		
		$this->user->updateUser($data);
		
		redirect('/main/account/' . $user);
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
	
	public function deleteUser($uid)
	{
		$this->user->DeleteUser(array('uid' => $uid));
		redirect('/main/admin/');
	}
	
	public function newCat()
	{
		$title = $this->input->post('title');
		$user = $this->input->post('user');
		if ($this->category->newCategory($title, $user))
			redirect('/main/admin/');
		else
			redirect('/');
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
		
		$details = str_replace("\n", "<br />", $details);
		
		if ($cid && $uid && $title && $details)
		{
			if (($t = $this->topic->newTopic($title, $details, $cid, $uid)) && $this->category->update($cid))
				redirect('/main/topic/' . $t);
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
		
		$text = str_replace("\n", "<br />", $text);
		
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