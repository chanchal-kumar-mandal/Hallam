<?php 
require_once('header.php');
require_once('sidebar.php');

$task_id = $_REQUEST['id'];
$resultTask = mysqli_query($db->db_conn, "SELECT * FROM tasks WHERE id = " . $task_id);
$resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals ORDER BY firstname, surname");
$resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies ORDER BY company_name");
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Edit Task</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="editTaskForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                Task Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6 col-lg-offset-3">
                                        <?php 
                                        while($rowTask = $resultTask->fetch_assoc()){
                                            if($rowTask['individual_id'] != ""){ 
                                            ?>  
                                                <div class="form-group">
                                                    <label>Individual</label>
                                                    <select  class="form-control" id="individualId" name="individual_id" required>
                                                        <option value="">Select Individual</option>
                                                    <?php
                                                    if($resultIndividual->num_rows > 0){
                                                        while($rowIndividual = $resultIndividual->fetch_array()){
                                                            echo '<option value="'.$rowIndividual["id"].'" '.(( $rowIndividual["id"] == $rowTask['individual_id'])? 'selected="selected"' : "").'>'.$rowIndividual["firstname"].' '. $rowIndividual["surname"].'</option>';
                                                        }                                            
                                                    }else{
                                                        echo '<option value="">No Individual Available</option>';
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            <?php
                                            }else {
                                            ?>                                      
                                                <div class="form-group">
                                                    <label>Company</label>
                                                    <select  class="form-control" id="companyId" name="company_id" required>
                                                        <option value="">Select Company</option>
                                                    <?php
                                                    if($resultCompany->num_rows > 0){
                                                        while($rowCompany = $resultCompany->fetch_array()){
                                                            echo '<option value="'.$rowCompany["id"].'" '.(($rowCompany["id"] == $rowTask['company_id'])? 'selected="selected"' : "").'>'. $rowCompany["company_name"].'</option>';
                                                        }                                            
                                                    }else{
                                                        echo '<option value="">No Company Available</option>';
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                            <?php
                                            }
                                            ?>           
                                            <div class="form-group">       
                                                <label>Task Title</label> 
                                                <input type="text" class="form-control" name="task_title" value="<?php echo $rowTask['task_title']; ?>" required>
                                            </div>                             
                                            <div class="form-group"> 
                                                <label>Task</label> 
                                                <textarea class="form-control" name="task" rows="10"><?php echo $rowTask['task']; ?></textarea>
                                            </div> 
                                            <fieldset disabled="">
                                                <label>Task Creation Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" name="task_creation_date" value="<?php echo date('d-m-Y', strtotime($rowTask['task_creation_date'])); ?>">
                                                </div> 
                                            </fieldset>
                                            <label>Task Action Date</label>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" id="taskCompletionDate" class="form-control" name="task_action_date" value="<?php echo date('d-m-Y', strtotime($rowTask['task_action_date'])); ?>" required>
                                            </div>              
                                            <div class="form-group">
                                                <label>Allocated Staff</label>
                                                <input type="text" class="form-control" name="allocated_staff" value="<?php echo $rowTask['allocated_staff']; ?>" required>
                                            </div>     
                                            <div class="form-group">
                                                <label>Task Completed</label>
                                                <select class="form-control" name="is_task_completed" required>
                                                    <option <?php echo (($rowTask['is_task_completed'] == "No") ? 'selected="selected"' : "");?>>No</option>
                                                    <option <?php echo (($rowTask['is_task_completed'] == "Yes") ? 'selected="selected"' : "");?>>Yes</option>
                                                </select>
                                            </div>                                    
                                            <input type="hidden" name="task_id" value="<?php echo $task_id;?>"> 
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" id="editTaskSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                            </div>
                                            <!-- /.col-lg-12 -->
                                        <?php
                                        }
                                        ?>        
                                    </div>
                                    <!-- /.col-lg-6 -->
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
            </form><!-- /.form --> 

            <?php require_once('modals-page.php');?>
            
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
