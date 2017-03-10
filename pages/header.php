<?php
require_once('session-check.php');
require_once('dbconnection.php');
require_once('constants.php');
require_once('individuals-pending-report-query.php');
require_once('individuals-utr-report-query.php');
require_once('companies-pending-report-query.php');
require_once('companies-annual-report-query.php');
require_once('individuals-vats-pending-report-query.php');
require_once('companies-vats-pending-report-query.php');
require_once('companies-vats-pending-report-query.php');
require_once('tasks-pending-report-query.php');
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

    <!-- Bootstrap Multiselect CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap-multiselect.css" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/responsive.dataTables.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">    
    <link href="../dist/css/style.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!--<link href="../bower_components/morrisjs/morris.css" rel="stylesheet">-->

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>  

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Bootstrap Multiselect JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap-multiselect.js"></script>

    <!--Datepicker CSS And Js files-->

    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="../bower_components/bootstrap/dist/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap-datepicker3.css"/>    

    <script type="text/javascript">
    
    /*Datepicker For Company's Shareholder Updation*/

    function showDatePicker(id){
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        $('#'+id).datepicker({
            format: 'dd-mm-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    }
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img src="../images/hallam_reporting_logo.png" alt="Hallam Reporting" class="admin-logo-img"/></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- Shows Latest 4 Pending Tasks for current month -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <?php                        
                            if($resultTasksPendingHeader->num_rows > 0){
                                $i = 1;
                                while($rowTaskPending = $resultTasksPendingHeader->fetch_array()){
                                    if($i < 5){
                                        if($rowTaskPending['individual_id'] != ""){
                                            $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = " . $rowTaskPending['individual_id']);
                                            if($resultIndividual->num_rows > 0){
                                                while($rowIndividual =$resultIndividual->fetch_assoc()){
                                                    $taskOwner =  $rowIndividual["firstname"].' '.$rowIndividual["surname"];
                                                }
                                            }else{
                                                $taskOwner = 'No Individual';
                                            }
                                        }else{
                                            $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = " . $rowTaskPending['company_id']);
                                            if($resultCompany->num_rows > 0){
                                                while($rowCompany =$resultCompany->fetch_assoc()){
                                                    $taskOwner = $rowCompany["company_name"];
                                                }
                                            }else{
                                                $taskOwner = 'No Comapny';
                                            }
                                        }

                                        echo '<li>
                                            <a href="task.php?id='.$rowTaskPending['id'].'">
                                                <div>
                                                    <strong>'.$taskOwner.'</strong>
                                                    <span class="pull-right text-muted">
                                                        <em>'.date('d-m-Y', strtotime($rowTaskPending['task_action_date'])).'</em>
                                                    </span>
                                                </div>
                                                <div>'.substr($rowTaskPending['task'], 0, 56)."...".'</div>
                                            </a>
                                        </li>
                                        <li class="divider"></li>';
                                    }
                                    $i++;
                                }
                            }else{
                                echo '<li><div class="error-message">No Task Found</div></li>
                                <li class="divider"></li>';
                            }
                        ?>
                        <li>
                            <a class="text-center" href="tasks-pending-report.php">
                                <strong>Read All Pending Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <!-- Shows Pending Reports For all module -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="individuals-pending-report.php">
                                <div>
                                    <i class="fa fa-users fa-fw"></i> Individual Pending
                                    <span class="pull-right text-muted small"><?php echo $no_of_individuals_pending; ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="companies-pending-report.php">
                                <div>
                                    <i class="fa fa-cubes fa-fw"></i> Companies Pending
                                    <span class="pull-right text-muted small"><?php echo $no_of_companies_pending; ?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="individuals-vats-pending-report.php">
                                <div>
                                    <i class="fa fa-line-chart fa-fw"></i> Individuals VAT Pending
                                    <span class="pull-right text-muted small"><?php echo $no_of_individuals_vats_pending;?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="companies-vats-pending-report.php">
                                <div>
                                    <i class="fa fa-line-chart fa-fw"></i> Companies VAT Pending
                                    <span class="pull-right text-muted small"><?php echo $no_of_companies_vats_pending;?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="tasks-pending-report.php">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> Tasks Pending
                                    <span class="pull-right text-muted small"><?php echo $no_of_tasks_pending;?></span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="index.php#allNotifications">
                                <strong>See All Notifications</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="user-profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="user-profile.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->