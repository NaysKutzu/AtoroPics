<?php
$lifetime = 30 * 24 * 60 * 60; 
ini_set('session.gc_maxlifetime', $lifetime);
session_set_cookie_params($lifetime);
session_start();
session_unset();
session_destroy();

header("Location: /auth/login");
?>