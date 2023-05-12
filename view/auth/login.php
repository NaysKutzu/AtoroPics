<?php
$recaptcha = new \ReCaptcha\ReCaptcha( '6LcLogUmAAAAAFMx41gnONPP1Nn2HYSt6GTTRsMz' );

$lifetime = 30 * 24 * 60 * 60; 
ini_set('session.gc_maxlifetime', $lifetime);
session_set_cookie_params($lifetime);
    session_start();
    if (isset($_SESSION['SESSION_EMAIL'])) {
        header("Location: /dashboard");
        die();
    }

    $msg = "";

    if (isset($_GET['verification'])) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE code='{$_GET['verification']}'")) > 0) {
            $query = mysqli_query($conn, "UPDATE users SET code='' WHERE code='{$_GET['verification']}'");
            
            if ($query) {
                $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
            }
        } else {
            header("Location: /dashboard");
        }
    }

    if (isset($_POST['submit'])) {
        $resp      = $recaptcha->setExpectedHostname( $_SERVER['HTTP_HOST'] )
        ->verify( $_POST["g-recaptcha-response"], $_SERVER['REMOTE_ADDR'] );
        if ( $resp->isSuccess() ) {
          $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            $api_key = $row['api_key'];
            $_SESSION["api_key"] = $api_key;
            $_SESSION['loggedin'] = true;
            $email = $row['email'];
            $_SESSION["email"] = $email;
            $username = $row['username'];
            $_SESSION["username"] = $username;

            if (empty($row['code'])) {
                $_SESSION['SESSION_EMAIL'] = $email;
                header("Location: /dashboard");
                // logClient("Email : " . $_SESSION["email"] .' & Username : '. $_SESSION["username"] .' ');
            } else {
                $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
            }
        } else {
            $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
        }
        } else {
            // code for showing an error message goes here
            $errors = $resp->getErrorCodes();
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
    <title><?= $settings['app_name']?> | Login</title>
    <!-- CSS files -->
    <link href="/dist/css/tabler.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/tabler-flags.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/tabler-payments.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/tabler-vendors.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/css/demo.min.css?1674944402" rel="stylesheet"/>
    <link href="/dist/js/block.js" rel="stylesheet"/>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="./static/logo.svg" height="36" alt=""></a>
        </div>
        <?php echo $msg; ?>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>
            <form action="" method="post" autocomplete="off" novalidate>
              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email"  class="form-control" placeholder="your@email.com" autocomplete="off">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" name="password" class="form-control"  placeholder="Your password"  autocomplete="off">
                  <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                    </a>
                  </span>
                </div>
              </div>
              <div class="g-recaptcha" data-sitekey="6LcLogUmAAAAAKkDgK6n-kY0-8dE6JugooBrY9bt"></div>
              <div class="form-footer">
                <button type="submit" name="submit" class="btn btn-primary w-100">Sign in</button>
              </div>
            </form>
          </div>
        </div>
        <div class="text-center text-muted mt-3">
          Don't have account yet? <a href="register" tabindex="-1">Sign up</a>
        </div>
      </div>
    </div>     
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js?1674944402" defer></script>
    <script src="/dist/js/demo.min.js?1674944402" defer></script>
    <script>
      $('form').submit(function(e) {
   if ($("#g-recaptcha-response").val() === '') {
      e.preventDefault();
      alert("Please check the recaptcha");
   }
  });
    </script>
  </body>
</html>