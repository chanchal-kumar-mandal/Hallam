<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Companies Work Pending From 
                        <?php 
                        echo '<span class="text-danger">'.$eight_months_before_last_month.'</span> To <span class="text-danger">'.$last_month.'</span>'; 
                        ?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Companies DataTable 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Registration No</th>
                                            <th>Registration Date</th>
                                            <th>Authentication Code</th>
                                            <th>Annual Return Date</th>
                                            <th class="remove-shorting-icons text-center" style="width:93px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($resultCompaniesPending->num_rows > 0){
                                            while($row = $resultCompaniesPending->fetch_array()){

                                                $companies_id_name[] = array('id' => $row["id"], 'name' => $row["company_name"]);
                                                echo '<tr class="odd gradeA">
                                                    <td>'.$row["company_name"].'</td>
                                                    <td>'.$row["registration_number"].'</td>
                                                    <td>'.date('d-m-Y', strtotime($row["registration_date"])).'</td>
                                                    <td class="center">'.$row["authentication_code"].'</td>
                                                    <td class="text-center">'.date('d-m-Y', strtotime($row['annual_return_date'])).'</td>
                                                    <td class="text-center">
                                                        <a class="btn-xs btn-primary" href="company.php?id='.$row["id"].'"><i class="fa fa-eye"></i> View</a>
                                                    </td>
                                                </tr>';
                                            }                                            
                                        }else{
                                            echo '<tr class="odd gradeA">
                                                    <td colspan="6"><div class="error-message">No data found</div></td>
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
                <button class="btn btn-danger"  data-toggle="modal" data-target="#emailCompaniesModal"><i class="fa fa-send"></i> Send Email</button>
            </row>
            <!-- /.row -->

            <!-- Email Modal -->
            <div class="modal fade" id="emailCompaniesModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-danger">Email Send To Companies</h4>
                        </div>
                        <div class="modal-body text-left">
                            <form role="form" id="companiesEmailSubmitForm" method="post">
                                <div class="form-group">
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
                                <div class="form-group text-center"> 
                                    <button type="submit" class="btn btn-danger" name="companiesEmailSubmitButton"><i class="fa fa-send"></i> Send</button>
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
