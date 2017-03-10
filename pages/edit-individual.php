<?php 
require_once('header.php');
require_once('sidebar.php');
$individual_id = $_REQUEST['id'];
$result = mysqli_query($db->db_conn, "SELECT * FROM individuals where id = ". $individual_id);

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
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            ?>           
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header text-center">Edit Individual : <span class="text-danger"><?php echo $row["firstname"].' '. $row["surname"]; ?></span></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <form role="form" id="editIndividualForm">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-warning">
                                <div class="panel-heading text-center">
                                    Individual Form Elements
                                </div>
                                <div class="panel-body">                                   
                                    <ul class="nav nav-tabs">
                                        <li class="active text-warning"><a href="#general" data-toggle="tab" class="text-warning"><i class="fa fa-cog"></i> General</a></li>
                                        <li><a href="#partner" data-toggle="tab" class="text-warning"><i class="fa fa-male"></i><i class="fa fa-female"></i> Partner</a></li>
                                        <li><a href="#uk" data-toggle="tab" class="text-warning"><img src="../images/edit-uk.png" alt="UK" class="individual-tab-heading image"/> UK</a></li>
                                        <li><a href="#france" data-toggle="tab" class="text-warning"><img src="../images/edit-france.png" alt="France" class="individual-tab-heading image"/> France</a></li>
                                        <li><a href="#notes" data-toggle="tab" class="text-warning"><i class="fa fa-file-text"></i> Notes</a></li>
                                    </ul>
                                    <div class="tab-content individual-tab-content">
                                        <!-- General Section -->
                                        <div class="tab-pane fade in active" id="general">
                                            <div class="row">
                                                <input type="hidden" name="individual_id" value="<?php echo $individual_id;?>">
                                                <div class="col-lg-6">                    
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" name="firstname" value="<?php echo $row["firstname"]; ?>" required>
                                                    </div>                    
                                                    <div class="form-group">
                                                        <label>Surname</label>
                                                        <input type="text" class="form-control" id="surname" name="surname" onchange="changePartnerSurname()" value="<?php echo $row["surname"]; ?>" required>
                                                    </div>                   
                                                    <div class="form-group">
                                                        <label>Maiden Name</label>
                                                        <input type="text" class="form-control" name="maiden_name"  value="<?php echo $row["maiden_name"]; ?>">
                                                    </div>                    
                                                    <div class="form-group">
                                                        <label>Client ID</label>
                                                        <input type="text" class="form-control" name="client_id" value="<?php echo $row["client_id"]; ?>" required>
                                                    </div>                                            
                                                    <h3>Address Section</h3>
                                                    <div id="addresses">
                                                    <?php 
                                                    $resultAddress = mysqli_query($db->db_conn, "SELECT * FROM addresses where individual_id = ". $individual_id);
                                                    $i=1;
                                                    while($rowAddress = $resultAddress->fetch_array()){
                                                    ?>
                                                        <input type="hidden" name="address_id<?php echo $i; ?>" value="<?php echo $rowAddress['id']; ?>">
                                                        <div class="well" id="addressContainer<?php echo $i; ?>">
                                                            <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeAddress(<?php echo $i; ?>)">X</span></div>
                                                            <input type="hidden" id="is-exist-address<?php echo $i; ?>" name="is-exist-address<?php echo $i; ?>" value="1">                         
                                                            <div class="form-group has-success">
                                                                <label class="control-label" for="inputSuccess">Address</label>
                                                                <textarea class="form-control" name="address<?php echo $i; ?>" rows="3" <?php  if($i == 1){ echo 'id="address1" onchange="changePartnerAddress()"';}?> ><?php echo $rowAddress['address']; ?></textarea>
                                                            </div>
                                                            <div class="form-group has-warning">
                                                                <label class="control-label" for="inputWarning">Address Description</label>
                                                                <input type="text" class="form-control" id="inputWarning" name="address_description<?php echo $i; ?>"  value="<?php echo $rowAddress['description']; ?>">
                                                            </div> 
                                                        </div>
                                                    <?php
                                                    $i++;
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="text-center">
                                                        <div id="addAddress" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Address</div>
                                                    </div>
                                                    <input type="hidden" id="no_of_address" name="no_of_address" value="<?php echo $row["no_of_address"]; ?>">

                                                    <!--<div class="form-group">
                                                        <label>Address</label>
                                                        <textarea class="form-control" name="address1" rows="3" required><?php/* echo $row["address1"]; */?></textarea>
                                                    </div>-->
                                                    <!--<div class="form-group">
                                                        <label>Address 2</label>
                                                        <textarea class="form-control" name="address2" rows="3"><?php/* echo $row["address2"]; */?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address 3</label>
                                                        <textarea class="form-control" name="address3" rows="3"><?php/* echo $row["address3"]; */?></textarea>
                                                    </div>
                                                    <label>Postcode</label>                
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-road"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="postcode" value="<?php/* echo $row["postcode"];*/ ?>" required>
                                                    </div> -->                
                                                    <div class="form-group">
                                                        <label>Country of Residence</label>
                                                        <select class="form-control" id="countryId" name="country_id" onchange="changePartnerCountry()" required>
                                                            <option value="">Select Country of Residence</option>
                                                            <?php
                                                            $resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries ORDER BY name");
                                                            if($resultCountry->num_rows > 0){
                                                                while($rowCountry = $resultCountry->fetch_array()){
                                                                    echo '<option value="'.$rowCountry["id"].'" '.(($row["country_id"] == $rowCountry["id"]) ? 'selected = "selected"' : '').'>'.$rowCountry["name"].'</option>';
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
                                                    <?php 
                                                    $resultEmail = mysqli_query($db->db_conn, "SELECT * FROM emails where individual_id = ". $individual_id);
                                                    $i=1;
                                                    while($rowEmail = $resultEmail->fetch_array()){
                                                    ?>
                                                        <input type="hidden" name="email_id<?php echo $i; ?>" value="<?php echo $rowEmail['id']; ?>">
                                                        <div class="well" id="emailContainer<?php echo $i; ?>">
                                                            <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeEmail(<?php echo $i; ?>)">X</span></div>
                                                            <input type="hidden" id="is-exist-email<?php echo $i; ?>" name="is-exist-email<?php echo $i; ?>" value="1"> 
                                                            <label class="control-label" for="inputSuccess">Email Id</label> 

                                                            <div class="form-group input-group has-success">
                                                                <span class="input-group-addon"><i class="fa fa-envelope"></i>
                                                                </span>
                                                                <input type="emai<?php echo $i; ?>" class="form-control" name="email<?php echo $i; ?>" value="<?php echo $rowEmail['email']; ?>" <?php if($i == 1){ echo 'id="email1" onchange="changePartnerEmail()"';}?> >
                                                            </div>
                                                        </div>
                                                    <?php
                                                    $i++;
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="text-center">
                                                        <div id="addEmail" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Email</div>
                                                    </div>
                                                    <input type="hidden" id="no_of_email" name="no_of_email" value="<?php echo $row["no_of_email"]; ?>">         
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <h3>Telephone Section</h3>
                                                    <div id="telephones">
                                                    <?php 
                                                    $resultTelephone = mysqli_query($db->db_conn, "SELECT * FROM telephones where individual_id = ". $individual_id);
                                                    $i=1;
                                                    while($rowTelephone = $resultTelephone->fetch_array()){
                                                    ?>
                                                        <input type="hidden" name="telephone_id<?php echo $i; ?>" value="<?php echo $rowTelephone['id']; ?>">
                                                        <div class="well" id="telephoneContainer<?php echo $i; ?>">
                                                            <div class="form-group"><span class="pull-right btn-xs btn-danger" onclick="removeTelephone(<?php echo $i; ?>)">X</span></div>
                                                            <input type="hidden" id="is-exist-telephone<?php echo $i; ?>" name="is-exist-telephone<?php echo $i; ?>" value="1">
                                                            <label class="control-label" for="inputSuccess">Telephone</label>                       
                                                            <div class="form-group input-group has-success">
                                                                <span class="input-group-addon"><i class="fa fa-phone"></i>
                                                                </span>
                                                                <input type="text" class="form-control" name="telephone<?php echo $i; ?>" value="<?php echo $rowTelephone['telephone']; ?>" <?php if($i == 1){echo 'id="telephone1" onchange="changePartnerTelephone()"';}?> >
                                                            </div>
                                                            <div class="form-group has-warning">
                                                                <label class="control-label" for="inputWarning">Telephone Description</label>
                                                                <input type="text" class="form-control" id="inputWarning" name="telephone_description<?php echo $i; ?>" value="<?php echo $rowTelephone['description']; ?>">
                                                            </div>
                                                        </div>
                                                    <?php
                                                    $i++;
                                                    }
                                                    ?>
                                                    </div>
                                                    <div class="text-center">
                                                        <div id="addTelephone" class="btn btn-xs btn-danger" style="margin-bottom:15px;"><i class="fa fa-plus"></i> Add Telephone</div>
                                                    </div>
                                                    <input type="hidden" id="no_of_telephone" name="no_of_telephone" value="<?php echo $row["no_of_telephone"]; ?>">
                                                    <!--<div class="form-group">   
                                                        <label>Company Director of</label>
                                                        <select class="form-control" name="company_director_of">
                                                            <option value="">Select Company Director of</option>
                                                            <?php/*
                                                            $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies");
                                                            if($resultCompany->num_rows > 0){
                                                                while($rowCompany = $resultCompany->fetch_array()){
                                                                    echo '<option value="'.$rowCompany["id"].'" '.(($rowCompany["id"] == $row["company_director_of"]) ? 'selected="selected"' : "").'>'.$rowCompany["company_name"].'</option>';
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
                                                                    echo '<option value="'.$rowCompany["id"].'" '.((in_array($rowCompany["id"], $companiesIdsArray)) ? 'selected="selected"' : "").'>'.$rowCompany["company_name"].'</option>';
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
                                                        <input type="text" id="dob" class="form-control" name="dob" value="<?php if($row["dob"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["dob"]));}?>" placeholder="Enter Date Of Birth"/>
                                                    </div>                              
                                                    <div class="form-group">
                                                        <label>Place Of Birth</label>
                                                        <input type="text" class="form-control" name="place_of_birth" value="<?php echo $row["place_of_birth"]; ?>"/>
                                                    </div>
                                                    <label>Date Of Death</label>              
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" id="date_of_death" class="form-control" name="date_of_death" onclick="showDatePicker('date_of_death')" value="<?php if($row["date_of_death"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["date_of_death"]));}?>" placeholder="Enter Date Of Death">
                                                    </div>                                 
                                                    <div class="form-group">
                                                        <label>Nationality</label>
                                                        <input type="text" class="form-control" name="nationality" value="<?php echo $row["nationality"]; ?>"/>
                                                    </div>                                
                                                    <div class="form-group">
                                                        <label>Passport Number</label>
                                                        <input type="text" class="form-control" name="passport_no" value="<?php echo $row["passport_no"]; ?>"/>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Marital Status</label>             
                                                        <select class="form-control" id="maritalStatus" name="marital_status" onchange="changeMaritalStatus()" required>
                                                        <option value="">Select Marital Status</option>
                                                        <?php
                                                        foreach($marital_status as $marital_st){
                                                           echo '<option '.(($row["marital_status"] == $marital_st) ? 'selected="selected"' : '').'>'.$marital_st.'</option>'; 
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <label>Date Of Marriage</label>              
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" id="date_of_marriage" class="form-control" name="date_of_marriage" onclick="showDatePicker('date_of_marriage')" value="<?php if($row["date_of_marriage"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["date_of_marriage"]));}?>" placeholder="Enter Date Of Marriage"/>
                                                    </div>                               
                                                    <div class="form-group">
                                                        <label>Place Of Marriage</label>
                                                        <input type="text" class="form-control" name="place_of_marriage" value="<?php echo $row["place_of_marriage"]; ?>"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Active </label>
                                                        <label><input type="checkbox" name="active"  <?php if ($row['active']=='Yes') echo 'checked = "checked"';?>></label>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>On Stop </label>
                                                        <label><input type="checkbox" name="on_stop" <?php if ($row['on_stop']=='Yes') echo 'checked = "checked"';?> ></label>
                                                    </div>   
                                                    <!--<div class="form-group">
                                                        <label>Active</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="active" value="Yes" <?php/* if ($row['active']=='Yes') echo 'checked = "checked"';*/?> >Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="active" value="No" <?php/* if ($row['active']=='No') echo 'checked = "checked"';*/?> >No
                                                        </label>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>On Stop</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_stop" value="Yes" <?php/* if ($row['on_stop']=='Yes') echo 'checked = "checked"';*/?> >Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="on_stop" value="No" <?php/* if ($row['on_stop']=='No') echo 'checked = "checked"';*/?> >No
                                                        </label>
                                                    </div>-->
                                                    <label>Engagement Start Date</label>              
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" id="engagement_start_date" class="form-control" name="engagement_start_date" onclick="showDatePicker('engagement_start_date')" value="<?php if($row["engagement_start_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["engagement_start_date"]));}?>" placeholder="Enter Engagement Start Date"/>
                                                    </div>    
                                                    <label>Engagement End Date</label>              
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" id="engagement_end_date" class="form-control" name="engagement_end_date" onclick="showDatePicker('engagement_end_date')" value="<?php if($row["engagement_end_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["engagement_end_date"]));}?>" placeholder="Enter Engagement End Date"/>
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
                                                        <input type="text" class="form-control" name="p_firstname" value="<?php echo $row["p_firstname"]; ?>">
                                                    </div>                    
                                                    <div class="form-group">
                                                        <label>Surname</label>
                                                        <input type="text" class="form-control" id="pSurname" name="p_surname" value="<?php echo $row["p_surname"]; ?>">
                                                    </div>                    
                                                    <div class="form-group">
                                                        <label>Maiden Name</label>
                                                        <input type="text" class="form-control" name="p_maiden_name" value="<?php echo $row["p_maiden_name"]; ?>">
                                                    </div>                                                 
                                                    <div class="form-group has-success">
                                                        <label class="control-label" for="inputSuccess">Address</label>
                                                        <textarea class="form-control" id="pAddress" name="p_address" rows="3"><?php echo $row["p_address"]; ?></textarea>
                                                    </div>
                                                    <label>Postcode</label>                
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-road"></i>
                                                        </span>
                                                        <input type="text" class="form-control" name="p_postcode" value="<?php echo $row["p_postcode"]; ?>">
                                                    </div>               
                                                    <div class="form-group">
                                                        <label>Country of Residence</label>
                                                        <select class="form-control" id="pCountryId" name="p_country_id">
                                                            <option value="">Select Country of Residence</option>
                                                            <?php
                                                            $resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries countries ORDER BY name");
                                                            if($resultCountry->num_rows > 0){
                                                                while($rowCountry = $resultCountry->fetch_array()){
                                                                    echo '<option value="'.$rowCountry["id"].'" '.(($row["p_country_id"] == $rowCountry["id"]) ? 'selected = "selected"' : '').'>'.$rowCountry["name"].'</option>';
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
                                                        <input type="email" class="form-control" id="pEmail" name="p_email" value="<?php echo $row["p_email"]; ?>">
                                                    </div>                  
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">
                                                    <label class="control-label" for="inputSuccess">Telephone</label>                       
                                                    <div class="form-group input-group has-success">
                                                        <span class="input-group-addon"><i class="fa fa-phone"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="pTelephone" name="p_telephone" value="<?php echo $row["p_telephone"]; ?>">
                                                    </div>
                                                    <label>Date Of Birth</label>              
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" id="p_dob" class="form-control" name="p_dob" onclick="showDatePicker('p_dob')" value="<?php if($row["p_dob"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["p_dob"]));}?>" placeholder="Enter Date Of Birth"/>
                                                    </div>                               
                                                    <div class="form-group">
                                                        <label>Place Of Birth</label>
                                                        <input type="text" class="form-control" name="p_place_of_birth" value="<?php echo $row["p_place_of_birth"]; ?>"/>
                                                    </div>
                                                    <label>Date Of Death</label>              
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" id="p_date_of_death" class="form-control" name="p_date_of_death" onclick="showDatePicker('p_date_of_death')" value="<?php if($row["p_date_of_death"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["p_date_of_death"]));}?>" placeholder="Enter Date Of Death"/>
                                                    </div>                                 
                                                    <div class="form-group">
                                                        <label>Nationality</label>
                                                        <input type="text" class="form-control" name="p_nationality" value="<?php echo $row["p_nationality"]; ?>"/>
                                                    </div>                                
                                                    <div class="form-group">
                                                        <label>Passport Number</label>
                                                        <input type="text" class="form-control" name="p_passport_no" value="<?php echo $row["p_passport_no"]; ?>"/>
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
                                                        <input type="text" class="form-control" name="national_insurance" value="<?php echo $row["national_insurance"]; ?>">
                                                    </div>
                                                    <div class="form-group has-success">
                                                        <label class="control-label" for="inputSuccess">Address</label>
                                                        <textarea class="form-control" name="uk_address" rows="3"><?php echo $row["uk_address"]; ?></textarea>
                                                    </div>
                                                    <div class="form-group has-warning">
                                                        <label class="control-label" for="inputWarning">Address Description</label>
                                                        <input type="text" class="form-control" id="inputWarning" name="uk_address_description" value="<?php echo $row["uk_address_description"]; ?>">
                                                    </div>              
                                                    <div class="form-group">
                                                        <label>Payroll Required </label>
                                                        <select class="form-control" id="payrollRequired" name="payroll_required">
                                                            <option <?php if($row['payroll_required']=='No') echo 'selected="selected"';?> >No</option>
                                                            <option <?php if($row['payroll_required']=='Yes') echo 'selected="selected"';?> >Yes</option>
                                                        </select>
                                                    </div>
                                                    <div id="payrollOtherContainer" <?php if($row['payroll_required']=='No') echo 'style="display:none"';?>>                       
                                                        <div class="form-group">
                                                            <label>PAYE Reference</label>
                                                            <input type="text" class="form-control" id="payeReference" name="paye_reference" value="<?php echo $row['paye_reference']; ?>" <?php if($row['payroll_required']=='Yes') echo 'required';?>>
                                                        </div>                   
                                                        <div class="form-group">
                                                            <label>PAYE Office Code</label>
                                                            <input type="text" class="form-control" id="payeOfficeCode" name="paye_office_code" value="<?php echo $row['paye_office_code']; ?>" <?php if($row['payroll_required']=='Yes') echo 'required';?>>
                                                        </div> 
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>First Tax Year Due</label>             
                                                        <select class="form-control" name="first_tax_year_due">
                                                        <option value="">Select First Tax Year Due</option>
                                                        <?php
                                                        foreach($tax_years as $tax_year){
                                                           echo '<option '.(($row['first_tax_year_due'] == $tax_year)? 'selected="selected"': "").'>'.$tax_year.'</option>'; 
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>                                          
                                                    <div class="form-group">
                                                        <?php
                                                        /* Tax Return Years Check In Database */
                                                        $result1 = mysqli_query($db->db_conn, "SELECT * FROM  individuals_tax_return_years WHERE individual_id = ". $individual_id);
                                                        if(mysqli_num_rows($result1) > 0){
                                                            foreach($result1 as $result1){
                                                                $tax_return_years_string = $result1['tax_return_years'];
                                                            }
                                                            $tax_return_years_in_db_array = explode(",", $tax_return_years_string);
                                                        }else{
                                                           $tax_return_years_in_db_array = array(); 
                                                        }

                                                        /* Tax Return Years Generation */
                                                        //$returnable_tax_years = $tax_years;

                                                        $first_tax_year_due_index = array_search($row['first_tax_year_due'], $returnable_tax_years);
                                                        if(!$first_tax_year_due_index && $row['first_tax_year_due'] == $current_tax_year){
                                                            $individual_returnable_tax_years = array();
                                                        }else{
                                                           $individual_returnable_tax_years = array_splice($returnable_tax_years, $first_tax_year_due_index); 
                                                        }
                                                        if(count($individual_returnable_tax_years) > 0){
                                                            $flagLabel = false;
                                                            foreach($individual_returnable_tax_years as $return_tax_year){
                                                                if(!in_array($return_tax_year, $tax_return_years_in_db_array)){
                                                                    $flagLabel = true;
                                                                    break;
                                                                }
                                                            }
                                                            if($flagLabel){
                                                                echo '<label>Tax Return Submitted To HMRC</label>';
                                                            }
                                                            foreach($individual_returnable_tax_years as $returnable_tax_year){
                                                               echo '<div class="checkbox"><label><input type="checkbox" name="tax_return_years[]" value="'.$returnable_tax_year.'" '.((in_array($returnable_tax_year, $tax_return_years_in_db_array))? 'checked="checked"' : "").'  '.((in_array($returnable_tax_year, $tax_return_years_in_db_array))? 'disabled' : "").'/>'.$returnable_tax_year.'</label></div>'; 
                                                            }
                                                        }
                                                        ?>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Requires Tax Return</label>
                                                        <select class="form-control" name="requires_tax_return">
                                                            <option <?php if($row['requires_tax_return']=='No') echo 'selected="selected"';?> >No</option>
                                                            <option  <?php if($row['requires_tax_return']=='Yes') echo  'selected="selected"';?> >Yes</option>
                                                        </select>
                                                    </div>            
                                                    <div class="form-group">
                                                        <label>UTR</label>
                                                        <input type="number" class="form-control" name="utr" value="<?php echo $row["utr"]; ?>">
                                                    </div>                 
                                                    <div class="form-group">
                                                        <label>VAT Registered</label>
                                                        <select class="form-control" name="vat_registered" required>
                                                            <option <?php if($row['vat_registered']=='No') echo 'selected="selected"';?> >No</option>
                                                            <option  <?php if($row['vat_registered']=='Yes') echo  'selected="selected"';?> >Yes</option>
                                                        </select>
                                                    </div>         
                                                </div>
                                                <!-- /.col-lg-6 -->
                                                <div class="col-lg-6">                                  
                                                    <label>Business Commencement Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="businessCommencementDate" name="business_commencement_date" value="<?php if($row["business_commencement_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["business_commencement_date"]));}?>" placeholder="Enter Business Commencement Date"/>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>Any Other Paid Employment</label>
                                                        <select class="form-control" name="other_paid_employment">
                                                            <option <?php if($row['other_paid_employment']=='No') echo 'selected="selected"';?> >No</option>
                                                            <option <?php if($row['other_paid_employment']=='Yes') echo 'selected="selected"';?> >Yes</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>P45/P60 required for year 1 SA</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="first_year_p45_p60" value="Yes"  <?php if ($row['first_year_p45_p60']=='Yes') echo 'checked = "checked"';?> >Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="first_year_p45_p60" value="No"  <?php if($row['first_year_p45_p60']=='No') echo  'checked = "checked"';?> >No
                                                        </label>
                                                    </div>                                        
                                                    <div class="form-group">
                                                        <label>P45/P60 required for subsequent years SA</label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="subsequent_years_p45_p60" value="Yes" <?php if($row['subsequent_years_p45_p60']=='Yes') echo 'checked = "checked"'; ?> >Yes
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="subsequent_years_p45_p60" value="No"  <?php if($row['subsequent_years_p45_p60']=='No') echo 'checked = "checked"';?> >No
                                                        </label>
                                                    </div> 
                                                    <label>Fee</label> 
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="fee" value="<?php echo $row["fee"]; ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Fee Type</label>
                                                        <select class="form-control" name="fee_type">
                                                            <option <?php if($row['fee_type']=='Monthly') echo 'selected="selected"';?> >Monthly</option>
                                                            <option <?php if($row['fee_type']=='Annual') echo 'selected="selected"';?> >Annual</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Reference</label>
                                                        <select class="form-control" name="reference">
                                                            <option <?php if($row['reference']=='HJ') echo 'selected="selected"';?> >HJ</option>
                                                            <option <?php if($row['reference']=='MSI') echo 'selected="selected"';?> >MSI</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>64-8 to HMRC</label>
                                                        <select class="form-control" name="uk_sixtyfour_eight_to_hmrc">
                                                            <option <?php if($row['uk_sixtyfour_eight_to_hmrc']=='Yes') echo 'selected="selected"';?> >Yes</option>
                                                            <option <?php if($row['uk_sixtyfour_eight_to_hmrc']=='No') echo 'selected="selected"';?> >No</option>
                                                        </select>
                                                    </div> 
                                                    <label>64-8 to HMRC Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="uk_sixtyfour_eight_to_hmrc_date" name="uk_sixtyfour_eight_to_hmrc_date" onclick="showDatePicker('uk_sixtyfour_eight_to_hmrc_date')" value="<?php if($row["uk_sixtyfour_eight_to_hmrc_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["uk_sixtyfour_eight_to_hmrc_date"]));}?>" placeholder = "Enter 64-8 to HMRC Date"/>
                                                    </div>  
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
                                                        <input type="text" class="form-control" name="social_security_no"  value="<?php echo $row["social_security_no"]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Siret Number</label>
                                                        <input type="text" class="form-control" name="siret_number"  value="<?php echo $row["siret_number"]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Business Regime</label>
                                                        <input type="text" class="form-control" name="business_regime"  value="<?php echo $row["business_regime"]; ?>">
                                                    </div>  
                                                    <label>Business Commencement Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="f_business_commencement_date" name="f_business_commencement_date" onclick="showDatePicker('f_business_commencement_date')" value="<?php if($row["f_business_commencement_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["f_business_commencement_date"]));}?>" placeholder="Enter Business Commencement Date"/>
                                                    </div>    
                                                    <label>Business End Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="f_business_end_date" name="f_business_end_date" onclick="showDatePicker('f_business_end_date')" value="<?php if($row["f_business_end_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["f_business_end_date"]));}?>" placeholder="Enter Business End Date"/>
                                                    </div>                       
                                                    <div class="form-group">
                                                        <label>First Tax Year Due</label>
                                                        <select class="form-control" name="f_first_tax_year_due">
                                                            <option value="">Select First Tax Year Due</option>
                                                            <?php
                                                            foreach($tax_years as $tax_year){
                                                               echo '<option '.(( $row["f_first_tax_year_due"]==$tax_year) ? 'selected="selected"' : '').'>'.$tax_year.'</option>'; 
                                                            }
                                                            ?>
                                                        </select>
                                                    </div> 

                                                    <div class="form-group">
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

                                                        $first_tax_year_french_due_index = array_search($row['f_first_tax_year_due'], $french_returnable_tax_years);
                                                        if(!$first_tax_year_french_due_index && $row['f_first_tax_year_due'] == $current_tax_year){
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
                                                               echo '<div class="checkbox"><label><input type="checkbox" name="french_tax_return_years[]" value="'.$returnable_french_tax_year.'" '.((in_array($returnable_french_tax_year, $tax_return_years_french_in_db_array))? 'checked="checked"' : "").'  '.((in_array($returnable_french_tax_year, $tax_return_years_french_in_db_array))? 'disabled' : "").'/>'.$returnable_french_tax_year.'</label></div>'; 
                                                            }
                                                        }
                                                        ?>
                                                    </div>  
                                                    <label>Fee</label> 
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-eur"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="f_fee" value="<?php echo $row["f_fee"]; ?>">
                                                    </div>                                                 
                                                    <div class="form-group has-success">
                                                        <label class="control-label" for="inputSuccess">Previous Address</label>
                                                        <textarea class="form-control" name="f_prvious_address" rows="3"><?php echo $row["f_prvious_address"]; ?></textarea>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>Fiscal Number</label>
                                                        <input type="text" class="form-control" name="fiscal_no_first" value="<?php echo $row["fiscal_no_first"]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="fiscal_no_second" value="<?php echo $row["fiscal_no_second"]; ?>">
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>FIP Number</label>
                                                        <input type="text" class="form-control" name="fip_no" value="<?php echo $row["fip_no"]; ?>">
                                                    </div>                     
                                                </div>
                                                <!-- /.col-lg-6 -->                                       
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>FD5</label>
                                                        <select class="form-control" name="fd5">
                                                            <option>No</option>
                                                            <option <?php if($row['fd5']=='Yes') echo 'selected="selected"';?> >Yes</option>
                                                        </select>
                                                    </div>  
                                                    <label>FD5 Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="fd5_date" name="fd5_date" onclick="showDatePicker('fd5_date')" value="<?php if($row["fd5_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["fd5_date"]));}?>" placeholder = "Enter FD5 Date"/>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>P85</label>
                                                        <select class="form-control" name="p85">
                                                            <option>No</option>
                                                            <option <?php if($row['p85']=='Yes') echo 'selected="selected"';?>>Yes</option>
                                                        </select>
                                                    </div>   
                                                    <label>P85 Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="p85_date" name="p85_date" onclick="showDatePicker('p85_date')" value="<?php if($row["p85_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["p85_date"]));}?>" placeholder = "Enter P85 Date"/>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>NRL1</label>
                                                        <select class="form-control" name="nrl1">
                                                            <option>No</option>
                                                            <option <?php if($row['nrl1']=='Yes') echo 'selected="selected"';?>>Yes</option>
                                                        </select>
                                                    </div>   
                                                    <label>NRL1 Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="nrl1_date" name="nrl1_date" onclick="showDatePicker('nrl1_date')" value="<?php if($row["nrl1_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["nrl1_date"]));}?>" placeholder = "Enter NRL1 Date"/>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label>S1</label>
                                                        <select class="form-control" name="s1">
                                                            <option>No</option>
                                                            <option <?php if($row['s1']=='Yes') echo 'selected="selected"';?>>Yes</option>
                                                        </select>
                                                    </div>   
                                                    <label>S1 Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="s1_date" name="s1_date" onclick="showDatePicker('s1_date')" value="<?php if($row["s1_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["s1_date"]));}?>" placeholder = "Enter S1 Date"/>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label>64-8 to HMRC</label>
                                                        <select class="form-control" name="sixtyfour_eight_to_hmrc">
                                                            <option>No</option>
                                                            <option <?php if($row['sixtyfour_eight_to_hmrc']=='Yes') echo 'selected="selected"';?>>Yes</option>
                                                        </select>
                                                    </div>   
                                                    <label>64-8 to HMRC Date</label>
                                                    <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control" id="sixtyfour_eight_to_hmrc_date" name="sixtyfour_eight_to_hmrc_date" onclick="showDatePicker('sixtyfour_eight_to_hmrc_date')" value="<?php if($row["sixtyfour_eight_to_hmrc_date"] != "0000-00-00"){
                                                                echo date('d-m-Y', strtotime($row["sixtyfour_eight_to_hmrc_date"]));}?>" placeholder = "Enter 64-8 to HMRC Date"/>
                                                    </div>   
                                                    <div class="form-group">
                                                        <label>Teledeclarant Number</label>
                                                        <input type="text" class="form-control" name="teledeclarant_number" value="<?php echo $row["teledeclarant_number"]; ?>">
                                                    </div>      
                                                    <div class="form-group">
                                                        <label>Service Impots Particulier Password</label>
                                                        <input type="text" class="form-control" name="service_impots_particulier_password" value="<?php echo $row["service_impots_particulier_password"]; ?>">
                                                    </div>       
                                                    <div class="form-group has-success">
                                                        <label class="control-label" for="inputSuccess">CDI Address</label>
                                                        <textarea class="form-control" name="cdi_address" rows="3"><?php echo $row["cdi_address"]; ?></textarea>
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
                                                        <?php 
                                                        $resultNote = mysqli_query($db->db_conn, "SELECT * FROM notes where individual_id = ". $individual_id);
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
                                                    <input type="hidden" id="no_of_note" name="no_of_note" value="<?php echo $row['no_of_note']; ?>">          
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
                                        <button type="submit" id="editIndividualSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
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
            <?php
            }
        }else{
            echo '<div class="error-message">No Individual Found</div>';
        }
        ?> 

            <?php require_once('modals-page.php');?>
            
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
