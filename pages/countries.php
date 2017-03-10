<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM countries ORDER BY name");
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Countries</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Countries DataTable
                            <a href="add-country.php" class="btn btn-xs btn-danger pull-right"><i class="fa fa-plus"></i> Add Country</a> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Country</th>
                                            <th class="remove-shorting-icons text-center" style="width:150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){
                                        ?>
                                            <tr class="odd gradeA">
                                                <td><?php echo  $row["name"];?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn-xs btn-warning" href="edit-country.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit"></i> Edit</a>
                                                    <a class="btn-xs btn-primary" href="country.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i> View</a>
                                                    <a class="btn-xs btn-danger" onclick="deleteContent(<?php echo $row["id"]; ?>, 'country')" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                            }                                            
                                        }else{
                                            echo '<tr class="odd gradeA">
                                                    <td colspan="2"><div class="error-message">No data found</div></td>
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
