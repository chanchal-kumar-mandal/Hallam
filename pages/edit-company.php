<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM individuals");
$result1 = mysqli_query($db->db_conn, "SELECT * FROM individuals");

$company_id = $_REQUEST['id'];
$resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies where id = ". $company_id);
$resultCompanyDirectors = mysqli_query($db->db_conn, "SELECT * FROM companies_directors where company_id = ". $company_id);
if($resultCompanyDirectors->num_rows > 0){
    $directorIdsArray = array();
    while($rowCompanyDirectors = $resultCompanyDirectors->fetch_assoc()){
        $directorIdsArray[] = $rowCompanyDirectors['individual_id'];
    }
}else{
    $directorIdsArray = array();
}
?>            

    <div id="page-wrapper"> 
    <?php
    if($resultCompany->num_rows > 0){ 
        while($rowCompany = $resultCompany->fetch_assoc()){
        ?>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Edit Company : <span class="text-danger"><?php echo $rowCompany['company_name']; ?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="editCompanyForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                Company Form Elements
                            </div>
                            <div class="panel-body">                                   
                                <ul class="nav nav-tabs">
                                    <li class="active text-warning"><a href="#general" data-toggle="tab" class="text-warning"><i class="fa fa-cog"></i> General</a></li>
                                    <li><a href="#notes" data-toggle="tab" class="text-warning"><i class="fa fa-file-text"></i> Notes</a></li>
                                </ul>
                                <div class="tab-content individual-tab-content">
                                    <!-- General Section -->
                                    <div class="tab-pane fade in active" id="general">
                                        <div class="row">
                                            <input type="hidden" name="company_id" value="<?php echo $rowCompany['id']; ?>">
                                            <div class="col-lg-6">                    
                                                <div class="form-group">
                                                    <label>Company Name</label>
                                                    <input type="text" class="form-control" name="company_name" value="<?php echo $rowCompany['company_name']; ?>" required>
                                                </div>                      
                                                <div class="form-group">
                                                    <label>Client ID</label>
                                                    <input type="text" class="form-control" name="client_id" value="<?php echo $rowCompany['client_id']; ?>" required>
                                                </div>                              
                                                <div class="form-group">
                                                    <label>Company Registration Number</label>
                                                    <input type="number" class="form-control" name="registration_number" value="<?php echo $rowCompany['registration_number']; ?>" required>
                                                </div>
                                                <label>Company Registration Date</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="registrationDate" class="form-control" name="registration_date" value="<?php echo date('d-m-Y', strtotime($rowCompany['registration_date'])); ?>" required>
                                                </div>  
                                                <label>Authentication Code</label>                
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-road"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="authentication_code" value="<?php echo $rowCompany['authentication_code']; ?>" required>
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Company Trade Description</label>
                                                    <textarea class="form-control" name="trade_description" rows="3" required><?php echo $rowCompany['trade_description']; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Registered Address</label>
                                                    <textarea class="form-control" name="registered_address" rows="3" required><?php echo $rowCompany['registered_address']; ?></textarea>
                                                </div>                               
                                                <div class="form-group">
                                                    <label>UTR</label>
                                                    <input type="number" class="form-control" name="utr" value="<?php echo $rowCompany['utr']; ?>" required>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Directors</label>
                                                    <div class="btn-group">
                                                        <select id="directors" name="directors" multiple="multiple" style="display: none;">
                                                        <?php
                                                        if($result->num_rows > 0){
                                                            while($row = $result->fetch_array()){
                                                                echo '<option value="'.$row["id"].'" '.((in_array($row["id"], $directorIdsArray)) ? 'selected="selected"' : "").'>'.$row["firstname"].' '. $row["surname"].'</option>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Director Available</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                        <button id="directors-toggle" class="btn btn-danger">Select All</button>
                                                    </div>
                                                    <input type="hidden" id="directorIds" name="directorIds" value="<?php echo $rowCompany["directors"]; ?>">
                                                </div>
                                                <h3>Share capital</h3>
                                                <div class="form-group has-error">
                                                    <label class="control-label" for="inputError">No of Shares</label>
                                                    <input type="number" class="form-control" id="inputError" name="no_of_shares" value="<?php echo $rowCompany['no_of_shares']; ?>">
                                                </div>                                        
                                                <div class="form-group has-success">
                                                    <label class="control-label" for="inputSuccess">Aggregate Nominal Value</label>
                                                    <input type="number" class="form-control" id="inputSuccess" name="aggregate_nominal_value" value="<?php echo $rowCompany['aggregate_nominal_value']; ?>">
                                                </div>
                                                <div class="form-group has-warning">
                                                    <label class="control-label" for="inputWarning">Share Class</label>
                                                    <input type="text" class="form-control" id="inputWarning" name="share_class" value="<?php echo $rowCompany['share_class']; ?>">
                                                </div>
                                                <div class="form-group has-error">
                                                    <label class="control-label" for="inputError">Shares Issued</label>
                                                    <input type="number" class="form-control" id="inputError" name="shares_issued" value="<?php echo $rowCompany['shares_issued']; ?>">
                                                </div> 
                                                <label class="control-label" for="inputSuccess">Amount Paid</label>                  
                                                <div class="form-group input-group has-success">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="inputSuccess" name="amount_paid" value="<?php echo $rowCompany['amount_paid']; ?>">
                                                </div>                                        
                                                <label class="control-label" for="inputWarning">Amount Unpaid</label>
                                                <div class="form-group input-group has-warning">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="inputWarning" name="amount_unpaid" value="<?php echo $rowCompany['amount_unpaid']; ?>">
                                                </div>
                                                <label class="control-label" for="inputError">Total aggregate value</label>
                                                <div class="form-group input-group has-error">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" id="inputError" name="total_aggregate_value" value="<?php echo $rowCompany['total_aggregate_value']; ?>">
                                                </div> 
                                                <h3>Shareholders</h3>
                                                <div id="shareholders">
                                                    <?php 
                                                    $resultShareHolders = mysqli_query($db->db_conn, "SELECT * FROM shareholders where company_id = ". $company_id);
                                                    $i=1;
                                                    while($rowShareHolder = $resultShareHolders->fetch_array()){
                                                    ?>
                                                        <input type="hidden" name="shareholder_id<?php echo $i; ?>" value="<?php echo $rowShareHolder['id']; ?>">
                                                        <div class="well" id="shareholderContainer<?php echo $i; ?>">
                                                            <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeShareholder(<?php echo $i; ?>)">X</span></div>
                                                            <input type="hidden" id="is-exist-shareholder<?php echo $i; ?>" name="is-exist-shareholder<?php echo $i; ?>" value="1">
                                                            
                                                            <div class="form-group has-success">
                                                                <label class="control-label" for="inputSuccess">Name</label>
                                                                <input type="text" class="form-control" id="inputSuccess" name="shareholder_name<?php echo $i; ?>" value="<?php echo $rowShareHolder['shareholder_name']; ?>">
                                                            </div>
                                                            <div class="form-group has-warning">
                                                                <label class="control-label" for="inputWarning">Shares Held</label>
                                                                <input type="number" class="form-control" id="inputWarning" name="shares_held<?php echo $i; ?>" value="<?php echo $rowShareHolder['shares_held']; ?>">
                                                            </div>                                        
                                                            <label class="control-label" for="inputError">Shares Disposed Date</label>
                                                            <div class="form-group input-group has-error">
                                                                <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                                </span>
                                                                <input type="text" class="form-control" id="sharesDisposedDate<?php echo $i; ?>" name="shares_disposed_date<?php echo $i; ?>" value="<?php echo date('d-m-Y', strtotime($rowShareHolder['shares_disposed_date'])); ?>">
                                                            </div>
                                                        </div>
                                                    <?php
                                                    echo '<script>window.onload = showDatePicker("sharesDisposedDate'.$i.'");</script>';
                                                    $i++;
                                                    }
                                                    ?>
                                                </div>
                                                <div class="text-center">
                                                    <div id="addShareholder" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Shareholder</div>
                                                </div>
                                                <input type="hidden" id="no_of_shareholder" name="no_of_shareholder" value="<?php echo $rowCompany['no_of_shareholder']; ?>">      
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-6">                 
                                                <div class="form-group">
                                                    <label>Payroll Required </label>
                                                    <select class="form-control" id="payrollRequired"  name="payroll_required" required>
                                                        <option <?php if($rowCompany['payroll_required']=='No') echo 'selected="selected"';?>>No</option>
                                                        <option <?php if($rowCompany['payroll_required']=='Yes') echo 'selected="selected"';?>>Yes</option>
                                                    </select>
                                                </div>
                                                <div id="payrollOtherContainer" <?php if($rowCompany['payroll_required']=='No') echo 'style="display:none"';?>>                       
                                                    <div class="form-group">
                                                        <label>PAYE Reference</label>
                                                        <input type="text" class="form-control" id="payeReference" name="paye_reference" value="<?php echo $rowCompany['paye_reference']; ?>" <?php if($rowCompany['payroll_required']=='Yes') echo 'required';?>>
                                                    </div>                   
                                                    <div class="form-group">
                                                        <label>PAYE Office Code</label>
                                                        <input type="text" class="form-control" id="payeOfficeCode" name="paye_office_code" value="<?php echo $rowCompany['paye_office_code']; ?>" <?php if($rowCompany['payroll_required']=='Yes') echo 'required';?>>
                                                    </div> 
                                                </div>            
                                                <div class="form-group">
                                                    <label>VAT Registered</label>
                                                    <select class="form-control" name="vat_registered" required>
                                                        <option <?php if($rowCompany['vat_registered']=='No'){ echo 'selected="selected"';} ?>>No</option>
                                                        <option <?php if($rowCompany['vat_registered']=='Yes'){ echo 'selected="selected"';} ?>>Yes</option>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Main Contact</label>                  
                                                    <select class="form-control" name="main_contact" required>
                                                        <option value="">Select Main Contact</option>
                                                        <?php
                                                        if($result1->num_rows > 0){
                                                            while($row1 = $result1->fetch_array()){
                                                                echo '<option value="'.$row1["id"].'" '.(($rowCompany['main_contact']==$row1["id"]) ? 'selected="selected"' : "").'>'.$row1["firstname"].' '. $row1["surname"].'</option>';
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
                                                        <option <?php if($rowCompany['reference']=='HJ'){ echo 'selected="selected"';} ?>>HJ</option>
                                                        <option <?php if($rowCompany['reference']=='MSI'){ echo 'selected="selected"';} ?>>MSI</option>
                                                    </select>
                                                </div> 
                                                <label>Year End</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="yearEnd" class="form-control" name="year_end" value="<?php echo date('m-Y', strtotime($rowCompany['year_end']))?>" required>
                                                </div>            
                                                <div class="form-group">
                                                    <?php
                                                        /* Accounts Submitted Years Array Generation */

                                                        $current_date = date('Y-m-d');
                                                        $year_end = $rowCompany['year_end'];
                                                        $eight_month_after_year_end = date('m', strtotime('+8 months', strtotime($rowCompany['year_end'])));
                                                        $month_after_eight_months_of_year_end = $months[$eight_month_after_year_end]; // $months array is in constants page
                                                        $date_after_eight_months_of_year_end = date('Y-m-d', strtotime('last day of '. $month_after_eight_months_of_year_end, strtotime($rowCompany['year_end'])));
                                                        $diff_years = abs(strtotime($current_date) - strtotime($year_end));
                                                        $no_of_diif_years = floor($diff_years / (365*60*60*24));
                                                        $acoount_submition_years_array = array();
                                                        for($j= 0; $j <= $no_of_diif_years; $j++){
                                                            $acoount_submition_years_array[] = date('d-m-Y', strtotime("last day of +".$j." year", strtotime($rowCompany['year_end'])));
                                                        }
                                                        if($current_date < $date_after_eight_months_of_year_end){
                                                            array_pop($acoount_submition_years_array); // Remove Last array Element
                                                        }else{
                                                            $acoount_submition_years_array = $acoount_submition_years_array;
                                                        } 
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    // Accounts Submitted Years Check In Database 
                                                    $result1 = mysqli_query($db->db_conn, "SELECT * FROM  companies_account_submission_years WHERE account_submitted_to_hmrc_years != '' AND company_id = ". $company_id);
                                                    if(mysqli_num_rows($result1) > 0){
                                                        foreach($result1 as $result1){
                                                            $account_submitted_to_hmrc_years_string = $result1['account_submitted_to_hmrc_years'];
                                                        }
                                                        $account_submitted_to_hmrc_years_in_db_array = explode(",", $account_submitted_to_hmrc_years_string);
                                                    }else{
                                                       $account_submitted_to_hmrc_years_in_db_array = array(); 
                                                    }

                                                    if(count($acoount_submition_years_array) > 0){
                                                        echo '<label>Account Submitted To HMRC</label>';
                                                        foreach($acoount_submition_years_array as $acoount_submition_year){
                                                           echo '<div class="checkbox"><label><input type="checkbox" name="account_submitted_to_hmrc_years[]" value="'.$acoount_submition_year.'" '.((in_array($acoount_submition_year, $account_submitted_to_hmrc_years_in_db_array))? 'checked="checked"' : "").'>'.$acoount_submition_year.'</label></div>'; 
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    // Accounts Submitted Years Check In Database 
                                                    $result2 = mysqli_query($db->db_conn, "SELECT * FROM  companies_account_submission_years WHERE account_submitted_to_companies_house_years != '' AND company_id = ". $company_id);
                                                    if(mysqli_num_rows($result2) > 0){
                                                        foreach($result2 as $result2){
                                                            $account_submitted_to_companies_house_years_string = $result2['account_submitted_to_companies_house_years'];
                                                        }
                                                        $account_submitted_to_companies_house_years_in_db_array = explode(",", $account_submitted_to_companies_house_years_string);
                                                    }else{
                                                       $account_submitted_to_companies_house_years_in_db_array = array(); 
                                                    }

                                                    if(count($acoount_submition_years_array) > 0){
                                                        echo '<label>Account Submitted To Companies House</label>';
                                                        foreach($acoount_submition_years_array as $acoount_submition_year){
                                                           echo '<div class="checkbox"><label><input type="checkbox" name="account_submitted_to_companies_house_years[]" value="'.$acoount_submition_year.'" '.((in_array($acoount_submition_year, $account_submitted_to_companies_house_years_in_db_array))? 'checked="checked"' : "").'>'.$acoount_submition_year.'</label></div>'; 
                                                        }
                                                    }
                                                    ?>
                                                </div> 
                                                <label>Annual Return Date</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="annualReturnDate" class="form-control" name="annual_return_date" value="<?php echo date('d-m-Y', strtotime($rowCompany['annual_return_date'])); ?>" required>
                                                </div>  
                                                <label>Accountancy Fee</label> 
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="accountancy_fee" value="<?php echo $rowCompany['accountancy_fee']; ?>" required>
                                                </div>  
                                                <div class="form-group">
                                                    <label>Registered Office Charge</label>
                                                    <select class="form-control" name="registered_office_charge">
                                                        <option <?php if($rowCompany['registered_office_charge']=='No'){ echo 'selected="selected"';} ?>>No</option>
                                                        <option <?php if($rowCompany['registered_office_charge']=='Yes'){ echo 'selected="selected"';} ?>>Yes</option>
                                                    </select>
                                                </div>      
                                                <label>Registered Office Charge Fee</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="registered_office_charge_fee" value = "<?php echo $rowCompany['registered_office_charge_fee']; ?>" required/>
                                                </div>  
                                                <div class="form-group">
                                                    <label>Payroll Charge</label>
                                                    <select class="form-control" name="payroll_charge">
                                                        <option <?php if($rowCompany['payroll_charge']=='No'){ echo 'selected="selected"';} ?>>No</option>
                                                        <option <?php if($rowCompany['payroll_charge']=='Yes'){ echo 'selected="selected"';} ?>>Yes</option>
                                                    </select>
                                                </div>     
                                                <label>Payroll Charge Fee</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="payroll_charge_fee" value = "<?php echo $rowCompany['payroll_charge_fee']; ?>" required/>
                                                </div>                          
                                                <!--<div class="form-group"> 
                                                    <label>Notes</label> 
                                                    <textarea class="form-control" name="notes" rows="10"><?php/* echo $rowCompany['notes'];*/ ?></textarea>
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
                                                        <?php 
                                                        $resultNote = mysqli_query($db->db_conn, "SELECT * FROM notes where company_id = ". $company_id);
                                                        $i=1;
                                                        while($rowNote = $resultNote->fetch_array()){
                                                        ?>
                                                            <input type="hidden" name="note_id<?php echo $i; ?>" value="<?php echo $rowNote['id']; ?>">
                                                            <div class="well" id="noteContainer<?php echo $i; ?>">
                                                                <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeNote(<?php echo $i; ?>)">X</span></div>
                                                                <input type="hidden" id="is-exist-note<?php echo $i; ?>" name="is-exist-note<?php echo $i; ?>" value="1">
                                                                <fieldset disabled="">
                                                                    <label>Note Creation Date</label>
                                                                    <div class="form-group input-group">
                                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                                        <input type="text" class="form-control" name="note_creation_date<?php echo $i; ?>" value="<?php echo date('d-m-Y', strtotime($rowNote['note_creation_date'])); ?>">
                                                                    </div>
                                                                </fieldset>
                                                                <div class="form-group">
                                                                    <label>Note Title</label>
                                                                    <input type="text" class="form-control" name="note_title<?php echo $i; ?>" value="<?php echo $rowNote['note_title']; ?>">
                                                                </div>     
                                                                <div class="form-group"> 
                                                                    <label class="control-label">Note</label> 
                                                                    <textarea class="form-control" name="note<?php echo $i; ?>" rows="15"><?php echo $rowNote['note']; ?>
                                                                    </textarea>
                                                                </div> 
                                                            </div>
                                                        <?php
                                                        $i++;
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="text-center">
                                                        <div id="addNote" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Note</div>
                                                    </div>
                                                    <input type="hidden" id="no_of_note" name="no_of_note" value="<?php echo $rowCompany['no_of_note']; ?>">          
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
                                        <button type="submit" id="editCompanySubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                    </div>
                                    <!-- /.col-lg-12 --> 
                                </div>
                                <!-- /.panel footer --> 
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->            
            </form><!-- /.form -->
        <?php
        }
    }else{
        echo '<div class="error-message">No Company Found</div>';
    }
    ?>

        <?php require_once('modals-page.php');?>
              
    </div>
    <!-- /#page-wrapper -->

<?php require_once('footer.php');?>
