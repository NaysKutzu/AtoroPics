<?php
header('Content-Type: application/json');
$lifetime = 30 * 24 * 60 * 60; 
ini_set('session.gc_maxlifetime', $lifetime);
session_set_cookie_params($lifetime);
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../auth/login");
}


$userdb = $conn->query("SELECT * FROM users WHERE api_key = '" . mysqli_real_escape_string($conn, $_SESSION["api_key"]) . "'")->fetch_array();

$sharexconfigfile = '{
  "Version": "15.0.0",
  "Name": "'.$settings['app_name'].'",
  "DestinationType": "ImageUploader, TextUploader, FileUploader",
  "RequestMethod": "POST",
  "RequestURL": "'.$settings['app_proto'].$settings['app_url'].'/api/upload",
  "Body": "MultipartFormData",
  "Arguments": {
    "api_key": "'.$userdb["api_key"].'"
  },
  "FileFormName": "file",
  "URL": "{response}"
}
';
$filenamet = time();
$file = $settings['app_name'].'_'.$userdb['username'].'_SharexConfig.sxcu';
file_put_contents($file, $sharexconfigfile);
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=".basename($file));
header("Content-Length: ".filesize($file));
readfile($file);
unlink($file);


exit;

?>