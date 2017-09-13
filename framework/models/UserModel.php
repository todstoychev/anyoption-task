<?php
namespace framework\models;

use framework\models\Model;

class UserModel extends Model
{
	public function __construct(){
		//$this->initDB(); //Commented due to the lack of a database
	}
	
	public function getUserData($uid){
		$uid = intval($uid);
		
		$mockUserData = [
			['email' => 'email1', 'name' => 'ln1, fn1', 'birth_date' => 1498387957],
			['email' => 'email2', 'name' => 'ln2, fn2', 'birth_date' => 1498387957]
		];
		
		$result = $this->getMockRow($mockUserData, $uid);
		
		return $result;
	}
}