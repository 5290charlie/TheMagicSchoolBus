<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Make sure to include the above line about BASEPATH, and to extend every model from CI_Model
class User extends CI_Model {
	
	// Member variables
	var $id = 0;
	var $firstname = '';
	var $lastname = '';
	var $email = '';
	var $username = '';
	var $password = '';
	var $ip = '';
	var $auth = FALSE;
	var $admin = FALSE;
	var $active = TRUE;
	var $session_id = '';
	var $photoloc = '/static/images/users/default.png';
	var $laston = '';

	function __construct()
	{
		parent::__construct();
	}
	
	// Function to check if current session has authenticated user
	function is_auth($session)
	{
		$data = array(
			'session_id' => $session['id'],
			'ip' => $session['ip']
		);
		$query = $this->db->get_where('users', $data, 1, 0);
		foreach($query->result() as $row)
		{
			if ($row->auth && $row->active)
			{
				$this->id = $row->id;
				$this->firstname = $row->firstname;
				$this->lastname = $row->lastname;
				$this->email = $row->email;
				$this->username = $row->username;
				$this->password = $row->password;
				$this->ip = $session['ip'];
				$this->auth = $row->auth;
				$this->admin = $row->admin;
				$this->active = $row->active;
				$this->session_id = $session['id'];
				$this->photoloc = $row->photoloc;
				$this->laston = time();
				
				if ($this->db->update('users', $this, array('id' => $this->id)))
					return $this;
				else
					return FALSE;
			}
		}
		return FALSE;
	}
}
