<?php 
require_once('header.php');
require_once('sidebar.php');
$task_id = $_REQUEST['id'];
$resultTask = mysqli_query($db->db_conn, "SELECT * FROM tasks where id = ". $task_id);
?>            

        <div id="page-wrapper">
        <?php         
        if($resultTask->num_rows > 0){  
            while($rowTask = $resultTask->fetch_assoc()){
            ?>           
               <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Task</h1>
                </div>
                <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    Task Informations
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p>
                                                <?php
                                                if($rowTask['individual_id'] != ""){
                                                    echo '<b>Individual : </b>';
                                                    $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = " . $rowTask['individual_id']);
                                                    if($resultIndividual->num_rows > 0){
                                                        while($rowIndividual =$resultIndividual->fetch_assoc()){
                                                            echo  '<a href="individual.php?id='.$rowIndividual["id"].'" target="_blank">'.$rowIndividual["firstname"].' '.$rowIndividual["surname"].'</a>';
                                                        }
                                                    }else{
                                                        echo '<span class="">No Individual Found</span>';
                                                    }
                                                }else{
                                                    echo '<b>Company : </b>';
                                                    $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = " . $rowTask['company_id']);
                                                    if($resultCompany->num_rows > 0){
                                                        while($rowCompany =$resultCompany->fetch_assoc()){
                                                            echo  '<a href="company.php?id='.$rowCompany["id"].'" target="_blank">'.$rowCompany["company_name"].'</a>';
                                                        }
                                                    }else{
                                                        echo '<span class="">No Comapny Found</span>';
                                                    }
                                                }
                                                ?> 
                                            </p>          
                                            <p>
                                                <b>Task Title : </b>
                                                <?php echo $rowTask['task_title']; ?>
                                            </p>           
                                            <p>
                                                <b>Task : </b>
                                                <?php echo $rowTask['task']; ?>
                                            </p>             
                                            <p>
                                                <b>Task Creation Date : </b>
                                                <?php echo date('d-m-Y', strtotime($rowTask['task_creation_date'])); ?>
                                            </p>             
                                            <p>
                                                <b>Task Action Date : </b>
                                                <?php echo date('d-m-Y', strtotime($rowTask['task_action_date'])); ?>
                                            </p>             
                                            <p>
                                                <b>Allocated Staff : </b>
                                                <?php echo $rowTask['allocated_staff']; ?>
                                            </p>             
                                            <p>
                                                <b>Task Completed : </b>
                                                <?php echo $rowTask['is_task_completed']; ?>
                                            </p>                     
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-12 text-center"> 
                                            <a href="edit-task.php?id=<?php echo $rowTask['id']?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                        </div>
                                        <!-- /.col-lg-12 -->
                                    </div>
                                    <!-- /.row --> 
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->  
                <?php
                }
            }else{
                echo '<div class="error-message">No Task Found</div>';
            }
            ?> 
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
