<?php

namespace framework\models;

abstract class Model
{
    /**
     * @var \PDO
     */
    protected $pdo;

    protected function initDB()
    {
        $dbHost = 'localhost';
        $dbName = 'site';
        $dbUser = 'root';
        $dbPass = 'deadmandrinking';

        $this->pdo = new \PDO(
            'mysql:host='.$dbHost.';port=3306;dbname='.$dbName,
            $dbUser,
            $dbPass
        );

        $this->pdo->exec("SET NAMES 'utf8'");
    }

    protected function getRow($sql, $params)
    {
        $row = false;

        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($params);
        if ($result) {
            $data = $stmt->fetchAll();
            if (isset($data[0])) {
                $row = $data[0];
            }
        }

        return $row;
    }

    protected function getMockRow($mockData, $row)
    {
        return $mockData[$row];
    }
}