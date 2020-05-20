<?php

use src\controllers\AdminController;
use src\controllers\HomeController;
use src\framework\Router;

/*
|--------------------------------------------------------------------------
| This is the application point where we assign the url to controllers
|--------------------------------------------------------------------------
|
*/

Router::add('/', static function () {
    $homeController = new HomeController();
    echo $homeController->index();
});

/**
 * LOGIN
 * ==================================================
 */

Router::add('/login', static function () {
    $homeController = new HomeController();
    echo $homeController->login();
});

Router::add('/login', static function () {
    $homeController = new HomeController();
    echo $homeController->makeLogin();
}, "POST");

/**
 * REGISTER
 * ==================================================
 */

Router::add('/register', static function () {
    $homeController = new HomeController();
    echo $homeController->register();
});

Router::add('/register', static function () {
    $homeController = new HomeController();
    $homeController->makeRegister();
}, "post");

/**
 *RESTRICED AREA
 * ==================================================
 */

if((new src\service\LoginService)->isLoggedin()) {
    Router::add('/admin', static function () {
        $adminController = new AdminController();
        echo $adminController->index();
    });

    Router::add('/admin/add', static function () {
        $adminController = new AdminController();
        echo $adminController->add();
    });

    Router::add('/admin/add', static function () {
        $adminController = new AdminController();
        $adminController->save();
    }, "POST");

    Router::add('/admin/([0-9]*)', static function ($id) {
        $adminController = new AdminController();
        echo $adminController->show($id);
    });

    Router::add('/admin/([0-9]*)/edit', static function ($id) {
        $adminController = new AdminController();
        echo $adminController->edit($id);
    });

    Router::add('/admin/([0-9]*)', static function ($id) {
        $adminController = new AdminController();
        $adminController->update($id);
    }, "POST");

    Router::add('/admin/([0-9]*)/delete', static function ($id) {
        $adminController = new AdminController();
        $adminController->delete($id);
    }, );

    Router::add('/logout', static function () {
        $homeController = new AdminController();
        $homeController->logout();
    });
}

// Run the router
Router::run('/');