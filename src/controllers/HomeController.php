<?php


namespace src\controllers;

use src\dao\NewsDao;
use src\framework\Session;
use src\framework\Validation;
use src\service\LoginService;
use src\framework\ViewController;


class HomeController extends ViewController
{
    private ?NewsDao $newsDao;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../templates/front/");
        $this->newsDao = new NewsDao();
    }

    public function index(): string
    {
        $news = $this->newsDao->getAllInactive();
        return $this->returnView('index.html', ['news' => $news]);
    }

    public function login(): string
    {
        return $this->returnView('login.html', []);
    }

    public function makeLogin(): ?string
    {
        $loginService = new LoginService();

        if ($loginService->loginUser()) {
            $this->redirectPage("/admin");
        }

        return $this->returnView('login.html', ['error' => "Email lub hasło nie prawidłowe"]);
    }

    public function register(): string
    {
        $error = Session::resetErrors();
        return $this->returnView('register.html', ['error' => $error]);
    }

    public function makeRegister(): void
    {
        $email    = Validation::cleanInput($_POST['inputEmailAddress']);
        $password = Validation::cleanInput($_POST['inputPassword']);

        $validate = new Validation();
        $validate->isRequired("E-mail", $email);
        $validate->isEmail("E-mail", $email);
        $validate->isRequired("Password", $password);

        $error = Session::resetErrors();

        if (empty($error)) {

            $loginService = new LoginService();
            $loginService->registerUser();
            $this->redirectPage("/admin");
        }

        $this->redirectPage("/register");
    }

}