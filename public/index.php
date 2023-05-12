<?php
require("../vendor/autoload.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $router = new \Router\Router();

    $router->add('/', function() {
        require("../index.php");
        require("../view/index.php");
    });

    $router->add('/auth/login', function() {
        require("../index.php");
        require("../view/auth/login.php");
    });

    $router->add('/auth/register', function() {
        require("../index.php");
        require("../view/auth/register.php");
    });

    $router->add('/auth/logout', function() {
        require("../index.php");
        require("../view/auth/logout.php");
    });

    $router->add('/i', function() {
        require("../index.php");
        require("../view/image/imageEmbed.php");
    });

    $router->add('/dashboard', function() {
        require("../index.php");
        require("../view/images.php");
    });

    $router->add('/config', function() {
        require("../index.php");
        require("../view/embedConfig.php");
    });

    $router->add("/api/config", function() {
        require("../index.php");
        require("../api/sharex.php");
    });

    $router->add("/api/upload", function() {
        require("../index.php");
        require("../api/upload.php");
    });

    $router->add("/api/delete", function() {
        require("../index.php");
        require("../api/delete.php");
    });

    $router->add("/api/report", function() {
        require("../index.php");
        require("../api/report.php");
    });

    $router->add("/(.*)", function() {
        require("../index.php");
        require("../view/errors/404.php");
    });

    $router->route();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
