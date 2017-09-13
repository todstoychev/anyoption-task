<?php

namespace framework\models;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

abstract class Model
{
    /**
     * @var \PDO
     */
    protected $pdo;

    protected function initDB()
    {
        $config = $this->getConfig();
        $dbHost = $config['host'];
        $dbName = $config['database'];
        $dbUser = $config['user'];
        $dbPass = $config['password'];

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

    /**
     * @return mixed
     */
    protected function getConfig()
    {
        $configDirectories = [__DIR__.'/../../backend/conf'];

        $locator = new FileLocator($configDirectories);
        $files = $locator->locate('config.yml', null, false);
        $config = [];

        foreach ($files as $file) {
            $data = Yaml::parse(file_get_contents($file));
            $config = array_merge($config, $data);
        }

        return $config['database'];
    }
}