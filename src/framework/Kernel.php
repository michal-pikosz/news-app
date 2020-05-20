<?php

/*
|--------------------------------------------------------------------------
| Start the session required for user logins
|--------------------------------------------------------------------------
*/
session_start();

/*
|--------------------------------------------------------------------------
| Autloader for classes
|--------------------------------------------------------------------------
|
| Automatic specification used
| loading classes in the project is PSR-4
|
*/
require __DIR__ . '/../../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| File that defines paths in the application
|--------------------------------------------------------------------------
|
| Allows you to map urls to individual controller actions
|
*/
require __DIR__ . '/../../config/Routes.php';