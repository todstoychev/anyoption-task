<?php

namespace framework\models;

use framework\Exception\ModelNotFoundException;

class UserModel extends Model
{
    /**
     * @var string
     */
    private $table = 'users';

    public function __construct()
    {
        $this->initDB(); //Commented due to the lack of a database
    }

    /**
     * @param $uid
     * @deprecated Use UserModel::getUser instead
     *
     * @return mixed
     */
    public function getUserData($uid)
    {
        $uid = intval($uid);

        $mockUserData = [
            ['email' => 'email1', 'name' => 'ln1, fn1', 'birth_date' => 1498387957],
            ['email' => 'email2', 'name' => 'ln2, fn2', 'birth_date' => 1498387957],
        ];

        $result = $this->getMockRow($mockUserData, $uid);

        return $result;
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getUser(int $id): array
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([':id' => $id]);
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            throw new ModelNotFoundException('No such user!');
        }

        return $result;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        $fields = array_keys($data);
        $fields = implode('`, `', $fields);
        $fields = '`'.$fields.'`';

        foreach ($data as $key => $value) {
            $data[':'.$key] = $value;
            unset($data[$key]);
        }

        $placeholders = array_keys($data);
        $placeholders = implode(', ', $placeholders);

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $stm = $this->pdo->prepare($sql);

        return $stm->execute($data);
    }
}