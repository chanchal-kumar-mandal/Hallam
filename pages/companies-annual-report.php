<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Annual Return For Companies In 
                        <select class="btn-lg btn-group text-danger" id="annualReturnMonth" name="annual_return_month" >
                            <?php
                            foreach($months as $key => $val){
                                echo '<option value="'.$key.'" '.(($annual_return_month == $key) ? 'selected="selected"' : "").'>'.$val.'</option>';
                            } 
                            ?>
                        </select>
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
                                        if($resultCompaniesAnnual->num_rows > 0){
                                            while($row = $resultCompaniesAnnual->fetch_array()){
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
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
