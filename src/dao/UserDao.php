<?php


namespace src\dao;

use src\framework\db;
use src\models\User;

class UserDao
{
    private db $db;

    private const getQuery = "SELECT * FROM users WHERE id = ?";
    private const getUserByEmailQuery = "SELECT * FROM users WHERE email = ?";
    private const getQueryAll = "SELECT * FROM users";
    private const saveQuery = "INSERT INTO users (first_name, last_name, email, gender, is_active, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    private const updateQuery = "UPDATE users SET first_name = ?, last_name = ?, email = ?, gender = ?, is_active = ?, password = ?, created_at = ?, updated_at = ? WHERE id = ?";
    private const deleteQuery = "DELETE FROM users WHERE id = ?";

    public function __construct()
    {
        $this->db = new db();
    }

    public function get(User $user): User
    {
        $result = $this->db->query(self::getQuery, array($user->getId()))->fetchArray();
        return $this->mapUserModel($user, $result);
    }


    public function getUserByEmail(string $email): User
    {
        $user = new User();
        $result = $this->db->query(self::getUserByEmailQuery, array($email))->fetchArray();
        return $this->mapUserModel($user, $result);
    }

    public function getAll(): array
    {
        return $this->db->query(self::getQueryAll)->fetchAll();
    }

    public function save(User $user): User
    {
        $userId = $this->db->query(self::saveQuery, array(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getGender(),
            $user->isIsActive(),
            $user->getPassword(),
            $user->getCreatedAt(),
            $user->getUpdatedAt(),
        ))->lastInsertID();
        $user->setId($userId);
        return $user;
    }

    public function update(User $user): User
    {
        $this->db->query(self::updateQuery, array(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getGender(),
            $user->isIsActive(),
            $user->getPassword(),
            $user->getCreatedAt(),
            $user->getUpdatedAt(),
            $user->getId()
        ));
        return $user;
    }

    public function delete(User $user): void
    {
        $this->db->query(self::deleteQuery, array($user->getId()));
    }

    /**
     * @param User $user
     * @param array $result
     * @return User
     */
    public function mapUserModel(User $user, array $result): User
    {
        $user->setFirstName((string)$result['first_name']);
        $user->setLastName((string)$result['last_name']);
        $user->setEmail((string)$result['email']);
        $user->setGender((string)$result['gender']);
        $user->setIsActive((int)$result['is_active']);
        $user->setPassword((string)$result['password']);
        $user->setCreatedAt((string)$result['created_at']);
        $user->setUpdatedAt((string)$result['updated_at']);
        $user->setId((int)$result['id']);
        return $user;
    }
}