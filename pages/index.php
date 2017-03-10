<?php 
require_once('header.php');
require_once('sidebar.php');
?>

            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $no_of_individuals_pending; ?></div>
                                </div>
                                <div class="col-xs-12">Individuals Pending</div>
                            </div>
                        </div>
                        <a href="individuals-pending-report.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cubes fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $no_of_companies_pending; ?></div>
                                </div>
                                <div class="col-xs-12">Companies Pending</div>
                            </div>
                        </div>
                        <a href="companies-pending-report.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-line-chart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $no_of_individuals_vats_pending;?></div>
                                </div>
                                <div class="col-xs-12">Individuals VAT Pending</div>
                            </div>
                        </div>
                        <a href="individuals-vats-pending-report.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-line-chart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $no_of_companies_vats_pending;?></div>
                                </div>
                                <div class="col-xs-12">Companies VAT Pending</div>
                            </div>
                        </div>
                        <a href="companies-vats-pending-report.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-extra-property">
                            <i class="fa fa-cubes fa-fw"></i> Annual Return For Companies In <span class="text-danger"><?php echo  date('F');?></span>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="companies-annual-report.php">View All</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Company Name</th>
                                        <th>Registration Date</th>
                                        <th>Annual Return Date</th>
                                        <th class="remove-shorting-icons text-center" style="width:93px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($resultCompaniesAnnual->num_rows > 0){
                                        $count_company = 1;
                                        while($row = $resultCompaniesAnnual->fetch_array()){
                                            if($count_company <= $no_of_elements){
                                                echo '<tr class="odd gradeA">
                                                    <td>'.$row["company_name"].'</td>
                                                    <td>'.date('d-m-Y', strtotime($row["registration_date"])).'</td>
                                                    <td class="text-center">'.date('d-m-Y', strtotime($row['annual_return_date'])).'</td>
                                                    <td class="text-center">
                                                        <a class="btn-xs btn-primary" href="company.php?id='.$row["id"].'"><i class="fa fa-eye"></i> View</a>
                                                    </td>
                                                </tr>';
                                            }
                                            $count_company++;
                                        }                                            
                                    }else{
                                        echo '<tr class="odd gradeA">
                                                <td colspan="6"><div class="error-message">No data found</div></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading panel-heading-extra-property">
                            <i class="fa fa-tasks fa-fw"></i> Pending Tasks In <span class="text-danger"><?php echo  date('F');?></span>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li class="divider"></li>
                                        <li><a href="tasks-pending-report.php">View All</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="timeline">
                                <?php
                                if($resultTasksPendingIndexPage->num_rows > 0){
                                    $count_task = 1;
                                    while($rowTask = $resultTasksPendingIndexPage->fetch_array()){
                                        if($count_task <= $no_of_elements){

                                            if($rowTask['individual_id'] != ""){
                                                $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = " . $rowTask['individual_id']);
                                                if($resultIndividual->num_rows > 0){
                                                    while($rowIndividual =$resultIndividual->fetch_assoc()){
                                                        $taskOwner =  '<a href="individual.php?id='.$rowIndividual["id"].'" target="_blank">'.$rowIndividual["firstname"].' '.$rowIndividual["surname"].'</a>';
                                                        $taskIcon = '<i class="fa fa-user"></i>';
                                                    }
                                                }else{
                                                    $taskOwner = '<span class="">No Individual Found</span>';
                                                    $taskIcon = '<i class="fa fa-cross"></i>';
                                                }
                                            }else{
                                                $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = " . $rowTask['company_id']);
                                                if($resultCompany->num_rows > 0){
                                                    while($rowCompany =$resultCompany->fetch_assoc()){
                                                        $taskOwner =  '<a href="company.php?id='.$rowCompany["id"].'" target="_blank">'.$rowCompany["company_name"].'</a>';
                                                        $taskIcon = '<i class="fa fa-institution"></i>';
                                                    }
                                                }else{
                                                    $taskOwner = '<span class="">No Comapny Found</span>';
                                                    $taskIcon = '<i class="fa fa-cross"></i>';
                                                }
                                            }
                                            echo '<li class="'.((($count_task % 2) == 0) ? "timeline-inverted" : "").'">
                                                <div class="timeline-badge '.((($count_task % 2) == 0) ? "info" : "warning").'">'.$taskIcon.'
                                                </div>
                                                <div class="timeline-panel">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title">'.$taskOwner.'</h4>
                                                        <p><small class="text-muted"><i class="fa fa-clock-o"></i> '.date('d-m-Y', strtotime($rowTask['task_creation_date'])).'</small>
                                                        </p>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>'.substr($rowTask['task'], 0, 200)."...".'</p>
                                                        <hr>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-gear"></i>  <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="task.php?id='.$rowTask["id"].'"> View Task</a>
                                                                </li>
                                                                <li class="divider"></li>
                                                                <li>
                                                                    <a href="edit-task.php?id='.$rowTask["id"].'"> Edit Task</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>';
                                        }
                                        $count_task++;
                                    }
                                }else{
                                    echo '<div class="error-message">No Task found</div>';
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-file-text fa-fw"></i> Latest Notes
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li><a href="individuals-notes.php">Individuals Notes</a>
                                    </li>
                                    <li><a href="companies-notes.php">Companies Notes</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#">Action</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul class="chat">
                                <?php
                                $resultNotes = mysqli_query($db->db_conn, "SELECT * FROM notes ORDER BY  note_creation_date DESC");
                                if($resultNotes->num_rows > 0){
                                    $count_note = 1;
                                    while($rowNote = $resultNotes->fetch_array()){
                                        if($count_note <= $no_of_elements){

                                            if($rowNote['individual_id'] != ""){
                                                $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = " . $rowNote['individual_id']);
                                                if($resultIndividual->num_rows > 0){
                                                    while($rowIndividual =$resultIndividual->fetch_assoc()){
                                                        $noteOwner =  '<a href="individual.php?id='.$rowIndividual["id"].'" target="_blank">'.$rowIndividual["firstname"].' '.$rowIndividual["surname"].'</a>';
                                                        $noteViewLink =  '<a href="individual.php?id='.$rowIndividual["id"].'#notes" target="_blank" class="btn-xs btn-primary '.((($count_note % 2) == 0) ? "pull-right" : "pull-left").'"><i class="fa fa-eye"></i> View</a>';
                                                        $noteIcon = '<i class="fa fa-user"></i>';
                                                    }
                                                }else{
                                                    $noteOwner = '<span class="">No Individual Found</span>';
                                                    $noteViewLink = '<span class="">No Note Link Found</span>';
                                                    $noteIcon = '<i class="fa fa-cross"></i>';
                                                }
                                            }else{
                                                $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = " . $rowNote['company_id']);
                                                if($resultCompany->num_rows > 0){
                                                    while($rowCompany =$resultCompany->fetch_assoc()){
                                                        $noteOwner =  '<a href="company.php?id='.$rowCompany["id"].'" target="_blank">'.$rowCompany["company_name"].'</a>';
                                                        $noteViewLink =  '<a href="company.php?id='.$rowCompany["id"].'#notes" target="_blank" class="btn-xs btn-primary '.((($count_note % 2) == 0) ? "pull-right" : "pull-left").'"><i class="fa fa-eye"></i> View</a>';
                                                        $noteIcon = '<i class="fa fa-institution"></i>';
                                                    }
                                                }else{
                                                    $noteOwner = '<span class="">No Comapny Found</span>';
                                                    $noteViewLink = '<span class="">No Note Link Found</span>';
                                                    $noteIcon = '<i class="fa fa-cross"></i>';
                                                }
                                            }
                                            echo '<li class="'.((($count_note % 2) == 0) ? "right" : "left").' clearfix">
                                                <div class="timeline-badge '.((($count_note % 2) == 0) ? "pull-right info" : "pull-left danger").'">'.$noteIcon.'
                                                </div>
                                                <div class="chat-body clearfix">
                                                    <div class="header">
                                                        <strong class="'.((($count_note % 2) == 0) ? "pull-right" : "").' primary-font">'.$noteOwner.'</strong>
                                                        <small class="'.((($count_note % 2) == 0) ? "" : "pull-right").' text-muted">
                                                            <i class="fa fa-clock-o fa-fw"></i> '.date('d-m-Y', strtotime($rowNote['note_creation_date'])).'
                                                        </small>
                                                    </div>
                                                    <p>'.substr($rowNote['note'], 0, 100)."...".'</p>
                                                </div>
                                                '.$noteViewLink.'
                                            </li>';
                                        }
                                        $count_note++;
                                    }
                                }else{
                                    echo '<div class="error-message">No Note Found</div>';
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel .chat-panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> <a name="allNotifications">Notifications Panel</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="individuals-pending-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-users fa-fw"></i> Individual Pending
                                        <span class="pull-right text-muted small"><?php echo $no_of_individuals_pending; ?></span>
                                    </div>
                                </a>
                                <a href="individuals-utr-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-users fa-fw"></i> Individual With No UTR
                                        <span class="pull-right text-muted small"><?php echo $no_of_individuals_utr; ?></span>
                                    </div>
                                </a>
                                <a href="companies-pending-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-cubes fa-fw"></i> Companies Pending
                                        <span class="pull-right text-muted small"><?php echo $no_of_companies_pending; ?></span>
                                    </div>
                                </a>
                                <a href="companies-annual-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-cubes fa-fw"></i> Companies Annual
                                        <span class="pull-right text-muted small"><?php echo $no_of_companies_annual; ?></span>
                                    </div>
                                </a>
                                <a href="individuals-vats-pending-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-line-chart fa-fw"></i> Individuals VAT Pending
                                        <span class="pull-right text-muted small"><?php echo $no_of_individuals_vats_pending;?></span>
                                    </div>
                                </a>
                                <a href="companies-vats-pending-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-line-chart fa-fw"></i> Companies VAT Pending
                                        <span class="pull-right text-muted small"><?php echo $no_of_companies_vats_pending;?></span>
                                    </div>
                                </a>
                                <a href="tasks-pending-report.php" class="list-group-item">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> Tasks Pending
                                        <span class="pull-right text-muted small"><?php echo $no_of_tasks_pending;?></span>
                                    </div>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="index.php#allAlerts" class="btn btn-default btn-block">View All</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> Individuals With <span class="text-danger">No UTR</span>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>UTR</th>
                                        <th class="remove-shorting-icons text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($resultIndividualsUtr->num_rows > 0){
                                        $countUtr = 1;
                                        while($row = $resultIndividualsUtr->fetch_array()){
                                            if($countUtr <= $no_of_elements){
                                            ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo $row["firstname"].' '.$row["surname"]; ?></td>
                                                    <td class="center">
                                                        <?php
                                                            if($row['utr'] == '0'){
                                                                echo '';
                                                            }else{
                                                                echo $row['utr']; 
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn-xs btn-primary" href="individual.php?id=<?php echo $row["id"]; ?>#uk"><i class="fa fa-eye"></i> View</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            $countUtr++;
                                        }                                            
                                    }else{
                                        echo '<tr class="odd gradeA">
                                                <td colspan="3"><div class="error-message">No Individual found</div></td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <a href="individuals-utr-report.php" class="btn btn-default btn-block">View All</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
