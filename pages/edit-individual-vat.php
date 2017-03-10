<?php 
require_once('header.php');
require_once('sidebar.php');
$vat_id = $_REQUEST['id'];
$resultVat = mysqli_query($db->db_conn, "SELECT * FROM vats WHERE id = ". $vat_id);
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Edit Individual VAT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="editIndividualVatForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                Individual VAT Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6">
                                        <?php
                                        while($rowVat = $resultVat->fetch_assoc()){
                                        ?>
                                            <input type="hidden" name="vat_id" value="<?php echo $rowVat["id"]; ?>">
                                            <div class="form-group">
                                                <label>Individual</label>
                                                <select  class="form-control" name="individual_id" required autofocus>
                                                    <option value="">Select Individual</option>
                                                <?php
                                                $result = mysqli_query($db->db_conn, "SELECT * FROM individuals");
                                                if($result->num_rows > 0){
                                                    while($row = $result->fetch_array()){
                                                        echo '<option value="'.$row["id"].'" '.(($row["id"] == $rowVat["individual_id"])? "selected" : "").'>'.$row["firstname"].' '. $row["surname"].'</option>';
                                                    }                                            
                                                }else{
                                                    echo '<option value="">No Individual Available</option>';
                                                }
                                                ?>
                                                </select>
                                            </div>                    
                                            <div class="form-group">
                                                <label>VAT Number</label>
                                                <input type="text" class="form-control" name="vat_number" value="<?php echo $rowVat['vat_number'];?>" required >
                                            </div> 
                                            <label>VAT Registered Date</label>              
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i>
                                                </span>
                                                <input type="text" id="vatRegisteredDate" class="form-control" name="vat_registered_date" value="<?php echo date('d-m-Y', strtotime($rowVat['vat_registered_date']));?>" required>
                                            </div>                 
                                            <div class="form-group">
                                                <label>VAT Flat Rate</label>
                                                <select class="form-control" name="vat_flat_rate" required>
                                                    <option <?php if($rowVat['vat_flat_rate'] == "Yes"){ echo "selected";}?>>Yes</option>
                                                    <option <?php if($rowVat['vat_flat_rate'] == "No"){ echo "selected";}?>>No</option>
                                                </select>
                                            </div> 
                                            <label>Flat Rate First Year</label>            
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="flat_rate_first_year" value="<?php echo $rowVat['flat_rate_first_year'];?>">
                                                <span class="input-group-addon">%</i>
                                            </div> 
                                            <label>Flat Rate After First Year</label>              
                                            <div class="form-group input-group">
                                                <input type="text" class="form-control" name="flat_rate_after_first_year" value="<?php echo $rowVat['flat_rate_after_first_year'];?>">
                                                <span class="input-group-addon">%</i>
                                            </div>               
                                            <div class="form-group">
                                                <label>Flat Rate Description</label>
                                                <textarea class="form-control" name="flat_rate_description" rows="3"><?php echo $rowVat['flat_rate_description'];?></textarea>
                                            </div>                    
                                            <div class="form-group">
                                                <label>VAT Return Quarter</label>
                                                <select class="form-control" name="vat_return_quarter" required>
                                                    <option <?php if($rowVat['vat_return_quarter'] == "Jan/April/July/Oct"){ echo "selected";}?>>Jan/April/July/Oct</option>
                                                    <option <?php if($rowVat['vat_return_quarter'] == "Feb/May/Aug/Nov"){ echo "selected";}?>>Feb/May/Aug/Nov</option>
                                                    <option <?php if($rowVat['vat_return_quarter'] == "March/June/Sep/Dec"){ echo "selected";}?>>March/June/Sep/Dec</option>
                                                </select>
                                            </div>
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
                                                $quarters_years_string = substr($quarters_years_string, 1); // replace 1st Charecter
                                                $quarters_dues_string = substr($quarters_dues_string, 1); // replace 1st Charecter
                                                $quarters_submitted_string = substr($quarters_submitted_string, 1); // replace 1st Charecter
                                                $quarters_years_in_db = explode(",", $quarters_years_string);// string to array
                                                $quarters_dues_in_db = explode(",", $quarters_dues_string);// string to array
                                                $quarters_submitted_in_db = explode(",", $quarters_submitted_string);// string to array
                                            }else{
                                               $quarters_years_in_db = $quarters_dues_in_db = $quarters_submitted_in_db = array(); 
                                            }
                                            
                                            // VAT Submitted To HMRC Checkbox Generation
                                            if(count($vat_submitted_to_hmrc_quarters_years) > 0){
                                                echo '
                                                <div class="form-group input-group">
                                                <label>VAT Submitted To HMRC</label>';
                                                $quarters_years_string = '';
                                                $quarters_count = 0;
                                                foreach($vat_submitted_to_hmrc_quarters_years as $index => $vat_sumission_quarter){
                                                    $quarters_years_string = $quarters_years_string. ",". $index;
                                                    if(count($quarters_submitted_in_db) > 0){
                                                        if(array_key_exists($quarters_count, $quarters_submitted_in_db)){
                                                            $quarter_submitted_in_db = $quarters_submitted_in_db[$quarters_count];
                                                        }else{
                                                            $quarter_submitted_in_db = 'No';
                                                        } 
                                                    }else{
                                                        $quarter_submitted_in_db = 'No';
                                                    }  
                                                    echo '<div class="checkbox"><label><input type="checkbox" name="quarters_years[]" value="'.$index.'" '.(($quarter_submitted_in_db == 'Yes')? 'checked="checked"' : "").'>'.$vat_sumission_quarter.'</label></div>'; 
                                                    $quarters_count ++;
                                                }
                                                echo '</div>
                                                <input type="hidden" name="quarters_years_string" value="'.substr($quarters_years_string, 1).'">';
                                            }
                                             
                                            //INPUT BOX GENERATION FOR VAT DUE FOR QUARTERS
                                            if(count($vat_submitted_to_hmrc_quarters_years) > 0){
                                                $due_cuount = 0;
                                                foreach($vat_submitted_to_hmrc_quarters_years as $index => $vat_sumission_quarter){
                                                    if(count($quarters_dues_in_db) > 0){
                                                        if(isset($quarters_dues_in_db[$due_cuount])){
                                                            $quarter_due_in_db = $quarters_dues_in_db[$due_cuount];
                                                        }else{
                                                            $quarter_due_in_db = '';
                                                        }
                                                    }else{
                                                        $quarter_due_in_db = '';
                                                    }    
                                                    echo '
                                                        <label>VAT Due For Quarter '.$vat_sumission_quarter.'</label>
                                                        <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-gbp"></i>
                                                        </span>
                                                        <input type="number" class="form-control" name="quarter_due_'.$index.'" '.(($quarter_due_in_db != "")? 'value="'.$quarter_due_in_db.'"' : 'placeholder="Enter VAT Due For Quarter '.$vat_sumission_quarter.'"') .' >
                                                        </div> '; 
                                                    $due_cuount ++;
                                                }
                                            }
                                            ?>                          
                                            <div class="form-group"> 
                                                <label>Notes</label> 
                                                <textarea class="form-control" name="notes" rows="3"><?php echo $rowVat['notes'];?></textarea>
                                            </div>        
                                        </div>
                                        <!-- /.col-lg-6 --> 
                                        <div class="col-lg-12 text-center">            
                                            <button type="submit" id="editIndividualVatSubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                        </div>
                                        <!-- /.col-lg-12 --> 
                                    <?php
                                    }
                                    ?>
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
