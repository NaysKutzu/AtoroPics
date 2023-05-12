<?php 
$enable_template= "true";

if ($enable_template == "true")
{
  ?>
  <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AtoroPics | Home</title>
</head>
<body>
    <center>
        <p>Welcome to AtoroPics</p>
        <p>This is the default template for the instalation</p>
        <p>Make sure to replace this with your custom build template</p>
        <p>To upload the template make sure to go in <code>/view/index.php</code></p>
        <p>If you don't need a custom template you can allways disable it from /view/index.php</p>
        <p>At the first line</p>
    </center>
</body>
</html>
  <?php
}
else
{
    header('location: /dashboard');
}
?>
