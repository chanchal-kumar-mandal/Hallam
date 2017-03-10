<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Add Individual</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="addIndividualForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                Individual Form Elements
                            </div>
                            <div class="panel-body">                                   
                                <ul class="nav nav-tabs">
                                    <li class="active text-warning"><a href="#general" data-toggle="tab" class="text-success"><i class="fa fa-cog"></i> General</a></li>
                                    <li><a href="#partner" data-toggle="tab" class="text-success"><i class="fa fa-male"></i><i class="fa fa-female"></i> Partner</a></li>
                                    <li><a href="#uk" data-toggle="tab" class="text-success"><img src="../images/add-uk.png" alt="UK" class="individual-tab-heading image"/> UK</a></li>
                                    <li><a href="#france" data-toggle="tab" class="text-success"><img src="../images/add-france.png" alt="France" class="individual-tab-heading image"/> France</a></li>
                                    <li><a href="#notes" data-toggle="tab" class="text-success"><i class="fa fa-file-text"></i> Notes</a></li>
                                </ul>
                                <div class="tab-content individual-tab-content">
                                    <!-- General Section -->
                                    <div class="tab-pane fade in active" id="general">
                                        <div class="row">
                                            <div class="col-lg-6">                    
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="firstname" placeholder="Enter First Name" required autofocus>
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Surname</label>
                                                    <input type="text" class="form-control" id="surname" name="surname" onchange="changePartnerSurname()" placeholder="Enter Surname" required>
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Maiden Name</label>
                                                    <input type="text" class="form-control" name="maiden_name" placeholder="Enter Maiden Name">
                                                </div>                   
                                                <div class="form-group">
                                                    <label>Client ID</label>
                                                    <input type="text" class="form-control" name="client_id" placeholder="Enter Client ID" required>
                                                </div>                                                 
                                                <h3>Address Section</h3>
                                                <div id="addresses">
                                                    <div class="well" id="addressContainer1">
                                                        <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeAddress(1)">X</span></div>
                                                        <input type="hidden" id="is-exist-address1" name="is-exist-address1" value="1">                         
                                                        <div class="form-group has-success">
                                                            <label class="control-label" for="inputSuccess">Address</label>
                                                            <textarea class="form-control" id="address1" name="address1" onchange="changePartnerAddress()" rows="3" placeholder="Enter Address"></textarea>
                                                        </div>
                                                        <div class="form-group has-warning">
                                                            <label class="control-label" for="inputWarning">Address Description</label>
                                                            <input type="text" class="form-control" id="inputWarning" name="address_description1" placeholder="Enter Address Description">
                                                        </div> 
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div id="addAddress" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Address</div>
                                                </div>
                                                <input type="hidden" id="no_of_address" name="no_of_address" value="1">
                                                <!--<div class="form-group">
                                                    <label>Address</label>
                                                    <textarea class="form-control" name="address1" rows="3" placeholder="Enter Address" required></textarea>
                                                </div>
                                                <label>Postcode</label>                
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-road"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="postcode" placeholder="Enter Postcode" required>
                                                </div>-->               
                                                <div class="form-group">
                                                    <label>Country of Residence</label>
                                                    <select class="form-control" id="countryId" name="country_id" onchange="changePartnerCountry()" required>
                                                        <option value="">Select Country of Residence</option>
                                                        <?php
                                                        $resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries ORDER BY name");
                                                        if($resultCountry->num_rows > 0){
                                                            while($rowCountry = $resultCountry->fetch_array()){
                                                                echo '<option value="'.$rowCountry["id"].'">'.$rowCountry["name"].'</option>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Country Available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>If Country Is Not Found Click</label>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger btn-xs dropdown-toggle" data-toggle="dropdown">
                                                            Country
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right" role="menu">
                                                            <li><a href="add-country.php" target="_blank">Add Country</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="countries.php" target="_blank">View All</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>                                                
                                                <h3>Email Section</h3>
                                                <div id="emails">
                                                    <div class="well" id="emailContainer1">
                                                        <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeEmail(1)">X</span></div>
                                                        <input type="hidden" id="is-exist-email1" name="is-exist-email1" value="1">
                                                        <label class="control-label" for="inputSuccess">Email Id</label>
                                                        <div class="form-group input-group has-success">
                                                            <span class="input-group-addon"><i class="fa fa-envelope"></i>
                                                            </span>
                                                            <input type="email" class="form-control" id="email1" name="email1" onchange="changePartnerEmail()" placeholder="Enter Email Id">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div id="addEmail" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Email</div>
                                                </div>
                                                <input type="hidden" id="no_of_email" name="no_of_email" value="1"> 
                                                <!--<label>Email Id</label>                                
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input type="email" class="form-control" name="email" placeholder="Enter Email Id" required>
                                                </div>-->                     
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-6">                        
                                                <h3>Telephone Section</h3>
                                                <div id="telephones">
                                                    <div class="well" id="telephoneContainer1">
                                                        <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeTelephone(1)">X</span></div>
                                                        <input type="hidden" id="is-exist-telephone1" name="is-exist-telephone1" value="1">
                                                        <label class="control-label" for="inputSuccess">Telephone</label>                       
                                                        <div class="form-group input-group has-success">
                                                            <span class="input-group-addon"><i class="fa fa-phone"></i>
                                                            </span>
                                                            <input type="text" class="form-control" id="telephone1" name="telephone1" onchange="changePartnerTelephone()" placeholder="Enter Telephone">
                                                        </div>
                                                        <div class="form-group has-warning">
                                                            <label class="control-label" for="inputWarning">Telephone Description</label>
                                                            <input type="text" class="form-control" id="inputWarning" name="telephone_description1" placeholder="Enter Telephone Description">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div id="addTelephone" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Telephone</div>
                                                </div>
                                                <input type="hidden" id="no_of_telephone" name="no_of_telephone" value="1">

                                                <!--<label>Telephone</label>                  
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="telephone" placeholder="Enter Telephone" required>
                                                </div>-->
                                                <!--<div class="form-group">
                                                    <label>Company Director of</label>
                                                    <select class="form-control" name="company_director_of">
                                                        <option value="">Select Company Director of</option>
                                                        <?php/*
                                                        $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies");
                                                        if($resultCompany->num_rows > 0){
                                                            while($rowCompany = $resultCompany->fetch_array()){
                                                                echo '<option value="'.$rowCompany["id"].'">'.$rowCompany["company_name"].'</option>';
                                                            }                       
                                                        }else{
                                                            echo '<option>No Company Available</option>';
                                                        }*/
                                                        ?>
                                                    </select>
                                                </div>-->   
                                                <div class="form-group">
                                                    <label>Companies Director of</label>
                                                    <div class="btn-group">
                                                        <select id="companies" name="companies" multiple="multiple" style="display: none;">
                                                        <?php
                                                        $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies");
                                                        if($resultCompany->num_rows > 0){
                                                            while($rowCompany = $resultCompany->fetch_array()){
                                                                echo '<option value="'.$rowCompany["id"].'">'.$rowCompany["company_name"].'</option>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Company Available</option>';
                                                        }
                                                        ?>
                                                        </select>
                                                        <button id="companies-toggle" class="btn btn-danger">Select All</button>
                                                    </div>
                                                    <input type="hidden" id="companyIds" name="companyIds">
                                                </div>
                                                <label>Date Of Birth</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="dob" class="form-control" name="dob" onclick="showDatePicker('dob')" placeholder="Enter Date Of Birth" required>
                                                </div>                               
                                                <div class="form-group">
                                                    <label>Place Of Birth</label>
                                                    <input type="text" class="form-control" name="place_of_birth" placeholder="Enter Place Of Birth"/>
                                                </div>
                                                <label>Date Of Death</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="date_of_death" class="form-control" name="date_of_death" onclick="showDatePicker('date_of_death')" placeholder="Enter Date Of Death">
                                                </div>                                 
                                                <div class="form-group">
                                                    <label>Nationality</label>
                                                    <input type="text" class="form-control" name="nationality" placeholder="Enter Nationality"/>
                                                </div>                                
                                                <div class="form-group">
                                                    <label>Passport Number</label>
                                                    <input type="text" class="form-control" name="passport_no" placeholder="Enter Passport Number"/>
                                                </div> 
                                                <div class="form-group">
                                                    <label>Marital Status</label>             
                                                    <select class="form-control" id="maritalStatus"  name="marital_status" onchange="changeMaritalStatus()" required>
                                                    <option value="">Select Marital Status</option>
                                                    <?php
                                                    foreach($marital_status as $marital_st){
                                                       echo '<option>'.$marital_st.'</option>'; 
                                                    }
                                                    ?>
                                                    </select>
                                                </div>
                                                <label>Date Of Marriage</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="date_of_marriage" class="form-control" name="date_of_marriage" onclick="showDatePicker('date_of_marriage')" placeholder="Enter Date Of Marriage">
                                                </div>                               
                                                <div class="form-group">
                                                    <label>Place Of Marriage</label>
                                                    <input type="text" class="form-control" name="place_of_marriage" placeholder="Enter Place Of Marriage"/>
                                                </div>
                                                <div class="form-group">
                                                    <label>Active </label>
                                                    <label><input type="checkbox" name="active" checked></label>
                                                </div>  
                                                <div class="form-group">
                                                    <label>On Stop </label>
                                                    <label><input type="checkbox" name="on_stop"></label>
                                                </div>  
                                                <!--<div class="form-group">
                                                    <label>Active</label>                      <input type="radio" name="active" value="Yes" checked>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="active" value="Yes" checked>Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="active" value="No">No
                                                    </label>
                                                </div> 
                                                <div class="form-group">
                                                    <label>On Stop</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="on_stop" value="Yes">Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="on_stop" value="No" checked>No
                                                    </label>
                                                </div>-->
                                                <label>Engagement Start Date</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="engagement_start_date" class="form-control" name="engagement_start_date" onclick="showDatePicker('engagement_start_date')" placeholder="Enter Engagement Start Date">
                                                </div>    
                                                <label>Engagement End Date</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="engagement_end_date" class="form-control" name="engagement_end_date" onclick="showDatePicker('engagement_end_date')" placeholder="Enter Engagement End Date">
                                                </div>             
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.tab-pane -->                                    
                                    <!-- Partner Section -->
                                    <div class="tab-pane fade" id="partner">
                                        <div class="row">
                                            <div class="col-lg-6">                    
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" name="p_firstname" placeholder="Enter First Name">
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Surname</label>
                                                    <input type="text" class="form-control" id="pSurname" name="p_surname" placeholder="Enter Surname">
                                                </div>                    
                                                <div class="form-group">
                                                    <label>Maiden Name</label>
                                                    <input type="text" class="form-control" name="p_maiden_name" placeholder="Enter Maiden Name">
                                                </div>                                                 
                                                <div class="form-group has-success">
                                                    <label class="control-label" for="inputSuccess">Address</label>
                                                    <textarea class="form-control" id="pAddress" name="p_address" rows="3" placeholder="Enter Address"></textarea>
                                                </div>
                                                <label>Postcode</label>                
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-road"></i>
                                                    </span>
                                                    <input type="text" class="form-control" name="p_postcode" placeholder="Enter Postcode">
                                                </div>               
                                                <div class="form-group">
                                                    <label>Country of Residence</label>
                                                    <select class="form-control" id="pCountryId" name="p_country_id">
                                                        <option value="">Select Country of Residence</option>
                                                        <?php
                                                        $resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries countries ORDER BY name");
                                                        if($resultCountry->num_rows > 0){
                                                            while($rowCountry = $resultCountry->fetch_array()){
                                                                echo '<option value="'.$rowCountry["id"].'">'.$rowCountry["name"].'</option>';
                                                            }                                            
                                                        }else{
                                                            echo '<option>No Country Available</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>                                                
                                                <label class="control-label" for="inputSuccess">Email Id</label>                       
                                                <div class="form-group input-group has-success">
                                                    <span class="input-group-addon"><i class="fa fa-envelope"></i>
                                                    </span>
                                                    <input type="email" class="form-control" id="pEmail" name="p_email" placeholder="Enter Email Id">
                                                </div>                  
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-6">
                                                <label class="control-label" for="inputSuccess">Telephone</label>                       
                                                <div class="form-group input-group has-success">
                                                    <span class="input-group-addon"><i class="fa fa-phone"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="pTelephone" name="p_telephone" placeholder="Enter Telephone">
                                                </div>
                                                <label>Date Of Birth</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="p_dob" class="form-control" name="p_dob" onclick="showDatePicker('p_dob')" placeholder="Enter Date Of Birth">
                                                </div>                               
                                                <div class="form-group">
                                                    <label>Place Of Birth</label>
                                                    <input type="text" class="form-control" name="p_place_of_birth" placeholder="Enter Place Of Birth"/>
                                                </div>
                                                <label>Date Of Death</label>              
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" id="p_date_of_death" class="form-control" name="p_date_of_death" onclick="showDatePicker('p_date_of_death')" placeholder="Enter Date Of Death">
                                                </div>                                 
                                                <div class="form-group">
                                                    <label>Nationality</label>
                                                    <input type="text" class="form-control" name="p_nationality" placeholder="Enter Nationality"/>
                                                </div>                                
                                                <div class="form-group">
                                                    <label>Passport Number</label>
                                                    <input type="text" class="form-control" name="p_passport_no" placeholder="Enter Passport Number"/>
                                                </div>         
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- UK Section -->
                                    <div class="tab-pane fade" id="uk">
                                        <div class="row">                                        
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>National Insurance</label>
                                                    <input type="text" class="form-control" name="national_insurance" placeholder="Enter National Insurance">
                                                </div>
                                                <div class="form-group has-success">
                                                    <label class="control-label" for="inputSuccess">Address</label>
                                                    <textarea class="form-control" name="uk_address" rows="3" placeholder="Enter Address"></textarea>
                                                </div>
                                                <div class="form-group has-warning">
                                                    <label class="control-label" for="inputWarning">Address Description</label>
                                                    <input type="text" class="form-control" id="inputWarning" name="uk_address_description" placeholder="Enter Address Description">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Payroll Required </label>
                                                    <select class="form-control" id="payrollRequired" name="payroll_required">
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
                                                    <label>First Tax Year Due</label>
                                                    <select class="form-control" name="first_tax_year_due">
                                                        <option value="">Select First Tax Year Due</option>
                                                        <?php
                                                        foreach($tax_years as $tax_year){
                                                           echo '<option>'.$tax_year.'</option>'; 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>                                         
                                                <div class="form-group">
                                                    <label>UTR</label>
                                                    <input type="number" class="form-control" name="utr" placeholder="Enter UTR">
                                                </div>                 
                                                <div class="form-group">
                                                    <label>VAT Registered</label>
                                                    <select class="form-control" name="vat_registered">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>                 
                                            </div>
                                            <!-- /.col-lg-6 -->                                       
                                            <div class="col-lg-6">  
                                                <label>Business Commencement Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="businessCommencementDate" name="business_commencement_date" onclick="showDatePicker('businessCommencementDate')" placeholder = "Business Commencement Date"/>
                                                </div>  
                                                <div class="form-group">
                                                    <label>Any Other Paid Employment</label>
                                                    <select class="form-control" name="other_paid_employment">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div> 
                                                <div class="form-group">
                                                    <label>P45/P60 required for year 1 SA</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="first_year_p45_p60" value="Yes" checked>Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="first_year_p45_p60" value="No">No
                                                    </label>
                                                </div>                                        
                                                <div class="form-group">
                                                    <label>P45/P60 required for subsequent years SA</label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="subsequent_years_p45_p60" value="Yes" checked>Yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="subsequent_years_p45_p60" value="No">No
                                                    </label>
                                                </div> 
                                                <label>Fee</label> 
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="fee" placeholder="Enter Fee">
                                                </div> 
                                                <div class="form-group">
                                                    <label>Fee Type</label>
                                                    <select class="form-control" name="fee_type">
                                                        <option>Monthly</option>
                                                        <option>Annual</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Reference</label>
                                                    <select class="form-control" name="reference">
                                                        <option>HJ</option>
                                                        <option>MSI</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>64-8 to HMRC</label>
                                                    <select class="form-control" name="uk_sixtyfour_eight_to_hmrc">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div> 
                                                <label>64-8 to HMRC Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="uk_sixtyfour_eight_to_hmrc_date" name="uk_sixtyfour_eight_to_hmrc_date" onclick="showDatePicker('uk_sixtyfour_eight_to_hmrc_date')" placeholder = "Enter 64-8 to HMRC Date"/>
                                                </div>                                      
                                                <!--<div class="form-group"> 
                                                    <label>Notes</label> 
                                                    <textarea class="form-control" name="notes" rows="7" placeholder="Enter Notes"></textarea>
                                                </div>-->                  
                                            </div>
                                            <!-- /.col-lg-6 -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.tab-pane -->
                                    <!-- France Section -->
                                    <div class="tab-pane fade" id="france">
                                        <div class="row">                                        
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Social Security Number</label>
                                                    <input type="text" class="form-control" name="social_security_no" placeholder="Enter Social Security Number">
                                                </div>
                                                <div class="form-group">
                                                    <label>Siret Number</label>
                                                    <input type="text" class="form-control" name="siret_number" placeholder="Enter Siret Number">
                                                </div>
                                                <div class="form-group">
                                                    <label>Business Regime</label>
                                                    <input type="text" class="form-control" name="business_regime" placeholder="Enter Business Regime">
                                                </div>  
                                                <label>Business Commencement Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="f_business_commencement_date" name="f_business_commencement_date" onclick="showDatePicker('f_business_commencement_date')" placeholder = "Enter Business Commencement Date"/>
                                                </div>    
                                                <label>Business End Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="f_business_end_date" name="f_business_end_date" onclick="showDatePicker('f_business_end_date')" placeholder = "Enter Business End Date"/>
                                                </div>                       
                                                <div class="form-group">
                                                    <label>First Tax Year Due</label>
                                                    <select class="form-control" name="f_first_tax_year_due">
                                                        <option value="">Select First Tax Year Due</option>
                                                        <?php
                                                        foreach($tax_years as $tax_year){
                                                           echo '<option>'.$tax_year.'</option>'; 
                                                        }
                                                        ?>
                                                    </select>
                                                </div>  
                                                <label>Fee</label> 
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-eur"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="f_fee" placeholder="Enter Fee">
                                                </div>  
                                                <div class="form-group has-success">
                                                    <label class="control-label" for="inputSuccess">Previous Address</label>
                                                    <textarea class="form-control" name="f_prvious_address" rows="3" placeholder="Enter Previous Address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Fiscal Number</label>
                                                    <input type="text" class="form-control" name="fiscal_no_first" placeholder="Enter Fiscal Number">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="fiscal_no_second" placeholder="Enter Fiscal Number">
                                                </div>
                                                <div class="form-group">
                                                    <label>FIP Number</label>
                                                    <input type="text" class="form-control" name="fip_no" placeholder="Enter FIP Number">
                                                </div>                       
                                            </div>
                                            <!-- /.col-lg-6 -->                                       
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>FD5</label>
                                                    <select class="form-control" name="fd5">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>  
                                                <label>FD5 Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="fd5_date" name="fd5_date" onclick="showDatePicker('fd5_date')" placeholder = "Enter FD5 Date"/>
                                                </div>  
                                                <div class="form-group">
                                                    <label>P85</label>
                                                    <select class="form-control" name="p85">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>   
                                                <label>P85 Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="p85_date" name="p85_date" onclick="showDatePicker('p85_date')" placeholder = "Enter P85 Date"/>
                                                </div>  
                                                <div class="form-group">
                                                    <label>NRL1</label>
                                                    <select class="form-control" name="nrl1">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>   
                                                <label>NRL1 Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="nrl1_date" name="nrl1_date" onclick="showDatePicker('nrl1_date')" placeholder = "Enter NRL1 Date"/>
                                                </div>  
                                                <div class="form-group">
                                                    <label>S1</label>
                                                    <select class="form-control" name="s1">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>   
                                                <label>S1 Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="s1_date" name="s1_date" onclick="showDatePicker('s1_date')" placeholder = "Enter S1 Date"/>
                                                </div> 
                                                <div class="form-group">
                                                    <label>64-8 to HMRC</label>
                                                    <select class="form-control" name="sixtyfour_eight_to_hmrc">
                                                        <option>No</option>
                                                        <option>Yes</option>
                                                    </select>
                                                </div>     
                                                <label>64-8 to HMRC Date</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input type="text" class="form-control" id="sixtyfour_eight_to_hmrc_date" name="sixtyfour_eight_to_hmrc_date" onclick="showDatePicker('sixtyfour_eight_to_hmrc_date')" placeholder = "Enter 64-8 to HMRC Date"/>
                                                </div>   
                                                <div class="form-group">
                                                    <label>Teledeclarant Number</label>
                                                    <input type="text" class="form-control" name="teledeclarant_number" placeholder="Enter Teledeclarant Number">
                                                </div>      
                                                <div class="form-group">
                                                    <label>Service Impots Particulier Password</label>
                                                    <input type="text" class="form-control" name="service_impots_particulier_password" placeholder="Enter Service Impots Particulier Password">
                                                </div>     
                                                <div class="form-group has-success">
                                                    <label class="control-label" for="inputSuccess">CDI Address</label>
                                                    <textarea class="form-control" name="cdi_address" rows="3" placeholder="Enter CDI Address"></textarea>
                                                </div>                  
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
                                    <button type="submit" id="addIndividualSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
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
