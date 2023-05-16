<?php
require("../vendor/autoload.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $router = new \Router\Router();

    $router->add('/', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/index.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/");  
        }
    });

    $router->add('/auth/login', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/auth/login.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/auth/login");  
        }
        
    });

    $router->add('/auth/register', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/auth/register.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/auth/register");  
        }
        
    });

    $router->add('/auth/logout', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/auth/logout.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/auth/logout");  
        }
    });

    $router->add('/test', function(){
        require("../index.php");
        require('../view/test.php');
    }); 

    $router->add('/i', function() {
        require("../index.php");
        require("../view/image/imageEmbed.php");
    });

    $router->add('/dashboard', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/images.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/dashboard");  
        }
        
    });

    $router->add('/config', function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/embedConfig.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/config");  
        }
        
    });

    $router->add("/api/config", function() {
        require("../index.php");
        require("../api/sharex.php");
    });

    $router->add("/api/upload", function() {
        require("../index.php");
        require("../api/upload.php");
    });

    $router->add("/domains", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/domainList.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/domains");  
        }
    });

    $router->add("/domain/add",function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/addDomain.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/domain/add");  
        }
    });

    $router->add("/admin",function() {
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/mainPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin");  
        }
    });

    $router->add("/admin/settings",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/settingsPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/settings");  
        }
    });
    

    $router->add("/admin/settings/advanced",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/advancedsettingsPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/settings/advanced");  
        }
    });


    $router->add("/admin/settings/mail",function(){
        require('../index.php');
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../view/admin/emailPage.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/admin/settings/mail");  
        }
    });

    $router->add("/api/delete", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../api/delete.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/api/delete");  
        }
    });

    $router->add("/api/report", function() {
        require("../index.php");
        if ($_SERVER['HTTP_HOST'] == $settings['app_url'])
        {
            require("../api/report.php");
        } else {
          header('location: '.$settings['app_proto'].$settings['app_url']."/api/report");  
        }
        
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
