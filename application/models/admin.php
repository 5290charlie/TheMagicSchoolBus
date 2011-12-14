<?php

class Admin extends User
{
	public function __construct($username, $password)
	{
		parent::__construct(0);
	}
}