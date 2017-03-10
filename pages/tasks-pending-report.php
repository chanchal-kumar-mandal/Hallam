<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Pending Tasks In
                        <select class="btn-lg btn-group text-danger" id="taskCompletionMonthInPending" name="task_completion_month">
                            <?php
                            foreach($months as $key => $val){
                                echo '<option value="'.$key.'" '.(($task_completion_month == $key) ? 'selected="selected"' : "").'>'.$val.'</option>';
                            } 
                            ?>
                        </select>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tasks DataTable 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Individual/Company</th>
                                            <th>Client ID</th>
                                            <th>Task Title</th>
                                            <th>Creation Date</th>
                                            <!--<th>Completion Date</th>
                                            <th>Allocated Staff</th>-->
                                            <th>Completed</th>
                                            <th class="remove-shorting-icons text-center" style="width:93px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($resultTasksPendingPage->num_rows > 0){
                                            while($row = $resultTasksPendingPage->fetch_array()){
                                        ?>
                                            <tr class="odd gradeA">
                                                <td class="center">
                                                    <?php
                                                    if($row['individual_id'] != ""){
                                                        $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = " . $row['individual_id']);
                                                        if($resultIndividual->num_rows > 0){
                                                            while($rowIndividual =$resultIndividual->fetch_assoc()){
                                                                echo  '<a href="individual.php?id='.$rowIndividual["id"].'" target="_blank"><i class="fa fa-user"></i> '.$rowIndividual["firstname"].' '.$rowIndividual["surname"].'</a>';
                                                                $client_id = $rowIndividual["client_id"];
                                                            }
                                                        }else{
                                                            echo '<span class="">No Individual Found</span>';
                                                            $client_id = "";
                                                        }
                                                    }else{
                                                        $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = " . $row['company_id']);
                                                        if($resultCompany->num_rows > 0){
                                                            while($rowCompany =$resultCompany->fetch_assoc()){
                                                                echo  '<a href="company.php?id='.$rowCompany["id"].'" target="_blank"><i class="fa fa-institution"></i> '.$rowCompany["company_name"].'</a>';
                                                                $client_id = $rowCompany["client_id"];
                                                            }
                                                        }else{
                                                            echo '<span class="">No Comapny Found</span>';
                                                            $client_id = "";
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $client_id; ?></td>
                                                <td><?php echo $row["task_title"]; ?></td>
                                                <!--<td><?php/* echo substr($row["task"], 0, 40)."..."; */?></td>-->
                                                <td class="center">
                                                    <?php
                                                    echo  date('d-m-Y', strtotime($row['task_creation_date']));
                                                    ?>
                                                </td>
                                                <!--<td class="center">
                                                    <?php
                                                    /*echo  date('d-m-Y', strtotime($row["task_action_date"]));*/
                                                    ?>
                                                </td>
                                                <td class="center">
                                                    <?php
                                                    /*echo  $row["allocated_staff"];*/
                                                    ?>
                                                </td>-->
                                                <td class="text-center">
                                                    <?php
                                                    echo  $row["is_task_completed"];
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn-xs btn-primary" href="task.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i> View</a>
                                                </td>
                                            </tr>
                                        <?php
                                            }                                            
                                        }else{
                                            echo '<tr class="odd gradeA">
                                                    <td colspan="6"><div class="error-message">No data found</div></td>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;"></td>
                                                </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
