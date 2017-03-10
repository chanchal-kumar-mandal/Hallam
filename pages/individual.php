<?php 
require_once('header.php');
require_once('sidebar.php');
$individual_id = $_REQUEST['id'];
$resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals where id = ". $individual_id);

$resultCompaniesDirector = mysqli_query($db->db_conn, "SELECT * FROM companies_directors where individual_id = ". $individual_id);
if($resultCompaniesDirector->num_rows > 0){
    $companiesIdsArray = array();
    while($rowCompaniesDirector = $resultCompaniesDirector->fetch_assoc()){
        $companiesIdsArray[] = $rowCompaniesDirector['company_id'];
    }
}else{
    $companiesIdsArray = array();
}
?>            

        <div id="page-wrapper">
        <?php 
        if($resultIndividual->num_rows > 0){
            while($rowIndividual = $resultIndividual->fetch_assoc()){
            ?>           
               <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Individual : <span class="text-danger"><?php echo $rowIndividual["firstname"].' '. $rowIndividual["surname"]; ?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">  
                            <div class="panel with-nav-tabs panel-primary">
                                <div class="panel-heading text-center">Individual Informations
                                </div>
                                <div class="panel-body">                                    
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#general" data-toggle="tab"><i class="fa fa-cog"></i> General</a></li>
                                        <li><a href="#partner" data-toggle="tab"><i class="fa fa-male"></i><i class="fa fa-female"></i> Partner</a></li>
                                        <li><a href="#uk" data-toggle="tab"><img src="../images/view-uk.png" alt="UK" class="individual-tab-heading image"/> UK</a></li>
                                        <li><a href="#france" data-toggle="tab"><img src="../images/view-france.png" alt="France" class="individual-tab-heading image"/> France</a></li>
                                        <li><a href="#notes" data-toggle="tab"><i class="fa fa-file-text"></i> Notes</a></li>
                                    </ul>
                                    <div class="tab-content individual-tab-content">
                                        <!-- General Section -->
                                        <div class="tab-pane fade in active" id="general">
                                            <div class="row">                                        
                                                <div class="col-lg-6"> 
                                                    <p>
                                                        <b>First Name : </b>
                                                        <?php echo $rowIndividual['firstname']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>Surname : </b>
                                                        <?php echo $rowIndividual['surname']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>Maiden Name : </b>
                                                        <?php echo $rowIndividual['maiden_name']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>Client ID : </b>
                                                        <?php echo $rowIndividual['client_id']; ?>
                                                    </p> 
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            Address Section
                                                        </div>
                                                        <div class="panel-body">
                                                        <?php 
                                                        $resultAddress = mysqli_query($db->db_conn, "SELECT * FROM addresses where individual_id = ". $individual_id);
                                                        $i=1;
                                                        if($resultAddress->num_rows > 0){
                                                            while($rowAddress = $resultAddress->fetch_array()){
                                                            ?>
                                                                <div class="panel panel-default">
                                                                    <div class="panel-body">
                                                                         <b>Address : </b>
                                                                        <?php echo $rowAddress["address"]; ?>
                                                                    </div>
                                                                    <div class="panel-footer">
                                                                        <b>Address Description : </b>
                                                                        <?php echo $rowAddress['description']; ?>
                                                                    </div>
                                                                </div> 
                                                            <?php
                                                            $i++;
                                                            }
                                                        }else{
                                                            echo '<div class="error-message">No Address Found.</div>';
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>             
                                                    <!--<p>
                                                        <b>Postcode : </b>
                                                        <?php/* echo $rowIndividual['postcode']; */?>
                                                    </p>-->             
                                                    <p>
                                                        <b>Country of Residence : </b>
                                                        <?php
                                                        $resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries WHERE id = " . $rowIndividual["country_id"]);
                                                        if($resultCountry->num_rows > 0){
                                                            while($rowCountry = $resultCountry->fetch_array()){
                                                                echo '<a href="country.php?id='.$rowCountry["id"].'">'.$rowCountry["name"].'</a>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Country Found.</option>';
                                                        }
                                                        ?>
                                                    </p>
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            Email Section
                                                        </div>
                                                        <div class="panel-body"> 
                                                        <?php 
                                                        $resultEmail = mysqli_query($db->db_conn, "SELECT * FROM emails where individual_id = ". $individual_id);
                                                        $i=1;
                                                        if($resultEmail->num_rows > 0){
                                                            while($rowEmail = $resultEmail->fetch_array()){
                                                            ?> 
                                                                <div class="panel panel-default">
                                                                    <div class="panel-body">
                                                                        <b>Email : </b>
                                                                        <?php echo $rowEmail["email"]; ?>
                                                                    </div>
                                                                </div> 
                                                            <?php
                                                            $i++;
                                                            } 
                                                        }else{
                                                            echo '<div class="error-message">No Email Found.</div>';
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            Telephone Section
                                                        </div>
                                                        <div class="panel-body">
                                                        <?php 
                                                        $resultTelephone = mysqli_query($db->db_conn, "SELECT * FROM telephones where individual_id = ". $individual_id);
                                                        $i=1;
                                                        if($resultTelephone->num_rows > 0){
                                                            while($rowTelephone = $resultTelephone->fetch_array()){
                                                            ?>  
                                                                <div class="panel panel-default">
                                                                    <div class="panel-body">
                                                                        <b>Telephone : </b>
                                                                        <?php echo $rowTelephone["telephone"]; ?>
                                                                    </div>
                                                                    <div class="panel-footer">
                                                                        <b>Telephone Description: </b>
                                                                        <?php echo $rowTelephone["description"]; ?>
                                                                    </div>
                                                                </div> 
                                                            <?php
                                                            $i++;
                                                            }
                                                        }else{
                                                            echo '<div class="error-message">No Telephone Found.</div>';
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">
                                                            Company Directors 
                                                        </div>
                                                        <div class="panel-body">
                                                        <?php
                                                            $companies_ids_string = implode( ',', $companiesIdsArray);
                                                            if($companies_ids_string != ""){
                                                                $result = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id in (". $companies_ids_string .")");
                                                                if($result->num_rows > 0){
                                                                    while($row = $result->fetch_array()){
                                                                        echo '<div class="panel panel-default">
                                                                <div class="panel-body"><a href="company.php?id='.$row['id'].'" target="_blank">'.$row["company_name"].'</a></div></div>';
                                                                    }                                            
                                                                }else{
                                                                    echo '<div class="error-message">No Company Found.</div>';
                                                                }
                                                            }else{
                                                                echo '<div class="error-message">No Company.</div>';
                                                            }
                                                            ?>                  
                                                        </div>
                                                    </div>                 
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">  
                                                    <p>
                                                        <b>Date of Birth : </b>
                                                        <?php  
                                                        if($rowIndividual["dob"] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual["dob"]));
                                                        }
                                                        ?>
                                                    </p> 
                                                    <p>
                                                        <b>Place of Birth : </b>
                                                        <?php echo $rowIndividual['place_of_birth']; ?>
                                                    </p>  
                                                    <p>
                                                        <b>Date of Death : </b>
                                                        <?php
                                                        if($rowIndividual['date_of_death'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['date_of_death']));
                                                        }
                                                        ?>
                                                    </p> 
                                                    <p>
                                                        <b>Nationality : </b>
                                                        <?php echo $rowIndividual['nationality']; ?>
                                                    </p>   
                                                    <p>
                                                        <b>Passport Number : </b>
                                                        <?php echo $rowIndividual['passport_no']; ?>
                                                    </p>    
                                                    <p>
                                                        <b>Marital Status : </b>
                                                        <?php echo $rowIndividual['marital_status']; ?>
                                                    </p>   
                                                    <p>
                                                        <b>Date of Marriage : </b>
                                                        <?php 
                                                        if($rowIndividual['date_of_marriage'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['date_of_marriage']));
                                                        }
                                                        ?>
                                                    </p>   
                                                    <p>
                                                        <b>Place of Marriage : </b>
                                                        <?php echo $rowIndividual['place_of_marriage']; ?>
                                                    </p> 
                                                    <fieldset disabled="">        
                                                        <div class="form-group">
                                                            <label>Active </label>
                                                            <label><input type="checkbox" name="active"  <?php if ($rowIndividual['active']=='Yes') echo 'checked = "checked"';?>></label>
                                                        </div>  
                                                        <div class="form-group">
                                                            <label>On Stop </label>
                                                            <label><input type="checkbox" name="on_stop" <?php if ($rowIndividual['on_stop']=='Yes') echo 'checked = "checked"';?> ></label>
                                                        </div> 
                                                    </fieldset> 
                                                    <p>
                                                        <b>Engagement Start Date : </b>
                                                        <?php
                                                        if($rowIndividual['engagement_start_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['engagement_start_date']));
                                                        }
                                                        ?>
                                                    </p>     
                                                    <p>
                                                        <b>Engagement End Date : </b>
                                                        <?php
                                                        if($rowIndividual['engagement_end_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['engagement_end_date']));
                                                        }
                                                        ?>
                                                    </p>                 
                                                </div>
                                                <!-- /.col-lg-6 -->
                                            </div>
                                            <!-- /.row -->
                                            <div class="row">
                                                <div class="panel-footer text-center individual-pannel-footer"> 
                                                    <a href="edit-individual.php?id=<?php echo $rowIndividual['id']?>#general" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                                </div>
                                                <!-- /.panel footer --> 
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <!-- Partner Section -->
                                        <div class="tab-pane fade" id="partner">
                                            <div class="row">                                        
                                                <div class="col-lg-6"> 
                                                    <p>
                                                        <b>First Name : </b>
                                                        <?php echo $rowIndividual['p_firstname']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>Surname : </b>
                                                        <?php echo $rowIndividual['p_surname']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>Maiden Name : </b>
                                                        <?php echo $rowIndividual['p_maiden_name']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>Client ID : </b>
                                                        <?php echo $rowIndividual['client_id']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>Address : </b>
                                                        <?php echo $rowIndividual['p_address']; ?>
                                                    </p>                 
                                                    <p>
                                                        <b>Postcode : </b>
                                                        <?php echo $rowIndividual['p_postcode']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>Country of Residence : </b>
                                                        <?php
                                                        $resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries WHERE id = " . $rowIndividual["p_country_id"]);
                                                        if($resultCountry->num_rows > 0){
                                                            while($rowCountry = $resultCountry->fetch_array()){
                                                                echo '<a href="country.php?id='.$rowCountry["id"].'">'.$rowCountry["name"].'</a>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Country Found.</option>';
                                                        }
                                                        ?>
                                                    </p>            
                                                    <p>
                                                        <b>Email Id : </b>
                                                        <?php echo $rowIndividual['p_email']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>Telephone : </b>
                                                        <?php echo $rowIndividual['p_telephone']; ?>
                                                    </p>                     
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">  
                                                    <p>
                                                        <b>Date of Birth : </b>
                                                        <?php 
                                                        if($rowIndividual['p_dob'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['p_dob']));
                                                        }
                                                        ?>
                                                    </p> 
                                                    <p>
                                                        <b>Place of Birth : </b>
                                                        <?php echo $rowIndividual['p_place_of_birth']; ?>
                                                    </p>  
                                                    <p>
                                                        <b>Date of Death : </b>
                                                        <?php
                                                        if($rowIndividual['p_date_of_death'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['p_date_of_death']));
                                                        }
                                                        ?>
                                                    </p> 
                                                    <p>
                                                        <b>Nationality : </b>
                                                        <?php echo $rowIndividual['p_nationality']; ?>
                                                    </p>   
                                                    <p>
                                                        <b>Passport Number : </b>
                                                        <?php echo $rowIndividual['p_passport_no']; ?>
                                                    </p>     
                                                    <p>
                                                        <b>Marital Status : </b>
                                                        <?php echo $rowIndividual['marital_status']; ?>
                                                    </p>   
                                                    <p>
                                                        <b>Date of Marriage : </b>
                                                        <?php
                                                        if($rowIndividual['date_of_marriage'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['date_of_marriage']));
                                                        }
                                                        ?>
                                                    </p>   
                                                    <p>
                                                        <b>Place of Marriage : </b>
                                                        <?php echo $rowIndividual['place_of_marriage']; ?>
                                                    </p>    
                                                    <p>
                                                        <b>Active : </b>
                                                        <?php echo $rowIndividual['active']; ?>
                                                    </p>    
                                                    <p>
                                                        <b>On Stop : </b>
                                                        <?php echo $rowIndividual['on_stop']; ?>
                                                    </p>     
                                                    <p>
                                                        <b>Engagement Start Date : </b>
                                                        <?php
                                                        if($rowIndividual['engagement_start_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['engagement_start_date']));
                                                        }
                                                        ?>
                                                    </p>     
                                                    <p>
                                                        <b>Engagement End Date : </b>
                                                        <?php
                                                        if($rowIndividual['engagement_end_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['engagement_end_date']));
                                                        }
                                                        ?>
                                                    </p>              
                                                </div>
                                                <!-- /.col-lg-6 -->
                                            </div>
                                            <!-- /.row -->
                                            <div class="row">
                                                <div class="panel-footer text-center individual-pannel-footer"> 
                                                    <a href="edit-individual.php?id=<?php echo $rowIndividual['id']?>#partner" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                                </div>
                                                <!-- /.panel footer --> 
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <!-- UK Section -->
                                        <div class="tab-pane fade" id="uk">
                                            <div class="row">                                        
                                                <div class="col-lg-6">                       
                                                    <p>
                                                        <b>National Insurance : </b>
                                                        <?php echo $rowIndividual['national_insurance']; ?>
                                                    </p>           
                                                    <p>
                                                        <b>Address : </b>
                                                        <?php echo $rowIndividual['uk_address']; ?>
                                                    </p>           
                                                    <p>
                                                        <b>Address Description : </b>
                                                        <?php echo $rowIndividual['uk_address_description']; ?>
                                                    </p>                  
                                                    <p>
                                                        <b>Payroll Required : </b>
                                                        <?php echo $rowIndividual['payroll_required']; ?>
                                                    </p> 
                                                    <?php if($rowIndividual['payroll_required'] == "Yes"){?> 
                                                        <p>
                                                            <b>PAYE Reference : </b>
                                                            <?php echo $rowIndividual['paye_reference']; ?>
                                                        </p>              
                                                        <p>
                                                            <b>PAYE Office Code : </b>
                                                            <?php echo $rowIndividual['paye_office_code']; ?>
                                                        </p>
                                                    <?php } ?> 
                                                    <p>
                                                        <b>First Tax Year Due : </b>
                                                        <?php echo $rowIndividual['first_tax_year_due']; ?>
                                                    </p>
                                                    <p>
                                                        <b>Requires Tax Return : </b>
                                                        <?php echo $rowIndividual['requires_tax_return']; ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                            /* Tax Return Years Check In Database */
                                                            $result2 = mysqli_query($db->db_conn, "SELECT * FROM  individuals_tax_return_years WHERE individual_id = ". $individual_id);
                                                            if(mysqli_num_rows($result2) > 0){
                                                                foreach($result2 as $result2){
                                                                    $tax_return_years_string = $result2['tax_return_years'];
                                                                }
                                                                $tax_return_years_in_db_array = explode(",", $tax_return_years_string);
                                                            }else{
                                                               $tax_return_years_in_db_array = array(); 
                                                            }

                                                            /* Tax Return Years Generation */
                                                            $first_tax_year_due_index = array_search($rowIndividual['first_tax_year_due'], $returnable_tax_years);
                                                            if(!$first_tax_year_due_index && $rowIndividual['first_tax_year_due'] == $current_tax_year){
                                                                $individual_returnable_tax_years = array();
                                                            }else{
                                                               $individual_returnable_tax_years = array_splice($returnable_tax_years, $first_tax_year_due_index); 
                                                            }

                                                            if(count($individual_returnable_tax_years) > 0){
                                                                echo '<b>Tax Return Submitted To HMRC : </b></br>';
                                                                foreach($individual_returnable_tax_years as $returnable_tax_year){
                                                                   echo '<p><i>'.$returnable_tax_year.'</i> : <b>'.((in_array($returnable_tax_year, $tax_return_years_in_db_array)) ? "Yes" : "No").'</b></p>'; 
                                                                }
                                                            }
                                                        ?>
                                                    </p>             
                                                    <p>
                                                        <b>UTR : </b>
                                                        <?php 
                                                        if($rowIndividual['utr'] == '0'){
                                                            echo '';
                                                        }else{
                                                            echo $rowIndividual['utr']; 
                                                        }
                                                        ?>
                                                    </p>             
                                                    <p>
                                                        <?php
                                                        if($rowIndividual['vat_registered'] == "Yes"){
                                                            echo '<p><b>VAT Registered : </b> Yes</p>';
                                                            $resultVatPage = mysqli_query($db->db_conn, "SELECT * FROM vats where individual_id = ". $individual_id);
                                                            if($resultVatPage->num_rows > 0){
                                                                while($rowVat = $resultVatPage->fetch_assoc()){
                                                                    echo '<b>VAT Page : </b>
                                                                    <a href="individual-vat.php?id='.$rowVat["id"].'" target="_blank">View Vat</a>';
                                                                }
                                                            }else{
                                                                echo '<b>VAT Page : </b> Not Found';
                                                            }
                                                        }else{
                                                            echo '<b>VAT Registered : </b> No';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">               
                                                    <p>
                                                        <b>Business Commencement Date : </b>
                                                        <?php
                                                        if($rowIndividual['business_commencement_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['business_commencement_date']));
                                                        }
                                                        ?>
                                                    </p>             
                                                    <p>
                                                        <b>Any Other Paid Employment : </b>
                                                        <?php echo $rowIndividual['other_paid_employment']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>P45/P60 required for year 1 SA : </b>
                                                        <?php echo $rowIndividual['first_year_p45_p60']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>P45/P60 required for subsequent years SA : </b>
                                                        <?php echo $rowIndividual['subsequent_years_p45_p60']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>Fee : </b>
                                                        <i class="fa fa-gbp"></i> <?php echo $rowIndividual['fee']; ?>
                                                    </p>             
                                                    <p>
                                                        <b>Fee Type : </b>
                                                        <?php echo $rowIndividual['fee_type']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>Reference : </b>
                                                        <?php echo $rowIndividual['reference']; ?>
                                                    </p>                      
                                                    <p>
                                                        <b>64-8 to HMRC : </b>
                                                        <?php echo $rowIndividual['uk_sixtyfour_eight_to_hmrc']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>64-8 to HMRC Date : </b>
                                                        <?php
                                                        if($rowIndividual['uk_sixtyfour_eight_to_hmrc_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['uk_sixtyfour_eight_to_hmrc_date']));
                                                        }
                                                        ?>
                                                    </p>             
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                            <div class="row">
                                                <div class="panel-footer text-center individual-pannel-footer"> 
                                                    <a href="edit-individual.php?id=<?php echo $rowIndividual['id']?>#uk" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                                </div>
                                                <!-- /.panel footer --> 
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        <!-- France Section -->
                                        <div class="tab-pane fade" id="france">    
                                            <div class="row">                                        
                                                <div class="col-lg-6">             
                                                    <p>
                                                        <b>Social Security Number : </b>
                                                        <?php echo $rowIndividual['social_security_no']; ?>
                                                    </p>            
                                                    <p>
                                                        <b>Siret Number : </b>
                                                        <?php echo $rowIndividual['siret_number']; ?>
                                                    </p>            
                                                    <p>
                                                        <b>Business Regime : </b>
                                                        <?php echo $rowIndividual['business_regime']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>Business Commencement Date : </b>
                                                        <?php
                                                        if($rowIndividual['f_business_commencement_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['f_business_commencement_date']));
                                                        }
                                                        ?>
                                                    </p>               
                                                    <p>
                                                        <b>Business End Date : </b>
                                                        <?php
                                                        if($rowIndividual['f_business_end_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['f_business_end_date']));
                                                        }
                                                        ?>
                                                    </p> 
                                                    <p>
                                                        <b>First Tax Year Due : </b>
                                                        <?php echo $rowIndividual['f_first_tax_year_due']; ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        /* French Tax Return Years Check In Database */
                                                        $resultFrench = mysqli_query($db->db_conn, "SELECT * FROM  individuals_tax_return_years_french WHERE individual_id = ". $individual_id);
                                                        if(mysqli_num_rows($resultFrench) > 0){
                                                            foreach($resultFrench as $resultFrench){
                                                                $tax_return_years_string = $resultFrench['tax_return_years'];
                                                            }
                                                            $tax_return_years_french_in_db_array = explode(",", $tax_return_years_string);
                                                        }else{
                                                           $tax_return_years_french_in_db_array = array(); 
                                                        }

                                                        /* Tax Return Years Generation */
                                                        //$french_returnable_tax_years = $tax_years;

                                                        $first_tax_year_french_due_index = array_search($rowIndividual['f_first_tax_year_due'], $french_returnable_tax_years);
                                                        if(!$first_tax_year_french_due_index && $rowIndividual['f_first_tax_year_due'] == $current_tax_year){
                                                            $individual_french_returnable_tax_years = array();
                                                        }else{
                                                           $individual_french_returnable_tax_years = array_splice($french_returnable_tax_years, $first_tax_year_french_due_index); 
                                                        }
                                                        if(count($individual_french_returnable_tax_years) > 0){
                                                            $flagLabel = false;
                                                            foreach($individual_french_returnable_tax_years as $return_tax_year){
                                                                if(!in_array($return_tax_year, $tax_return_years_french_in_db_array)){
                                                                    $flagLabel = true;
                                                                    break;
                                                                }
                                                            }
                                                            if($flagLabel){
                                                                echo '<label>Tax Return Submitted To HMRC</label>';
                                                            }
                                                            foreach($individual_french_returnable_tax_years as $returnable_french_tax_year){
                                                                echo '<p><i>'.$returnable_french_tax_year.'</i> : <b>'.((in_array($returnable_french_tax_year, $tax_return_years_french_in_db_array)) ? "Yes" : "No").'</b></p>'; 
                                                            }
                                                        }
                                                        ?>
                                                    </p>             
                                                    <p>
                                                        <b>Fee : </b>
                                                        <i class="fa fa-eur"></i> <?php echo $rowIndividual['f_fee']; ?>
                                                    </p>           
                                                    <p>
                                                        <b>Previous Address : </b>
                                                        <?php echo $rowIndividual['f_prvious_address']; ?>
                                                    </p> 
                                                    <p>
                                                        <b>Fiscal Number : </b>
                                                        <br/>
                                                        <?php echo $rowIndividual['fiscal_no_first']; ?>
                                                        <br/>
                                                        <?php echo $rowIndividual['fiscal_no_second']; ?>
                                                    </p>   
                                                    <p>
                                                        <b>FIP Number : </b>
                                                        <?php echo $rowIndividual['fip_no']; ?>
                                                    </p>                   
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <p>
                                                        <b>FD5 : </b>
                                                        <?php echo $rowIndividual['fd5']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>FD5 Date : </b>
                                                        <?php
                                                        if($rowIndividual['fd5_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['fd5_date']));
                                                        }
                                                        ?>
                                                    </p>    
                                                    <p>
                                                        <b>P85 : </b>
                                                        <?php echo $rowIndividual['p85']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>P85 Date : </b>
                                                        <?php
                                                        if($rowIndividual['p85_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['p85_date']));
                                                        }
                                                        ?>
                                                    </p>   
                                                    <p>
                                                        <b>NRL1 : </b>
                                                        <?php echo $rowIndividual['nrl1']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>NRL1 Date : </b>
                                                        <?php
                                                        if($rowIndividual['nrl1_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['nrl1_date']));
                                                        }
                                                        ?>
                                                    </p>   
                                                    <p>
                                                        <b>S1 : </b>
                                                        <?php echo $rowIndividual['s1']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>S1 Date : </b>
                                                        <?php
                                                        if($rowIndividual['s1_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['s1_date']));
                                                        }
                                                        ?>
                                                    </p>   
                                                    <p>
                                                        <b>64-8 to HMRC : </b>
                                                        <?php echo $rowIndividual['sixtyfour_eight_to_hmrc']; ?>
                                                    </p>               
                                                    <p>
                                                        <b>64-8 to HMRC Date : </b>
                                                        <?php
                                                        if($rowIndividual['sixtyfour_eight_to_hmrc_date'] != "0000-00-00"){
                                                            echo date('d-m-Y', strtotime($rowIndividual['sixtyfour_eight_to_hmrc_date']));
                                                        }
                                                        ?>
                                                    </p>               
                                                    <p>
                                                        <b>Teledeclarant Number : </b>
                                                        <?php echo $rowIndividual['teledeclarant_number']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>Service Impots Particulier Password : </b>
                                                        <?php echo $rowIndividual['service_impots_particulier_password']; ?>
                                                    </p>              
                                                    <p>
                                                        <b>CDI Address : </b>
                                                        <?php echo $rowIndividual['cdi_address']; ?>
                                                    </p>    
                                                </div>
                                                <!-- /.col-lg-6 -->
                                            </div>
                                            <!-- /.row -->
                                            <div class="row">
                                                <div class="panel-footer text-center individual-pannel-footer"> 
                                                    <a href="edit-individual.php?id=<?php echo $rowIndividual['id']?>#france" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
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
                                                                $resultNote = mysqli_query($db->db_conn, "SELECT * FROM notes where individual_id = ". $individual_id);
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
                                            <div class="row">
                                                <div class="panel-footer text-center individual-pannel-footer"> 
                                                    <a href="edit-individual.php?id=<?php echo $rowIndividual['id']?>#notes" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                                </div>
                                                <!-- /.panel footer --> 
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- /.panel body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->  
                <?php
                }
            }else{
                echo '<div class="error-message">No Individual Found.</div>';
            }
            ?> 
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
