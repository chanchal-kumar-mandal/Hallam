<?php 
require_once('header.php');
require_once('sidebar.php');
$resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals ORDER BY firstname, surname");
$resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies ORDER BY company_name");
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Add Task</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="addTaskForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                Task Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6 col-lg-offset-3">    
                                        <div class="form-group">
                                            <label>Select Individual Or Company</label>
                                            <select class="form-control" id="individualOrCompany" name="individual_company" required autofocus>
                                                <option value="">Select</option>
                                                <option value="Individual">Individual</option>
                                                <option value="Company">Company</option>
                                            </select>
                                        </div> 
                                        <div class="form-group" id="individualsDropdown" style="display:none;">
                                            <label>Individual</label>
                                            <select  class="form-control" id="individualId" name="individual_id" required>
                                                <option value="">Select Individual</option>
                                            <?php
                                            if($resultIndividual->num_rows > 0){
                                                while($rowIndividual = $resultIndividual->fetch_array()){
                                                    echo '<option value="'.$rowIndividual["id"].'">'.$rowIndividual["firstname"].' '. $rowIndividual["surname"].'</option>';
                                                }                                            
                                            }else{
                                                echo '<option value="">No Individual Available</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>                                        
                                        <div class="form-group" id="companiesDropdown" style="display:none;">
                                            <label>Company</label>
                                            <select  class="form-control" id="companyId" name="company_id" required>
                                                <option value="">Select Company</option>
                                            <?php
                                            if($resultCompany->num_rows > 0){
                                                while($rowCompany = $resultCompany->fetch_array()){
                                                    echo '<option value="'.$rowCompany["id"].'">'. $rowCompany["company_name"].'</option>';
                                                }                                            
                                            }else{
                                                echo '<option value="">No Company Available</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>            
                                        <div class="form-group">       
                                            <label>Task Title</label> 
                                            <input type="text" class="form-control" name="task_title" placeholder="Enter Task Title" required>
                                        </div>                            
                                        <div class="form-group"> 
                                            <label>Task</label> 
                                            <textarea class="form-control" name="task" rows="10" placeholder="Enter Task" required></textarea>
                                        </div>  
                                        <label>Task Action Date</label>              
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" id="taskActionDate" class="form-control" name="task_action_date" placeholder="Enter Task Action Date" required>
                                        </div>              
                                        <div class="form-group">
                                            <label>Allocated Staff</label>
                                            <input type="text" class="form-control" name="allocated_staff" placeholder="Enter Allocated Staff" required>
                                        </div>
                                         <input type="hidden" class="form-control" name="task_creation_date" value="<?php echo date('Y-m-d'); ?>"> 
                                        <div class="col-lg-12 text-center">            
                                            <button type="submit" id="addTaskSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                            <button type="reset" id="resetFormButton" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
                                        </div>
                                        <!-- /.col-lg-12 -->        
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
