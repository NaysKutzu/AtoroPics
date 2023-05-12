<?php
if ($settings['enable_registration'] == "false")
{
  header('location: login');
}
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    $lifetime = 30 * 24 * 60 * 60; 
    ini_set('session.gc_maxlifetime', $lifetime);
    session_set_cookie_params($lifetime);
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: /dashboard");
        die();
    }
    if ($settings['enable_smtp'] == "true") {
      $smtp_host = $settings['smtp_host'];
      $smtp_username = $settings['smtp_user'];
      $smtp_password = $settings['smtp_password'];
      $smtp_port = $settings['smtp_port'];
      $smtp_from = $settings['smtp_from'];
      $name = $settings['smtp_from_name'];
    }
    $length = 16;
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < $length; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $key = implode($pass);
    $ip_addres = getclientip();
    $msg = "";

    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
        if ($settings['enable_smtp'] == "true")
        {
          $code = mysqli_real_escape_string($conn, md5(rand()));
        }
        else
        {
          $code = "null";
        }
        
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0) {
            $msg = "<div class='alert alert-danger'>{$email} - This email address is in use.</div>";
        }
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE username='{$name}'")) > 0) {
          $msg = "<div class='alert alert-danger'>{$name} - This username is in use.</div>";
        } 
        else {
            if ($password === $confirm_password) {
                $default = "https://www.gravatar.com/avatar/00000000000000000000000000000000";
                $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default );

                $sql = "INSERT INTO users (username, avatar, email, password, code, last_ip, register_ip, api_key, admin, embed_title, embed_desc, embed_theme, embed_sitename) VALUES ('{$name}', '{$grav_url}', '{$email}', '{$password}', '{$code}', '{$ip_addres}', '{$ip_addres}', '{$key}', 'false', 'AtoroShare', '#ffff' ,'A free image hosting service', 'Didcom')";
                $result = mysqli_query($conn, $sql);
                
                if ($result) {
                    echo "<div style='display: none;'>";
                    //Create an instance; passing `true` enables exceptions
                    if ($settings['enable_smtp'] == "true") {
                      $mail = new PHPMailer(true);

                      try {
                          //Server settings
                          $mail->SMTPDebug = 2;                      //Enable verbose debug output
                          $mail->isSMTP();                                            //Send using SMTP
                          $mail->Host       = $smtp_host;                     //Set the SMTP server to send through
                          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                          $mail->Username   = $smtp_username;                     //SMTP username
                          $mail->Password   = $smtp_password;                               //SMTP password
                          $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                          $mail->Port       = $smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
                          //Recipients
                          $mail->setFrom($smtp_from);
                          $mail->addAddress($email);
  
                          //Content
                          $mail->isHTML(true);                                  //Set email format to HTML
                          $mail->Subject = 'no reply';
                          $mail->Body    = 'Here is the verification link <b><a href="https://img.atoro.tech/auth/login/?verification='.$code.'">https://img.atoro.tech/auth/login/?verification='.$code.'</a></b>';
  
                          $mail->send();
                          echo 'Message has been sent';
                      } catch (Exception $e) {
                          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                      }
                      echo "</div>";
                      $msg = "<div class='alert alert-info'>We've send a verification link on your email address.</div>";
                    }
                    else
                    {
                      echo "</div>";
                      $msg = "<div class='alert alert-info'>Thanks for using ".$settings['app_name']."</div>";
                      header('location: login');
                    }
                    
                } else {
                  echo "</div>";
                    $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
                }
            } else {
              echo "</div>";
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
            }
        }
    }
?>

<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta17
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?= $settings['app_name'] ?> | Register</title>
    <!-- CSS files -->
    <link href="/dist/css/tabler.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/tabler-flags.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/tabler-payments.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/tabler-vendors.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/demo.min.css?1674944402" rel="stylesheet"/>
  
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="/dist/js/demo-theme.min.js?1674944402"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
      <?php echo $msg; ?>
        <form class="card card-md" action="" method="post" autocomplete="off" novalidate>
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Create new account</h2>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="name" value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" placeholder="Enter name">
            </div>
            <div class="mb-3">
              <label class="form-label">Email address</label>
              <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" placeholder="Enter email">
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control"  name="password"  placeholder="Password"  autocomplete="off">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Confirm Password</label>
              <div class="input-group input-group-flat">
                <input type="password" class="form-control"  name="confirm-password"   placeholder="Repeat Password"  autocomplete="off">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-check">
                <input type="checkbox" class="form-check-input"/>
                <span class="form-check-label">Agree the <a href="./terms-of-service.html" tabindex="-1">terms and policy</a>.</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit"  name="submit" class="btn btn-primary w-100">Create new account</button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Already have account? <a href="./login" tabindex="-1">Sign in</a>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js?1674944402" defer></script>
    <script src="/dist/js/demo.min.js?1674944402" defer></script>
  </body>
</html>