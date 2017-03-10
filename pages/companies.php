<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM companies");
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Companies</h1>
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
                                            <th class="remove-shorting-icons text-center" style="width:150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){
                                                ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo $row["company_name"]?></td>
                                                    <td><?php echo $row["registration_number"]?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($row["registration_date"]))?></td>
                                                    <td class="center"><?php echo $row["authentication_code"]?></td>
                                                    <td class="text-center"><?php echo date('d-m-Y', strtotime($row['annual_return_date']))?></td>
                                                    <td class="text-center">
                                                        <a class="btn-xs btn-warning" href="edit-company.php?id=<?php echo $row["id"]?>"><i class="fa fa-edit"></i> Edit</a>
                                                        <a class="btn-xs btn-primary" href="company.php?id=<?php echo $row["id"]?>"><i class="fa fa-eye"></i> View</a>
                                                        <a class="btn-xs btn-danger" onclick="deleteContent(<?php echo $row["id"]; ?>, 'company')" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
                                                    </td>
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

            <?php require_once('modals-page.php');?> 

        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
