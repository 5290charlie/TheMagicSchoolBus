<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// This is the main controller where default connections will be set
// (can be changed in config/routes.php)
class Test extends CI_Controller {

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
	
	public function resizeIcons($dim)
	{
		if (isset($dim) && ($dim != ''))
		{
			include('SimpleImage.php');
	
			$root = $_SERVER['DOCUMENT_ROOT'];
			$orig_path = $root . 'static/images/icons/';
			$files = scandir($orig_path);
			$ext = '.png';
			$pre = 't_';
			$length = sizeof($files);
			
			for ($i=0; $i<$length; $i++) {
				if (strpos($files[$i], $ext)) {
					echo 'processing "' . $files[$i] . '"<br />';
					$image = new SimpleImage();
					$image->load($orig_path . $files[$i]);
					$image->resizeToWidth($dim);
					$image->save($orig_path . $pre . $files[$i]);	
				}	
			}
			echo 'done';
		}
		else
			die('please provide a new dim: /test/resizeIcons/$dim');
	}
}