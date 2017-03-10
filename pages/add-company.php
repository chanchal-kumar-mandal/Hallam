<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM individuals");
$result1 = mysqli_query($db->db_conn, "SELECT * FROM individuals");
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Add Company</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="addCompanyForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                Company Form Elements
                            </div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active text-warning"><a href="#general" data-toggle="tab" class="text-success"><i class="fa fa-cog"></i> General</a></li>
                                    <li><a href="#notes" data-toggle="tab" class="text-success"><i class="fa fa-file-text"></i> Notes</a></li>
                                </ul>
                                <div class="tab-content individual-tab-content">
                                    <!-- General Section -->
                                    <div class="tab-pane fade in active" id="general">
                                        <div class="row">
                                            <div class="col-lg-6">                    
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" required autofocus>
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Client ID</label>
                                                    <input type="text" class="form-control" name="client_id" placeholder="Enter Client ID" required>
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Company Registration Number</label>
                                                    <input type="number" class="form-control" name="registration_number" placeholder="Company Registration Number" required>
                                                </div>
                                                <label>Company Registration Date</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="registrationDate" class="form-control" name="registration_date" placeholder="Enter Company Registration Date" required>
                                                </div>  
                                                <label>Authentication Code</label>                
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-road"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="authentication_code" placeholder="Enter Authentication Code" required>
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Company Trade Description</label>
                                                    <textarea class="form-control" name="trade_description" rows="3" placeholder="Company Trade Description" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Registered Address</label>
                                                    <textarea class="form-control" name="registered_address" rows="3" placeholder="Enter Registered Address" required></textarea>
                                                </div>                               
                                                <div class="form-group">
                                                    <label>UTR</label>
                                                    <input type="number" class="form-control" name="utr" placeholder="Enter UTR" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Directors</label>
                                                    <div class="btn-group">
                                                        <select id="directors" name="directors" multiple="multiple" style="display: none;">
                                                        <?php
                                                        if($result->num_rows > 0){
                                                            while($row = $result->fetch_array()){
                                                                echo '<option value="'.$row["id"].'">'.$row["firstname"].' '. $row["surname"].'</option>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Director Available</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                        <button id="directors-toggle" class="btn btn-danger">Select All</button>
                                                    </div>
                                                    <input type="hidden" id="directorIds" name="directorIds">
                                                </div>
                                                <h3>Share capital</h3>
                                                <div class="form-group has-error">
                                                    <label class="control-label" for="inputError">No of Shares</label>
                                                    <input type="number" class="form-control" id="inputError" name="no_of_shares" placeholder="Enter No of Shares">
                                                </div>                                        
                                                <div class="form-group has-success">
                                                    <label class="control-label" for="inputSuccess">Aggregate Nominal Value</label>
                                                    <input type="number" class="form-control" id="inputSuccess" name="aggregate_nominal_value" placeholder="Enter Aggregate Nominal Value">
                                                </div>
                                                <div class="form-group has-warning">
                                                    <label class="control-label" for="inputWarning">Share Class</label>
                                                    <input type="text" class="form-control" id="inputWarning" name="share_class" placeholder="Enter Share Class">
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label" for="inputError">Shares Issued</label>
                                                    <input type="number" class="form-control" id="inputError" name="shares_issued" placeholder="Enter Shares Issued">
                                                </div> 
                                                <label class="control-label" for="inputSuccess">Amount Paid</label>                  
                                                <div class="form-group input-group has-success">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="inputSuccess" name="amount_paid" placeholder="Enter Amount Paid">
                                                </div>                                        
                                                <label class="control-label" for="inputWarning">Amount Unpaid</label>
                                                <div class="form-group input-group has-warning">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="inputWarning" name="amount_unpaid" placeholder="Enter Amount Unpaid">
                                                </div>
                                                <label class="control-label" for="inputError">Total aggregate value</label>
                                                <div class="form-group input-group has-error">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="inputError" name="total_aggregate_value" placeholder="Enter Total Aggregate Value">
                                                </div> 
                                                <h3>Shareholders</h3>
                                                <div id="shareholders">
                                                    <div class="well" id="shareholderContainer1">
                                                        <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeShareholder(1)">X</span></div>
                                                        <input type="hidden" id="is-exist-shareholder1" name="is-exist-shareholder1" value="1">                         
                                                        <div class="form-group has-success">
                                                            <label class="control-label" for="inputSuccess">Name</label>
                                                            <input type="text" class="form-control" id="inputSuccess" name="shareholder_name1" placeholder="Enter Shareholder Name">
                                                        </div>
                                                        <div class="form-group has-warning">
                                                            <label class="control-label" for="inputWarning">Shares Held</label>
                                                            <input type="number" class="form-control" id="inputWarning" name="shares_held1" placeholder="Enter Shares Held">
                                                        </div>                                        
                                                        <label class="control-label" for="inputError">Shares Disposed Date</label>
                                                        <div class="form-group input-group has-error">
                                                            <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                            </span>
                                                            <input type="text" class="form-control" id="sharesDisposedDate1" name="shares_disposed_date1" placeholder="Enter Shares Disposed Date" onfocus="showDatePicker('shares_disposed_date1')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div id="addShareholder" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Shareholder</div>
                                                </div>
                                                <input type="hidden" id="no_of_shareholder" name="no_of_shareholder" value="1">      
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-6">                  
                                                <div class="form-group">
                                                    <label>Payroll Required </label>
                                                    <select class="form-control" id="payrollRequired" name="payroll_required" required>
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>
                                                <div id="payrollOtherContainer" style="display:none">          
                                                    <div class="form-group">
                                                        <label>PAYE Reference</label>
                                                        <input type="text" class="form-control" id="payeReference" name="paye_reference" placeholder="Enter Paye Reference">
                                                    </div>                   
                                                    <div class="form-group">
                                                        <label>PAYE Office Code</label>
                                                        <input type="text" class="form-control" id="payeOfficeCode" name="paye_office_code" placeholder="Enter Payment Office Code">
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <label>VAT Registered</label>
                                                    <select class="form-control" name="vat_registered" required>
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Main Contact</label>                  
                                                    <select class="form-control" name="main_contact" required>
                                                        <option value="">Select Main Contact</option>
                                                        <?php
                                                        if($result1->num_rows > 0){
                                                            while($row1 = $result1->fetch_array()){
                                                                echo '<option value="'.$row1["id"].'">'.$row1["firstname"].' '. $row1["surname"].'</option>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Individual Available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Reference</label>
                                                    <select class="form-control" name="reference">
                                                        <option>HJ</option>
                                                        <option>MSI</option>
                                                    </select>
                                                </div>  
                                                <label>Year End</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="yearEnd" class="form-control" name="year_end" placeholder="Enter Year End" required>
                                                </div> 
                                                <label>Annual Return Date</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="annualReturnDate" class="form-control" name="annual_return_date" placeholder="Enter Annual Return Date" required>
                                                </div>  
                                                <label>Accountancy Fee</label> 
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="accountancy_fee" placeholder="Enter Accountancy Fee" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label>Registered Office Charge</label>
                                                    <select class="form-control" name="registered_office_charge">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>      
                                                <label>Registered Office Charge Fee</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="registered_office_charge_fee" placeholder = "Enter Registered Office Charge Fee" required/>
                                                </div>  
                                                <div class="form-group">
                                                    <label>Payroll Charge</label>
                                                    <select class="form-control" name="payroll_charge">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>     
                                                <label>Payroll Charge Fee</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="payroll_charge_fee" placeholder = "Enter Payroll Charge Fee" required/>
                                                </div>                           
                                                <!--<div class="form-group"> 
                                                    <label>Notes</label> 
                                                    <textarea class="form-control" name="notes" rows="10" placeholder="Enter Notes"></textarea>
                                                </div>-->
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <!-- /.row --> 
                                    </div>    
                                    <!-- /.tab-pane -->
                                    <!-- Notes Section -->
                                    <div class="tab-pane fade" id="notes">
                                        <div class="row">                                        
                                            <div class="col-lg-6 col-lg-offset-3">
                                                <h3 class="text-center">Note Section</h3>
                                                <div id="clientNotes">
                                                    <div class="well" id="noteContainer1">
                                                        <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeNote(1)">X</span></div>
                                                        <input type="hidden" id="is-exist-note1" name="is-exist-note1" value="1"> 
                                                        <div class="form-group">
                                                            <label>Note Title</label>
                                                            <input type="text" class="form-control" name="note_title1" placeholder="Enter Note Title">
                                                        </div>          
                                                        <div class="form-group"> 
                                                            <label class="control-label">Note</label> 
                                                            <textarea class="form-control" name="note1" rows="15" placeholder="Enter Note"></textarea>
                                                        </div>  
                                                        <input type="hidden" class="form-control" name="   note_creation_date1" value="<?php echo date('Y-m-d'); ?>">
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div id="addNote" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Note</div>
                                                </div>
                                                <input type="hidden" id="no_of_note" name="no_of_note" value="1">                
                                            </div>
                                            <!-- /.col-lg-6 --> 
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.tab-pane -->
                                </div> 
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.panel-body -->                                                       
                            <div class="panel-footer">
                                <div class="text-center"> 
                                    <button type="submit" id="addCompanySubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                    <button type="reset" id="resetFormButton" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
                                </div>
                                <!-- /.col-lg-12 --> 
                            </div>
                            <!-- /.panel footer -->
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
