<?php
namespace backend\controllers;

class Accounts
{
	private $model;
	
	public function __construct(){
		$this->model = new UserModel();
	}
	
	public function getUser($uid){
		$result = $this->model->getUserData($uid);
		
		return $result;
	}
}