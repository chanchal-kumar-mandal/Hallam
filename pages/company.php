<?php 
require_once('header.php');
require_once('sidebar.php');

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
                    <h1 class="page-header text-center">Company: <span class="text-danger"><?php echo $rowCompany['company_name']; ?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading text-center">
                                Company Informations
                            </div>
                            <div class="panel-body">                                   
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#general" data-toggle="tab"><i class="fa fa-cog"></i> General</a></li>
                                    <li><a href="#notes" data-toggle="tab"><i class="fa fa-file-text"></i> Notes</a></li>
                                </ul>
                                <div class="tab-content individual-tab-content">
                                    <!-- General Section -->
                                    <div class="tab-pane fade in active" id="general">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <p>
                                                    <b>Company Name : </b>
                                                    <?php echo $rowCompany['company_name']; ?>
                                                </p>             
                                                <p>
                                                    <b>Client ID : </b>
                                                    <?php echo $rowCompany['client_id']; ?>
                                                </p>             
                                                <p>
                                                    <b>Company Registration Number : </b>
                                                    <?php echo $rowCompany['registration_number']; ?>
                                                </p>             
                                                <p>
                                                    <b>Company Registration Date : </b>
                                                    <?php echo date('d-m-Y', strtotime($rowCompany['registration_date'])); ?>
                                                </p>              
                                                <p>
                                                    <b>Authentication Code : </b>
                                                    <?php echo $rowCompany['authentication_code']; ?>
                                                </p>             
                                                <p>
                                                    <b>Company Trade Description : </b>
                                                    <?php echo $rowCompany['trade_description']; ?>
                                                </p>            
                                                <p>
                                                    <b>Registered Address : </b>
                                                    <?php echo $rowCompany['registered_address']; ?>
                                                </p>              
                                                <p>
                                                    <b>UTR : </b>
                                                    <?php echo $rowCompany['utr']; ?>
                                                </p>             
                                                <div class="panel panel-info">
                                                    <div class="panel-heading">
                                                        Company Directors
                                                    </div>
                                                    <div class="panel-body">
                                                    <?php
                                                        $directors_ids_string = implode( ',', $directorIdsArray);
                                                        if($directors_ids_string != ""){
                                                            $result = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id in (". $directors_ids_string .")");
                                                            if($result->num_rows > 0){
                                                                while($row = $result->fetch_array()){
                                                                    echo '<div class="panel panel-default">
                                                                <div class="panel-body"><a href="individual.php?id='.$row['id'].'" target="_blank">'.$row["firstname"].' '. $row["surname"].'</a></div></div>';
                                                                } 
                                                            }else{
                                                                echo '<div class="error-message">No Director Found.</div>';
                                                            }
                                                        }else{
                                                            echo '<div class="error-message">No Director Found.</div>';
                                                        }
                                                        ?>                 
                                                    </div>
                                                </div> 
                                                <h3>Share capital</h3>            
                                                <p>
                                                    <b>No of Shares : </b>
                                                    <?php echo $rowCompany['no_of_shares']; ?>
                                                </p>             
                                                <p>
                                                    <b>Aggregate nominal value : </b>
                                                    <?php echo $rowCompany['aggregate_nominal_value']; ?>
                                                </p>             
                                                <p>
                                                    <b>Share Class : </b>
                                                    <?php echo $rowCompany['share_class']; ?>
                                                </p>             
                                                <p>
                                                    <b>Shares Issued : </b>
                                                    <?php echo $rowCompany['shares_issued']; ?>
                                                </p>             
                                                <p>
                                                    <b>Amount Paid : </b>
                                                    <i class="fa fa-gbp"></i> <?php echo $rowCompany['amount_paid']; ?>
                                                </p>            
                                                <p>
                                                    <b>Amount Unpaid : </b>
                                                    <i class="fa fa-gbp"></i> <?php echo $rowCompany['amount_unpaid']; ?>
                                                </p>            
                                                <p>
                                                    <b>Total aggregate value : </b>
                                                    <i class="fa fa-gbp"></i> <?php echo $rowCompany['total_aggregate_value']; ?>
                                                </p>                
                                                <p>
                                                    <h3>Shareholders</h3>
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            Shareholders Informations
                                                        </div>
                                                        <!-- /.panel-heading -->
                                                        <div class="panel-body">
                                                            <!-- Nav tabs -->
                                                            <ul class="nav nav-pills">
                                                                <?php 
                                                                $resultShareHolders = mysqli_query($db->db_conn, "SELECT * FROM shareholders where company_id = ". $company_id);
                                                                $i=1;
                                                                if($resultShareHolders->num_rows > 0){
                                                                    while($rowShareHolder = $resultShareHolders->fetch_array()){
                                                                        echo '<li class="'.(($i == 1) ? "active" : "").'"><a href="#shareholder'.$rowShareHolder['id'].'" data-toggle="tab">'.$rowShareHolder['shareholder_name'].'</a>
                                                                        </li>';
                                                                        $i++;
                                                                    }
                                                                }else{
                                                                    echo '<div class="error-message">No Shareholder Found.</div>';
                                                                }
                                                                ?>
                                                            </ul>

                                                            <!-- Tab panes -->
                                                            <div class="tab-content">
                                                                <?php 
                                                                $resultShareHolders1 = mysqli_query($db->db_conn, "SELECT * FROM shareholders where company_id = ". $company_id);
                                                                $j=1;
                                                                while($rowShareHolder1 = $resultShareHolders1->fetch_array()){
                                                                echo '<div class="tab-pane fade in '.(($j == 1) ? "active" : "").'" id="shareholder'.$rowShareHolder1['id'].'">
                                                                    <p></p>
                                                                    <p>
                                                                        <b>Shareholder Name : </b>
                                                                        '.$rowShareHolder1['shareholder_name'].'
                                                                    </p>
                                                                    <p>
                                                                        <b>Shares held : </b>
                                                                        '.$rowShareHolder1['shares_held'].'
                                                                    </p>
                                                                    <p>
                                                                        <b>Shares Disposed Date : </b>
                                                                        '.date('d-m-Y', strtotime($rowShareHolder1['shares_disposed_date'])).'
                                                                    </p>
                                                                </div>';
                                                                $j++;
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <!-- /.panel-body -->
                                                    </div>
                                                    <!-- /.panel -->
                                                </p>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-6">              
                                                <p>
                                                    <b>Payroll Required : </b>
                                                    <?php echo $rowCompany['payroll_required']; ?>
                                                </p>
                                                <?php if($rowCompany['payroll_required'] == "Yes"){?> 
                                                    <p>
                                                        <b>PAYE Reference : </b>
                                                        <?php echo $rowCompany['paye_reference']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>PAYE Office Code : </b>
                                                        <?php echo $rowCompany['paye_office_code']; ?>
                                                    </p>
                                                <?php } ?>                           
                                                <p>
                                                    <?php
                                                        if($rowCompany['vat_registered'] == "Yes"){
                                                            echo '<p><b>VAT Registered : </b> Yes</p>';
                                                            $resultVatPage = mysqli_query($db->db_conn, "SELECT * FROM vats where company_id = ". $company_id);
                                                            if($resultVatPage->num_rows > 0){
                                                                while($rowVat = $resultVatPage->fetch_assoc()){
                                                                    echo '<b>VAT Page : </b>
                                                                    <a href="company-vat.php?id='.$rowVat["id"].'" target="_blank">View Vat</a>';
                                                                }
                                                            }else{
                                                                echo '<b>VAT Page : </b> Not Found';
                                                            }
                                                        }else{
                                                            echo '<b>VAT Registered : </b> No';
                                                        }
                                                    ?>
                                                </p>              
                                                <p>
                                                    <b>Main Contact : </b>
                                                    <?php 

                                                    $result1 = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = ".$rowCompany['main_contact']); 
                                                        if($result1->num_rows > 0){
                                                            while($row1 = $result1->fetch_assoc()){
                                                                echo '<a href="individual.php?id='.$row1['id'].'" target="_blank">'.$row1["firstname"].' '. $row1["surname"].'</a>';
                                                            }                                            
                                                        }else{
                                                            echo '<span class="error-message">No Director Found.</span>';
                                                        }
                                                    ?>
                                                </p>              
                                                <p>
                                                    <b>Reference : </b>
                                                    <?php echo $rowCompany['reference']; ?>
                                                </p>             
                                                <p>
                                                    <b>Company Year End : </b>
                                                    <?php echo date('m-Y', strtotime($rowCompany['year_end'])); ?>
                                                </p>
                                                <p>
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
                                                </p>
                                                <p>
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
                                                        echo '<b>Account Submitted To HMRC : </b></br>';
                                                        foreach($acoount_submition_years_array as $acoount_submition_to_hmrc_year){
                                                           echo '<p><i>'.$acoount_submition_to_hmrc_year.'</i> : <b>'.((in_array($acoount_submition_to_hmrc_year, $account_submitted_to_hmrc_years_in_db_array)) ? "Yes" : "No").'</b></p>';; 
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                                <p>
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
                                                        echo '<b>Account Submitted To Companies House : </b></br>';
                                                        foreach($acoount_submition_years_array as $account_submitted_to_companies_house_year){
                                                           echo '<p><i>'.$account_submitted_to_companies_house_year.'</i> : <b>'.((in_array($account_submitted_to_companies_house_year, $account_submitted_to_companies_house_years_in_db_array)) ? "Yes" : "No").'</b></p>'; 
                                                        }
                                                    }
                                                    ?>
                                                </p>             
                                                <p>
                                                    <b>Annual Return Date : </b>
                                                    <?php echo date('d-m-Y', strtotime($rowCompany['annual_return_date'])); ?>
                                                </p>              
                                                <p>
                                                    <b>Accountancy Fee : </b>
                                                    <i class="fa fa-gbp"></i> <?php echo $rowCompany['accountancy_fee']; ?>
                                                </p>              
                                                <p>
                                                    <b>Registered Office Charge : </b>
                                                    <?php echo $rowCompany['registered_office_charge']; ?>
                                                </p>              
                                                <p>
                                                    <b>Registered Office Charge Fee : </b>
                                                    <i class="fa fa-gbp"></i> <?php echo $rowCompany['registered_office_charge_fee']; ?>
                                                </p>              
                                                <p>
                                                    <b>Payroll Charge : </b>
                                                    <?php echo $rowCompany['payroll_charge']; ?>
                                                </p>              
                                                <p>
                                                    <b>Payroll Charge Fee : </b>
                                                    <i class="fa fa-gbp"></i> <?php echo $rowCompany['payroll_charge_fee']; ?>
                                                </p>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <!-- /.row -->
                                        <div class="row">
                                            <div class="panel-footer text-center individual-pannel-footer"> 
                                                <a href="edit-company.php?id=<?php echo $rowCompany['id']?>#general" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                            <!-- /.panel footer --> 
                                        </div>
                                        <!-- /.row -->                                       
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- Notes Section -->
                                    <div class="tab-pane fade" id="notes">
                                        <div class="row">                     
                                            <div class="col-lg-12">
                                                <h3 class="text-center">Note Section</h3>
                                                <div class="dataTable_wrapper table-responsive">
                                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                        <thead>
                                                            <tr>
                                                                <th>Note Creation Date</th>
                                                                <th>Note Title</th>
                                                                <th>Note</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                            $resultNote = mysqli_query($db->db_conn, "SELECT * FROM notes where company_id = ". $company_id);
                                                            $i=1;
                                                            if($resultNote->num_rows > 0){ 
                                                                while($rowNote = $resultNote->fetch_array()){
                                                                ?> 
                                                                    <tr class="odd gradeA">
                                                                        <td><?php echo date('d-m-Y', strtotime($rowNote['note_creation_date'])); ?></td>
                                                                        <td><?php echo $rowNote["note_title"]; ?></td>
                                                                        <td><?php echo $rowNote["note"]; ?></td>
                                                                    </tr>
                                                                <?php
                                                                $i++;
                                                                }
                                                            }else{
                                                                echo '<tr class="odd gradeA">
                                                                        <td colspan="3"><div class="error-message">No Note found</div></td>
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
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <!-- /.row -->
                                        <div class="row">
                                            <div class="panel-footer text-center individual-pannel-footer"> 
                                                <a href="edit-company.php?id=<?php echo $rowCompany['id']?>#notes" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                            </div>
                                            <!-- /.panel footer --> 
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->  
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
            echo '<div class="error-message">No Company Found</div>';
        }
        ?>  
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>
