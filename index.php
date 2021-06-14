<?php

use App\Controller\Admin\AdminController;
use App\Controller\NewsController;
use App\Controller\StartController;
use App\Helper\RequestHelper;

session_start();

require './vendor/autoload.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
ini_set('display_errors', 1);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/');
$dotenv->load();

/**
 * Routing for application
 */
switch (RequestHelper::getRequestController()) {
    case 'admin':
        $admin = new AdminController();
        $admin->adminRoutes(RequestHelper::getRequestAction());
        return;
    case 'news':
        $news = new NewsController();
        if (RequestHelper::verifyControllerMethod($news)){
            return call_user_func_array([new NewsController(), RequestHelper::getRequestControllerMethod()], []);
        }
        $news->addError("Requested method not found");
        break;
    default:
        $start = new StartController();
        $start->start();
        break;
}