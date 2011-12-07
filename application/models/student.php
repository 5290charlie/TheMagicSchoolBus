<?php

class Student extends User
{
	public function __construct($username, $password)
	{
		parent::__construct(1);
	}
}