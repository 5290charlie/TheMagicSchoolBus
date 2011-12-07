<?php

// IMPORTANT: Profile, User, Student and Admin should all be models!

// Super class for both students and admins

class User extends CI_Model
{
	var $data = array( );
	
	public function __construct($rank)
	{
		parent::__construct( );
		$this->data = array(
			'fname' => '',
			'lname' => '',
			'username' => '',
			'email' => '',
			'password' => '',
			'track' => '',
			'year' => '',
			'bio' => '',
			'rank' => $rank);
	}
	
	public static function login($username, $password)
	{
		$query = $this->db->get_where('users', array('username' => $username));
		if (!validate_password($query[0]['password'], $password))
			return false;
		else return create($query[0]);
	}
	
	private function validate_password($stored_password, $password)
	{
		$salt = substr($stored_password, 0, 64);
		$hash = substr($stored_password, 64, 64);
		
		$password_hash = hash('md5', $salt . $password);
		
		if ($password_hash == $hash)
			return true;
		return false;
	}
	
	private function create($query)
	{
		if (isset($query['fname']))
			$this->$data['fname'] = $query['fname'];
		if (isset($query['lname']))
			$this->$data['lname'] = $query['lname'];
		if (isset($query['username']))
			$this->$data['username'] = $query['username'];
		if (isset($query['email']))
			$this->$data['email'] = $query['email'];
		if (isset($query['password']))
			$this->$data['password'] = $query['password'];
		if (isset($query['track']))
			$this->$data['track'] = $query['track'];
		if (isset($query['year']))
			$this->$data['year'] = $query['year'];
		if (isset($query['bio']))
			$this->$data['bio'] = $query['bio'];
		if (isset($query['rank']))
			$this->$data['rank'] = $query['rank'];
		
		return true;
	}
	
	///////////////////////////////////////////////////////////
	//					CRUD  Methods						//
	/////////////////////////////////////////////////////////
	
	/* Add new user to database
	 * 
	 * @params - fill out options array
	 * 	fname - Users first name
	 * 	lname - Users last name
	 * 	username - Users selected username 
	 * 	email - Users email
	 * 	password - Users password
	 * 	track 	- Users track (eg: Software Engineering)
	 * 	year - Users current year (eg: Freshman, Sophomore)
	 * 	bio - 	Short text description of user
	 * 	rank - 1 for student | 0 for admin
	 */
	public static function AddUser($options = array( ))
	{
		if ($this->required(
			array('fname',
				'lname',
				'fname',
				'username',
				'email', 
				'password'),
			$options)
		) return false;
		
		// Hash Password with a salt at the beginning to prevent replays
		$salt = bin2hex(my_crypt_create_iv(32, MYCRYPT_DEV_URANDOM));
		$hash = hash('md5', $options['password']);
		
		$options['password'] = $salt . $hash;
		
		$this->db->insert('users', $options);
		
		return $this->db->insert_id( );
	}
	
	// Put explanation and paramter options and return value here
	public static function UpdateUser($options = array( ))
	{
		if ($this->required(array('username'),$options)) return false;
		
		$this->db->set('username', $options['username']);
		
		if (isset($options['password']))
			$this->db->set('password', md5($options['password']));
		if (isset($options['track']))
			$this->db->set('track', $options['track']);
		if (isset($options['year']))
			$this->db->set('year', $option['year']);
		if (isset($options['bio']))
			$this->db->set('bio', $options['bio']);
		
		if (isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'], $options['offset']);
		elseif (isset($options['limit']))
			$this->db->limit($options['limit']);
			
		if (isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'], $options['sortDirection']);
			
		$query = $this->db->get('users');
			
		if (isset($options['username']))
			return $query->result( );
	}
	
	// Put explanation and paramter options and return value here
	public static function DeleteUser($options = array( ))
	{
		if ($this->required(array('username', 'password'), $options)) return false;
		
		$this->db->set('username', $options['username']);
		$this->db->set('password', md5($options['password']));
		
		$rows = $this->db-delete('users');
	}
	
	// Put explanation and paramter options and return value here
	public static function GetUsers($options = array( ))
	{
		
	}
	///////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////
	// 				HELPER FUNCTIONS				   //
	////////////////////////////////////////////////////

	private function __required($required, $data)
	{
		foreach ($required as $field)
		{
			if (!isset($data[$field]))
			{
				return false;
			}
		}
		return true;
	}
	
	private function __default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}

	public function getData( )
	{
		return $this->data;
	}

	public function setData($data)
	{
		$this->data = $data;
	}
}

?>