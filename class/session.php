<?php 
if (isset($_COOKIE['api_key'])) {
  $session_id = $_COOKIE['api_key'];
  $query = "SELECT * FROM atoropics_users WHERE api_key='".$session_id."'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
      session_start();
      $userdbd = $conn->query("SELECT * FROM atoropics_users WHERE api_key='$session_id'")->fetch_array();
      $_SESSION["api_key"] = $session_id;
      $_SESSION['loggedin'] = true;
      $_SESSION["email"] = $userdbd['email'];
      $_SESSION["username"] = $userdbd['username'];
  }
  else
  {
      setcookie('api_key', '', time() - 3600, '/');
      setcookie('phpsessid', '', time() - 3600, '/');
      echo '<script>window.location.replace("/auth/login");</script>';
  }

}
else
{
  setcookie('api_key', '', time() - 3600, '/');
  setcookie('phpsessid', '', time() - 3600, '/');
  echo '<script>window.location.replace("/auth/login");</script>';
}
?>