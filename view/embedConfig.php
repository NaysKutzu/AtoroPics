<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../../auth/login");
}


$userdb = $conn->query("SELECT * FROM users WHERE api_key = '" . mysqli_real_escape_string($conn, $_SESSION["api_key"]) . "'")->fetch_array();
$usrname = $userdb['username'];

$username = $userdb['username'];
$desc = $userdb['embed_desc'];
$desc_title = $userdb['embed_title'];
$embed_theme = $userdb['embed_theme'];
$site_name = $userdb['embed_sitename'];

$result = mysqli_query($conn, "SELECT * FROM imgs");

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $desc = $_POST['desc'];
  $colour =  $_POST['colour'];
  mysqli_query($conn, 'UPDATE users SET embed_title="'.$title.'" WHERE api_key="'.mysqli_real_escape_string($conn, $_SESSION["api_key"]).'"');
  mysqli_query($conn, 'UPDATE users SET embed_desc="'.$desc.'" WHERE api_key="'.mysqli_real_escape_string($conn, $_SESSION["api_key"]).'"');
  mysqli_query($conn, 'UPDATE users SET embed_theme="'.$colour.'" WHERE api_key="'.mysqli_real_escape_string($conn, $_SESSION["api_key"]).'"');
}


?>

<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta17
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net <?php echo $usrname ?>
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title><?php $siteName ?></title>
    <script defer data-api="/stats/api/event" data-domain="preview.tabler.io" src="/stats/js/script.js"></script>
    <meta name="msapplication-TileColor" content=""/>
    <meta name="theme-color" content=""/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="MobileOptimized" content="320"/>
    <link rel="icon" href="<?= $settings['app_logo']?>" type="image/x-icon"/>
    <link rel="shortcut icon" href="<?= $settings['app_logo']?>" type="image/x-icon"/>
    <meta name="description" content="Mythical Images comes with free hosting for your images. Get started today for free at MythicalSystems.xyz"/>
    <meta name="twitter:image:src" content="https://cdn.discordapp.com/attachments/1037824534880993310/1106309882677825696/New.png">
    <meta name="twitter:site" content="@Mythical_ui">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="An image host, that cares.">
    <meta name="twitter:description" content="Mythical Images comes with free hosting for your images. Get started today for free at MythicalSystems.xyz">
    <meta property="og:image" content="https://cdn.discordapp.com/attachments/1037824534880993310/1106309882677825696/New.png">
    <meta property="og:image:width" content="1280">
    <meta property="og:image:height" content="640">
    <meta property="og:site_name" content="Mythical">
    <meta property="og:type" content="object">
    <meta property="og:title" content="An image host, that cares.">
    <meta property="og:url" content="https://cdn.discordapp.com/attachments/1037824534880993310/1106309882677825696/New.png">
    <meta property="og:description" content="Mythical Images comes with free hosting for your images. Get started today for free at MythicalSystems.xyz">
    <!-- CSS files -->
    <link href="/dist/css/tabler.min.css?1674944800" rel="stylesheet"/>
    <link href="/dist/css/tabler-flags.min.css?1674944800" rel="stylesheet"/>
    <link href="/dist/css/tabler-payments.min.css?1674944800" rel="stylesheet"/>
    <link href="/dist/css/tabler-vendors.min.css?1674944800" rel="stylesheet"/>
    <link href="/dist/css/demo.min.css?1674944800" rel="stylesheet"/>
    <link rel="stylesheet" href="/dist/css/discordEmbed.css">
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
  <body >
    <script src="/dist/js/demo-theme.min.js?1674944800"></script>
    <div class="page">
      <!-- Navbar -->
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
            <?= $settings['app_name']?>
            </a>
          </h1>
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                <span class="avatar avatar-sm" style="background-image: url(/static/avatars/000m.jpg)"></span>
                <div class="d-none d-xl-block ps-2">
                  <div>
                    <?php echo $usrname ?>
                  </div>
                  
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <a href="/auth/logout" class="dropdown-item">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header>
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                <li class="nav-item ">
                  <a class="nav-link" href="/dashboard" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M15 8h.01"></path>
                      <path d="M11.5 21h-5.5a3 3 0 0 1 -3 -3v-12a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v7"></path>
                      <path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4"></path>
                      <path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l.5 .5"></path>
                      <path d="M15 19l2 2l4 -4"></path>
                    </svg>                  
                  </span>
                    <span class="nav-link-title">
                      Images
                    </span>
                  </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="/config">
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/package -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Embed Config
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </header>
      <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl d-flex flex-column justify-content-center">
          <div class="row row-cards">
            <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">User Config</h3>
                  </div>
                  <div class="card-body">
                  <form id="embedForm" action="" method="post">
                    <div class="mb-3">
                      <div class="row">
                        <div class="col-xl-8">
                          <div class="row">
                            <div class="mb-3">
                              <label class="form-label">Image Title</label>
                              <input type="text" class="form-control" name="title" placeholder="AtoroShare" name="title" value="<?php if (isset($_POST['submit'])) { echo $title; } ?>" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Image Description</label>
                              <textarea type="text" class="form-control" name="desc" rows="4" name="desc" placeholder="My cool image hosting site..." value="<?php if (isset($_POST['submit'])) { echo $desc; } ?>" required></textarea>
                            </div>
                            <label class="form-label">Image Embed Colour</label>
                            <div class="input-group mt-2">
                              <input type="text" class="form-control" style="background-color: #26334c; text-align: center;" id="embedColour-text" name="embedColour" readonly>
                              <div class="input-group-append">
                              <span class="input-group-text" id="embedColour-wrapper" >
                                <input type="color" id="embedColour" name="colour" value="<?php echo $embed_theme ?>" style="opacity: 0%;">
                              </span>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                     <div class="card-footer text-end">
                     <a href="/api/config" class="btn btn-secondary">Download Config</a>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Embed Config</h3>
                  </div>
                  <div class="card-body">
                  <form id="embedForm" method="POST">
                  <div id="embedViewer-wrapper">
                     <div class="card" id="embedViewer" style="width: 100%!important; height: 400px;">
                        <div class="card-body pt-0" id="embedViewer_body">
                           <input type="text" class="card-title embedViewer-input mb-0 mt-2" name="embedViewer_title" id="embedViewer_title" placeholder="<?php echo $desc_title ?>" readonly>
                           <textarea class="embedViewer-input mb-0" name="embedViewer_description" id="embedViewer_description" placeholder="Embed description..." readonly><?php echo $desc ?></textarea>
                           <div style="text-align: left; margin-top: 16px;"><img class="img-fluid" id="embedViewer_image" src="https://cdn.discordapp.com/attachments/1037824534880993310/1106309882677825696/New.png" style="height: 640; width: 1280; border-radius: 10px;"></div>
                        </div>
                     </div>
                  </div>
               </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                <li class="list-inline-item">
                    <a href="" class="link-secondary" rel="noopener">
                      v1.3.5
                    </a>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; 2023
                    <a href="." class="link-secondary">Atoro</a>.
                    All rights reserved.
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script type="text/javascript">

         function updateEmbedColour() {
             var colourPicker = document.getElementById("embedColour");
             var colourValue = document.getElementById("embedColour-text");
             var colourWrapper = document.getElementById("embedColour-wrapper");
         
             colourValue.value = colourPicker.value;
             $('#embedViewer').css('border-left', "4px solid " + colourPicker.value);
             $('#embedColour-wrapper').css('background', colourValue.value);
             setTimeout(updateEmbedColour, 1);
             }
         updateEmbedColour();
      </script>   
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/dist/js/tabler.min.js?1674944800" defer></script>
    <script src="/dist/js/demo.min.js?1674944800" defer></script>
  </body>
</html>


