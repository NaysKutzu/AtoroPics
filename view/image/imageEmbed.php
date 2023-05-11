<?php


if(isset($_GET['i'])){
    $json_file = 'storage/json/' . $_GET['i']. '.json';
    if(file_exists($json_file)){
        $json_data = file_get_contents($json_file);
        $data = json_decode($json_data, true);
        if(!is_null($data)){
            echo '<html lang="en">
            <head>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"> </script>
                <link rel="stylesheet" href="assets/css/style.css">
                <meta name="robots" content="noindex">
                <link rel="stylesheet" href="./dist/css/argon.css">
                <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.3/css/all.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                <link rel="icon" type="image/png" href="'.$settings['logo'].'">
                <title>'.$settings['name'].' | ' . $data['title'] . '</title>
                <meta property="twitter:card" content="summary_large_image" />
                <meta property="twitter:image" content="' .  $data['url'] .'" />
                <meta property="og:image" content="'. $data['url'] .'" />
               
                <link type="application/json+oembed" href="https://img.atoro.tech/'. $json_file .' " />
            </head>
            <body class="" style="background-color: #1a2234;">
            <br><br>

                <div class="row mt-4 no-gutters">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 mx-2">
                        <div class="card card-stats text-center card-shadow bg-darker mb-4">
                            <div class="card-body">
                                <h3 class="card-title mb-0">
                                ' . $data['title'] . '
                                </h3>
                                
                    <h5 class="card-title mb-4">
                    ' . $data['description'] . '
                    </h5>
                
                                
                    <a href="'. $data['url'] .'" target="_blank">
                        <img src="'. $data['url'] .'" alt="image"
                            style="max-height: 75vh; width: auto; max-width: 100%; border-radius: 0.25rem" />
                    </a>
                
                                <h5 class="mt-4 mb-0">
                                    Uploaded By: <code>'. $data['username'] .'</code>
                       </a>
                                </h5>
                                <h6 class="mb-3">
                                    Uploaded At: <span class="text-white-50">' . $data['date'] . '</span>
                                    <br>
                                    Upload size: <span class="text-white-50">' . $data['filesize'] . '</span>
                                </h6>
                                
                        <button class="btn btn-danger" data-toggle="modal" id="report" data-target="#reportModal">
                            <span class="btn-inner--icon">
                                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                            </span>
                            Report
                        </button>
                        <button onclick="copyImage()" class="btn btn-info" data-toggle="modal" data-target="#reportModal">
                            <span class="btn-inner--icon">
                                <i class="fa fa-clipboard mr-2"></i>
                            </span>
                            Copy
                        </button>
                    
                                <a href="'.$data['url'].'" download target="_blank" class="btn btn-success">
                                    <span class="btn-inner--icon">
                                        <i class="fas fa-cloud-download mr-2"></i>
                                    </span>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </body>
        <script>
        function copyImage() {
            fetch("'.$data['url'].'")
                .then(response => response.blob())
                .then(blob => {
                    const item = new ClipboardItem({"image/png": blob});
                    navigator.clipboard.write([item]);
                });
        }
    </script>
    <script>
    var reportButton = document.getElementById("report");

    // Check if the button was previously clicked by the user for this URL
    var lastClicked = localStorage.getItem("lastClicked_" + window.location.href);
    if (lastClicked !== null) {
      var now = Date.now();
      var timeSinceLastClick = now - parseInt(lastClicked, 10);
      if (timeSinceLastClick < 500000) { // Disable the button if less than 5 seconds have passed
        reportButton.disabled = true;
        setTimeout(function() {
          reportButton.disabled = false;
        }, 500000 - timeSinceLastClick);
      }
    }
    
    reportButton.addEventListener("click", function() {
      // Disable the button
      reportButton.disabled = true;
    
      // Store the current timestamp in localStorage for this URL
      localStorage.setItem("lastClicked_" + window.location.href, Date.now().toString());
    
      var message = prompt("Please enter a message:");
      if (message !== null) {
        // User clicked OK, send message and URL to server
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/api/report", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              alert("Upload successful!");
            } else {
              alert("Upload failed.");
            }
    
            // Re-enable the button after 5 seconds
            setTimeout(function() {
              reportButton.disabled = false;
            }, 500000);
          }
        };
        xhr.send("message=" + encodeURIComponent(message) + "&url=" + encodeURIComponent(window.location.href));
      } else {
        // Re-enable the button immediately if the user clicked "Cancel"
        reportButton.disabled = false;
      }
    });
            
    </script>
        </html>';
        } else {
            echo '<script>window.location.replace("'.$settings['app_proto'].$settings['app_url'].'");</script>';
            die();
        }
    } else {
        echo '<script>window.location.replace("'.$settings['app_proto'].$settings['app_url'].'");</script>';
        die();
    }
} else {
    ?>  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="<?= $settings['logo'] ?>">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $settings['name']?> | Home </title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
    <!--Replace with your tailwind.css once created-->
    <link href="https://unpkg.com/@tailwindcss/custom-forms/dist/custom-forms.min.css" rel="stylesheet" />

    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");

      html {
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }
    </style>
  </head>

  <body class="leading-normal tracking-normal text-indigo-400 m-6 bg-cover bg-fixed" style="background-image: url('assets/header.png');">
    <div class="h-full">
      <!--Nav-->
      <div class="w-full container mx-auto">
        <div class="w-full flex items-center justify-between">
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500"><?= $settings['name'] ?></span>
          </a>

          <div class="flex w-1/2 justify-end content-center">
            <a class="inline-block text-blue-300 no-underline hover:text-pink-500 hover:text-underline text-center h-10 p-2 md:h-auto md:p-4 transform hover:scale-125 duration-300 ease-in-out" href="<?= $settings['discord'] ?>">
              <svg class="fill-current h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127.14 96.36">
                <path
                  d="M107.7,8.07A105.15,105.15,0,0,0,81.47,0a72.06,72.06,0,0,0-3.36,6.83A97.68,97.68,0,0,0,49,6.83,72.37,72.37,0,0,0,45.64,0,105.89,105.89,0,0,0,19.39,8.09C2.79,32.65-1.71,56.6.54,80.21h0A105.73,105.73,0,0,0,32.71,96.36,77.7,77.7,0,0,0,39.6,85.25a68.42,68.42,0,0,1-10.85-5.18c.91-.66,1.8-1.34,2.66-2a75.57,75.57,0,0,0,64.32,0c.87.71,1.76,1.39,2.66,2a68.68,68.68,0,0,1-10.87,5.19,77,77,0,0,0,6.89,11.1A105.25,105.25,0,0,0,126.6,80.22h0C129.24,52.84,122.09,29.11,107.7,8.07ZM42.45,65.69C36.18,65.69,31,60,31,53s5-12.74,11.43-12.74S54,46,53.89,53,48.84,65.69,42.45,65.69Zm42.24,0C78.41,65.69,73.25,60,73.25,53s5-12.74,11.44-12.74S96.23,46,96.12,53,91.08,65.69,84.69,65.69Z"
                ></path>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!--Main-->
      <div class="container pt-24 md:pt-36 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
          <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
          Welcome to
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 via-pink-500 to-purple-500">
              <?= $settings['name'] ?>!
            </span>
          </h1>
          <p class="leading-normal text-base md:text-2xl mb-8 text-center md:text-left">
          A place where you can upload your imagines for free and have a nice embed for discord
          </p>
          <form action="auth/register.php" method="GET" class="bg-gray-900 opacity-75 w-full shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
              <label class="text-center block text-blue-300 py-2 font-bold mb-2" for="emailaddress">
                Register here
              </label>
              <label>Username: </label>
              <input name="username" class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="username" type="text" placeholder="NaysKutzu"/>
              <br/>
              <label>Email: </label>
              <input name="email" class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="emailaddress" type="email" placeholder="you@somewhere.com"/>
              <label>Password: </label>
              <nr/>
              <input name="password" class="shadow appearance-none border rounded w-full p-3 text-gray-700 leading-tight focus:ring transform transition hover:scale-105 duration-300 ease-in-out" id="password" type="password" placeholder="*******"/>
            
            </div>

            <div class="flex items-center justify-between pt-4 text-center">
                <button type="submit" name="submit" value="yes" class="mx-auto bg-gradient-to-r from-purple-800 to-green-500 hover:from-pink-500 hover:to-green-500 text-white font-bold py-2 px-4 rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out">Sign Up</button>
            </div>
          </form>
        </div>

        <!--Right Col-->
        <div class="w-full xl:w-3/5 p-12 overflow-hidden">
          <img class="mx-auto w-full md:w-4/5 transform -rotate-6 transition hover:scale-105 duration-700 ease-in-out hover:rotate-6 rounded" src="assets/1674567587.png" />
        </div>
      </div>
    </div>
  </body>
</html>

    
    <?php
}
?>
