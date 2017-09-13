<?php
namespace framework\models;

abstract class Model
{
	protected $pdo;
	
	protected function initDB(){
		
		$dbHost = 'localhost';
		$dbName = 'some_db_name';
		$dbUser = 'some_db_user';
		$dbPass = 'some_db_pass';
		
		$this->pdo = new \PDO(
            'mysql:host=' . $dbHost . ';port=3306;dbname=' . $dbName,
            $dbUser,
            $dbPass
        );

        $this->pdo->exec("SET NAMES 'utf8'");
	}
	
	protected function getRow($sql, $params){
		$row = false;
		
		$stmt = $this->pdo->prepare($sql);
		$result = $stmt->execute($params);
		if($result){
			$data = $stmt->fetchAll();
			if(isset($data[0])){
				$row = $data[0];
			}
		}
		
		return $row;
	}
	
	protected function getMockRow($mockData, $row){
		return $mockData[$row];
	}
}