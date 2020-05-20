<?php


namespace src\controllers;

use src\dao\NewsDao;
use src\framework\Session;
use src\framework\Validation;
use src\framework\ViewController;
use src\models\News;
use src\service\LoginService;

class AdminController extends ViewController
{
    private NewsDao $newsDao;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../templates/backend/");
        $this->newsDao = new NewsDao();
    }

    public function index(): string
    {
        $news = $this->newsDao->getAll();
        return $this->returnView('index.html', ['news' => $news]);
    }

    public function show($id): string
    {
        $id = Validation::cleanInput($id);

        $news = $this->newsDao->get((int)$id);

        if ($news->getId() === 0) {
            $this->redirect404();
        }

        return $this->returnView('show.html', ['news' => $news]);
    }

    public function logout(): void
    {
        $loginService = new LoginService();
        $loginService->destroySession();
        $this->redirectPage("/");
    }

    public function edit($id): string
    {
        $id = Validation::cleanInput($id);

        $news = $this->newsDao->get($id);

        if ($news->getId() === 0) {
            $this->redirect404();
        }

        $error = Session::resetErrors();

        return $this->returnView('edit.html', ['news' => $news, 'error' => $error]);
    }

    public function update($id): void
    {

        $name        = Validation::cleanInput($_POST['name']);
        $description = Validation::cleanInput($_POST['description']);
        $is_active   = Validation::cleanInput($_POST['isactive']) === "" ? 0 : 1;
        $id          = Validation::cleanInput($id);

        $validate = new Validation();
        $validate->isRequired("Name", $name);

        $error = Session::resetErrors();

        if (empty($error)) {

            $news = $this->newsDao->get($id);
            $news->setName($name);
            $news->setDescription($description);
            $news->setIsActive($is_active);
            $this->newsDao->update($news);

        }

        $this->redirectPage("/admin");
    }

    public function delete($id): void
    {
        $id = Validation::cleanInput($id);
        $this->newsDao->delete($id);
        $this->redirectPage("/admin");

    }

    public function add(): string
    {
        return $this->returnView('edit.html', ['news' => [], 'error' => []]);
    }

    public function save(): void
    {
        $name        = Validation::cleanInput($_POST['name']);
        $description = Validation::cleanInput($_POST['description']);
        $is_active   = Validation::cleanInput($_POST['isactive']) === "" ? 0 : 1;

        $validate = new Validation();
        $validate->isRequired("Name", $name);

        $error = Session::resetErrors();

        if (empty($error)) {

            $news = new News();
            $news->setName($name);
            $news->setDescription($description);
            $news->setIsActive($is_active);
            $this->newsDao->save($news);

        }

        $this->redirectPage("/admin");
    }
}