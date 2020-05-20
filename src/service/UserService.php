<?php

namespace src\service;

class UserService
{
    /**
     * Hashes passoword
     * @param $password
     * @return string
     */
    public function hashPassword($password): string
    {
        $pwd_salt = hash_hmac("sha256", $password, "panda!");
        return password_hash($pwd_salt, PASSWORD_BCRYPT);
    }

    /**
     * Salt password so that you can check
     * with the saved in the database
     * @param $password
     * @return string
     */
    public function saltPassword($password): string
    {
        return hash_hmac("sha256", $password, "panda!");
    }
}