<?php 
require_once('header.php');
require_once('sidebar.php');
$vat_id = $_REQUEST['id'];
$resultVat = mysqli_query($db->db_conn, "SELECT * FROM vats where id = ". $vat_id);
?>            

        <div id="page-wrapper">
        <?php        
        if($resultVat->num_rows > 0){   
            while($rowVat = $resultVat->fetch_assoc()){
            ?>           
               <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Company VAT</h1>
                </div>
                <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    Company VAT Informations
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6"> 
                                            <p>
                                                <b>Company : </b>
                                                <?php
                                                    $result = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = ".$rowVat['company_id']);
                                                    if($result->num_rows > 0){
                                                        while($row = $result->fetch_array()){
                                                            echo '<a href="company.php?id='.$row["id"].'" target="_blank">'.$row["company_name"].'</a>';
                                                        }                                            
                                                    }else{
                                                        echo 'No Company';
                                                    }
                                                ?>
                                            </p>             
                                            <p>
                                                <b>VAT Number : </b>
                                                <?php echo $rowVat['vat_number']; ?>
                                            </p>             
                                            <p>
                                                <b>VAT Registered Date : </b>
                                                <?php echo date('d-m-Y', strtotime($rowVat['vat_registered_date'])); ?>
                                            </p>             
                                            <p>
                                                <b>VAT Flat Rate : </b>
                                                <?php echo $rowVat['vat_flat_rate']; ?>
                                            </p>             
                                            <p>
                                                <b>Flat Rate First Year : </b>
                                                <?php echo $rowVat['flat_rate_first_year']; ?>
                                            </p>             
                                            <p>
                                                <b>Flat Rate After First Year : </b>
                                                <?php echo $rowVat['flat_rate_after_first_year']; ?>
                                            </p>             
                                            <p>
                                                <b>Flat Rate Description : </b>
                                                <?php echo '<pre style="padding:10px;">'.$rowVat["flat_rate_description"].'</pre>';?>
                                            </p>              
                                            <p>
                                                <b>VAT Return Quarter : </b>
                                                <?php echo $rowVat['vat_return_quarter']; ?>
                                            </p>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-6">
                                            <?php
                                             // VAT Submitted Quarters For Years Array Generation  

                                            $current_date = date('Y-m-d');
                                            $vat_registered_year = date('Y', strtotime($rowVat['vat_registered_date']));
                                            $vat_registered_month = date('m', strtotime($rowVat['vat_registered_date']));
                                            $first_day_of_vat_registered_year = $vat_registered_year."-01-01";
                                            $diif_months = abs(strtotime($current_date) - strtotime($first_day_of_vat_registered_year));
                                            $no_of_diif_months = floor($diif_months / (365*60*60*2));                                                

                                            $quarter_month_values = array();
                                            if($rowVat['vat_return_quarter'] == "Jan/April/July/Oct"){
                                                $quarter_month_values = array('01','04','07','10');
                                            }else if($rowVat['vat_return_quarter'] == "Feb/May/Aug/Nov"){
                                                $quarter_month_values = array('02','05','08','11');
                                            }else if($rowVat['vat_return_quarter'] == "March/June/Sep/Dec"){
                                                $quarter_month_values = array('03','06','09','12');
                                            }else{
                                                $quarter_month_values = array();
                                            }

                                            $vat_submitted_to_hmrc_quarters_years = $quarters_years = array();

                                            for($i=0; $i<=$no_of_diif_months; $i++){

                                                $next_value =end($quarter_month_values) + 3; //next element of $quarter_month_values array generation
                                                array_push($quarter_month_values, $next_value); // next element push in $quarter_month_values array

                                                if(in_array($i, $quarter_month_values) && $i >= $vat_registered_month){
                                                    $index = date('m-Y', strtotime('+'.($i-1).' month',strtotime($first_day_of_vat_registered_year)));
                                                    $value = date('F-Y', strtotime('+'.($i-1).' month',strtotime($first_day_of_vat_registered_year)));
                                                    $vat_submitted_to_hmrc_quarters_years[$index] =  $value;
                                                }
                                            }
                                                
                                            // VAT Submitted TO HMRC Quarters Years In Database 
                                            $result1 = mysqli_query($db->db_conn, "SELECT * FROM  vats_submission_quarters_years_and_quarters_due WHERE vat_id = ". $vat_id);
                                            $quarters_years_string = $quarters_dues_string = $quarters_submitted_string = "";
                                            if(mysqli_num_rows($result1) > 0){
                                                foreach($result1 as $result1){
                                                    $quarters_years_string = $quarters_years_string.",".$result1['quarter_year'];
                                                    $quarters_dues_string = $quarters_dues_string.",".$result1['quarter_due'];
                                                    $quarters_submitted_string = $quarters_submitted_string.",".$result1['is_submitted_to_hmrc'];
                                                }
                                                substr($quarters_years_string, 1); // replace st Charecter
                                                substr($quarters_dues_string, 1); // replace st Charecter
                                                substr($quarters_submitted_string, 1); // replace st Charecter
                                                $quarters_years_in_db = explode(",", $quarters_years_string);// string to array
                                                $quarters_dues_in_db = explode(",", $quarters_dues_string);// string to array
                                                $quarters_submitted_in_db = explode(",", $quarters_submitted_string);// string to array
                                            }else{
                                               $quarters_years_in_db = $quarters_dues_in_db = $quarters_submitted_in_db = array(); 
                                            }

                                            $vat_submitted_to_hmrc_array = $vat_submitted_to_hmrc_array = array();
                                            
                                            // VAT Submitted To HMRC 
                                            if(count($vat_submitted_to_hmrc_quarters_years) > 0){
                                                $quarters_years_string = '';
                                                $quarters_count = 1;
                                                foreach($vat_submitted_to_hmrc_quarters_years as $index => $vat_sumission_quarter){
                                                    $quarters_years_string = $quarters_years_string. ",". $index;
                                                    if(count($quarters_submitted_in_db) > 0){
                                                        $quarter_submitted_in_db = $quarters_submitted_in_db[$quarters_count];
                                                    }else{
                                                        $quarter_submitted_in_db = 'No';
                                                    }  
                                                    /*echo '<p><i>'.$vat_sumission_quarter.' : </i><b>'.$quarter_submitted_in_db.'</b></p>';*/
                                                    if($quarter_submitted_in_db == 'Yes'){
                                                        $vat_submitted_to_hmrc_array[] = $vat_sumission_quarter;
                                                    }else{
                                                        $vat_due_to_hmrc_array[] = $vat_sumission_quarter;
                                                    } 
                                                    $quarters_count ++;
                                                }
                                            }
                                            // VAT Submitted To HMRC 
                                            if(count($vat_submitted_to_hmrc_array) > 0){
                                                echo '
                                                    <p>
                                                    <label>VAT Submitted To HMRC</label>
                                                    <div class="form-group"><select class="form-control">';
                                                foreach($vat_submitted_to_hmrc_array as $vat_submitted_to_hmrc_array){
                                                    echo '<option>'.$vat_submitted_to_hmrc_array.'</option>';
                                                }
                                                echo '</select></div>
                                                    </p>';
                                            }
                                            
                                            // VAT Due To HMRC 
                                            if(count($vat_due_to_hmrc_array) > 0){
                                                echo '
                                                    <p>
                                                    <label>VAT Due To HMRC</label>
                                                    <div class="form-group"><select class="form-control">';
                                                foreach($vat_due_to_hmrc_array as $vat_due_to_hmrc_array){
                                                    echo '<option>'.$vat_due_to_hmrc_array.'</option>';
                                                }
                                                echo '</select></div>
                                                    </p>';
                                            }
                                             
                                            //VAT DUE FOR QUARTERS
                                            if(count($vat_submitted_to_hmrc_quarters_years) > 0){
                                                $due_cuount = 1;
                                                foreach($vat_submitted_to_hmrc_quarters_years as $index => $vat_sumission_quarter){
                                                    if(count($quarters_dues_in_db) > 0){
                                                        $quarter_due_in_db = $quarters_dues_in_db[$due_cuount];
                                                    }else{
                                                        $quarter_due_in_db = '';
                                                    }
                                                    if($quarter_due_in_db != ""){    
                                                        echo '<p>
                                                            <b>VAT Due For Quarter '.$vat_sumission_quarter.' : </b>'.$quarter_due_in_db.'</p>';
                                                    } 
                                                    $due_cuount ++;
                                                }
                                            }
                                            ?>                    
                                            <p>
                                                <b>Notes : </b>
                                                <?php echo '<pre style="padding:10px;">'.$rowVat["notes"].'</pre>';?> 
                                            </p>                         
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-12 text-center"> 
                                            <a href="edit-company-vat.php?id=<?php echo $rowVat['id']?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                        </div>
                                        <!-- /.col-lg-12 -->
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
                <?php
                }
            }else{
                echo '<div class="error-message">No VAT Found</div>';
            }
            ?> 
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
