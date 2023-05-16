<?php 
$lifetime = 30 * 24 * 60 * 60;
ini_set('session.gc_maxlifetime', $lifetime);
session_set_cookie_params($lifetime);
session_start();
if (!isset($_SESSION['loggedin'])) {
  header("Location: ../../auth/login");
}
?>