<?php
session_start();
if(isset($_SESSION["username"])){
    echo '<script>window.location.href="index.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hallam Jones Reporting</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">    
    <link href="../dist/css/style.css" rel="stylesheet">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">                
                <div class="row login-page-logo">
                    <img src="../images/hallam_reporting_logo.png" alt="Hallam Reporting" class="admin-logo-img"/>
                </div>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Please Log In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="submitLoginForm">
                            <div class="form-group">
                                <div id="message"></div>
                            </div>
                            <fieldset>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user text-danger"></i></span>
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-danger"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <!--<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox">Remember Me
                                    </label>
                                </div>-->
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group text-center">
                                    <button type="submit" id="loginSubmitButton" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-log-in"></i> Log in</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="panel-footer text-center">
                        Made with love by <a href="http://www.eclecticsolutions.in" target="_blank">Eclectic Solutions</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="../js/login.js"></script>

</body>

</html>
