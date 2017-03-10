<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE vat_registered = 'Yes' order by company_name");
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Add Company VAT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="addCompanyVatForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                Company VAT Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6 col-md-offset-3">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <select  class="form-control" name="company_id" required autofocus>
                                                <option value="">Select Company</option>
                                            <?php
                                            if($result->num_rows > 0){
                                                while($row = $result->fetch_array()){
                                                    echo '<option value="'.$row["id"].'">'. $row["company_name"].'</option>';
                                                }                                            
                                            }else{
                                                echo '<option value="">No Company Available</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>                    
                                        <div class="form-group">
                                            <label>VAT Number</label>
                                            <input type="text" class="form-control" name="vat_number" placeholder="Enter VAT Number" required >
                                        </div> 
                                        <label>VAT Registered Date</label>              
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" id="vatRegisteredDate" class="form-control" name="vat_registered_date" placeholder="Enter VAT Registered Date" required>
                                        </div>                 
                                        <div class="form-group">
                                            <label>VAT Flat Rate</label>
                                            <select class="form-control" name="vat_flat_rate" required>
                                                <option>Yes</option>
                                                <option>No</option>
                                            </select>
                                        </div>  
                                        <label>Flat Rate First Year</label>            
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" name="flat_rate_first_year" placeholder="Enter Flat Rate First Year">
                                            <span class="input-group-addon">%</i>
                                        </div> 
                                        <label>Flat Rate After First Year</label>              
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" name="flat_rate_after_first_year" placeholder="Enter Flat Rate After First Year">
                                            <span class="input-group-addon">%</i>
                                        </div>                
                                        <div class="form-group">
                                            <label>Flat Rate Description</label>
                                            <textarea class="form-control" name="flat_rate_description" rows="3" placeholder="Enter Flat Rate Description"></textarea>
                                        </div>                    
                                        <div class="form-group">
                                            <label>VAT Return Quarter</label>
                                            <select class="form-control" name="vat_return_quarter" required>
                                                <option>Jan/April/July/Oct</option>
                                                <option>Feb/May/Aug/Nov</option>
                                                <option>March/June/Sep/Dec</option>
                                            </select>
                                        </div>                            
                                        <div class="form-group"> 
                                            <label>Notes</label> 
                                            <textarea class="form-control" name="notes" rows="3" placeholder="Enter Notes"></textarea>
                                        </div>  
                                        <div class="col-lg-12 text-center">            
                                            <button type="submit" id="addCompanyVatSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
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
