<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">VAT Pending For Companies For Quarter : <span class="text-danger"><?php echo $vat_return_quarter;?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Companies VAT DataTable
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>VAT Number</th>
                                            <th>VAT Registered Date</th>
                                            <th>VAT Flat Rate</th>
                                            <th>VAT Return Quarter</th>
                                            <th>Company</th>
                                            <th class="remove-shorting-icons text-center" style="width:93px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($resultCompaniesVatsPending->num_rows > 0){
                                            while($row = $resultCompaniesVatsPending->fetch_array()){
                                                ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo $row["vat_number"]; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($row["vat_registered_date"])); ?></td>
                                                    <td><?php echo $row["vat_flat_rate"]; ?></td>
                                                    <td><?php echo $row["vat_return_quarter"]; ?></td>
                                                    <?php
                                                    if($row["company_id"]){
                                                        $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = ".$row["company_id"]);
                                                        while($rowCompany = $resultCompany->fetch_assoc()){

                                                            $companies_id_name[] = array('id' => $rowCompany["id"], 'name' => $rowCompany["company_name"]);
                                                            echo '<td class="text-center"><a href="company.php?id='.$rowCompany["id"].'" target="_blank"> '.$rowCompany["company_name"].'</a></td>
                                                            <td class="text-center">
                                                                <a class="btn-xs btn-primary" href="company-vat.php?id='.$row["id"].'"><i class="fa fa-eye"></i> View</a>
                                                            </td>';
                                                        }
                                                    }
                                                    ?>
                                                </tr>
                                            <?php
                                            }                                            
                                        }else{
                                            echo '<tr class="odd gradeA">
                                                    <td colspan="6"><div class="error-message">No data found</div></td>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;"></td>
                                                    <td style="display: none;"></td>
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
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <div class="row text-center">
                <button class="btn btn-danger"  data-toggle="modal" data-target="#emailCompaniesVatsModal"><i class="fa fa-send"></i> Send Email</button>
            </row>
            <!-- /.row -->

            <!-- Email Modal -->
            <div class="modal fade" id="emailCompaniesVatsModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-danger">Email Send To Companies</h4>
                        </div>
                        <div class="modal-body text-left">
                            <form role="form" id="companiesVatsEmailSubmitForm" method="post">
                                <div class="form-group">  
                                    <!-- Companies Dropdown -->
                                    <label>To</label>
                                    <div class="btn-group">
                                        <select id="companies" name="companies" multiple="multiple" style="display: none;">          
                                        <?php 
                                        if(count($companies_id_name) > 0){
                                            foreach($companies_id_name as $row1){
                                                echo '<option value="'.$row1["id"].'">'.$row1["name"].'</option>';
                                            }                                            
                                        }else{
                                            echo '<option>No companies Available</option>';
                                        }
                                        ?>
                                        </select>
                                        <button id="companies-toggle" class="btn btn-danger">Select All</button>
                                    </div>
                                    <input type="hidden" id="companyIds" name="companyIds" value="">
                                </div>                     
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" name="subject" placeholder="Enter Subject" required>
                                </div>                                        
                                <div class="form-group"> 
                                    <label>Message</label> 
                                    <textarea class="form-control" name="message" rows="15" placeholder="Enter Message" required></textarea>
                                </div>                      
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="datetime" value="<?php echo date('Y-m-d h:i:s');?>">
                                </div>
                                <input type="hidden" name="quarter_year" value="<?php echo $last_month_quarter_year; ?>">  
                                <div class="form-group text-center"> 
                                    <button type="submit" class="btn btn-danger" name="companiesVatsEmailSubmitButton"><i class="fa fa-send"></i> Send</button>
                                </div>                                   
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /#Email Modal -->

            <?php require_once('modals-page.php');?>
            
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
