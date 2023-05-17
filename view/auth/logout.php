<?php
session_start();
session_unset();
session_destroy();
setcookie('api_key', '', time() - 3600, '/');
setcookie('phpsessid', '', time() - 3600, '/');
header("Location: /auth/login");
?>