<?php 
require_once('header.php');
require_once('sidebar.php');
$note_id = $_REQUEST['id'];
$resultNote = mysqli_query($db->db_conn, "SELECT * FROM notes WHERE id = " . $note_id);
$resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals ORDER BY firstname, surname");
$resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies ORDER BY company_name");
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Edit Note</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="editNoteForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                Note Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6 col-lg-offset-3">
                                        <?php 
                                        while($rowNote = $resultNote->fetch_assoc()){

                                            if($rowNote['individual_id'] != ""){ 
                                            ?>  
                                                <div class="form-group">
                                                    <label>Individual</label>
                                                    <select  class="form-control" id="individualId" name="individual_id" required>
                                                        <option value="">Select Individual</option>
                                                    <?php
                                                    if($resultIndividual->num_rows > 0){
                                                        while($rowIndividual = $resultIndividual->fetch_array()){
                                                            echo '<option value="'.$rowIndividual["id"].'" '.(( $rowIndividual["id"] == $rowNote['individual_id'])? 'selected="selected"' : "").'>'.$rowIndividual["firstname"].' '. $rowIndividual["surname"].'</option>';
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
                                                            echo '<option value="'.$rowCompany["id"].'" '.(($rowCompany["id"] == $rowNote['company_id'])? 'selected="selected"' : "").'>'. $rowCompany["company_name"].'</option>';
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
                                            <fieldset disabled="">
                                                <label>Note Creation Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" name="note_creation_date" value="<?php echo date('d-m-Y', strtotime($rowNote['note_creation_date'])); ?>">
                                                </div> 
                                                <label>Note Creation Time</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control" name="note_creation_date" value="<?php echo date('h:i:s a', strtotime($rowNote['note_creation_date'])); ?>">
                                                </div> 
                                            </fieldset>                           
                                            <div class="form-group"> 
                                                <label>Notes</label> 
                                                <textarea class="form-control" name="note" rows="15" required><?php echo $rowNote['note'];?></textarea>
                                            </div>
                                            <input type="hidden" name="note_id" value="<?php echo $note_id;?>">  
                                            <div class="col-lg-12 text-center">
                                                <button type="submit" id="editNoteSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
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
