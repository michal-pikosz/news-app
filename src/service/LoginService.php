<?php


namespace src\service;


use src\dao\UserDao;
use src\framework\Validation;
use src\models\User;

class LoginService
{
    private UserDao $userDao;
    private UserService $userService;

    public function __construct()
    {
        $this->userDao     = new UserDao();
        $this->userService = new UserService();
    }

    /**
     * Corrects user data validity
     * and saves login in the session
     * @return bool
     */
    public function loginUser(): bool
    {
        $email     = Validation::cleanInput($_POST['email']);
        $fetchUser = $this->userDao->getUserByEmail($email);

        if (password_verify($this->userService->saltPassword($_POST['password']), $fetchUser->getPassword())) {
            $this->makeLogin($fetchUser);
            return true;
        }

        return false;
    }

    /**
     * Saves user data in session
     * making user logged in
     * @param User $user
     */
    public function makeLogin(User $user): void
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user']      = $user;
    }

    /**
     * Checks if user is logged in
     * @return bool
     */
    public function isLoggedin(): bool
    {
        return isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true;
    }

    /**
     * Destroys session
     */
    public function destroySession(): void
    {
        $_SESSION = array();
        session_destroy();
    }

    /**
     * Registers user
     */
    public function registerUser(): void
    {
        $user = User::mapPostToModel();

        $user->setPassword($this->userService->hashPassword($user->getPassword()));

        $userDao   = new UserDao();
        $savedUser = $userDao->save($user);

        $this->makeLogin($savedUser);
    }
}