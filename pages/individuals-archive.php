<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE requires_tax_return = 'Yes' OR on_stop = 'Yes'");
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center"><span class="text-danger">Archived</span> Individuals</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Individuals DataTable 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Telephone</th>
                                            <th>UTR</th>
                                            <th>Work Completed</th>
                                            <th class="remove-shorting-icons text-center" style="width:93px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){
                                            $individual_id = $row['id'];
                                        ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo $row["firstname"].' '.$row["surname"]; ?></td>
                                                    <td>
                                                    <?php
                                                    $resultAddress = mysqli_query($db->db_conn, "SELECT * FROM addresses where individual_id = $individual_id LIMIT 1");
                                                    while($rowAddress = $resultAddress->fetch_array()){
                                                        echo $rowAddress["address"]; 
                                                    }    
                                                    ?>                                                    
                                                    </td>
                                                    <td>
                                                    <?php 
                                                    $resultEmail = mysqli_query($db->db_conn, "SELECT * FROM emails where individual_id = $individual_id LIMIT 1");
                                                    while($rowEmail = $resultEmail->fetch_array()){
                                                        echo $rowEmail["email"]; 
                                                    }    
                                                    ?> 
                                                    </td>
                                                    <td class="center">
                                                    <?php 
                                                    $resultTelephone = mysqli_query($db->db_conn, "SELECT * FROM telephones where individual_id = $individual_id LIMIT 1");
                                                    while($rowTelephone = $resultTelephone->fetch_array()){
                                                        echo $rowTelephone["telephone"]; 
                                                    }    
                                                    ?> 
                                                    </td>
                                                    <td class="center">
                                                        <?php 
                                                            if($row['utr'] == '0'){
                                                                echo '';
                                                            }else{
                                                                echo $row['utr']; 
                                                            } 
                                                        ?>         
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        $individula_id = $row["id"];
                                                        $resultLatestTaxYearCompleted = mysqli_query($db->db_conn, "SELECT * FROM   individuals_tax_return_years WHERE individual_id = $individula_id AND tax_return_years LIKE '%$latest_tax_year%'");
                                                        if($resultLatestTaxYearCompleted->num_rows > 0){
                                                            echo "Yes";
                                                        } else{
                                                            echo "No";                     
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn-xs btn-primary" href="individual.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i> View</a> 
                                                        <a class="btn-xs btn-danger" onclick="individualLive(<?php echo $row["id"];?>)" href="javascript:void(0)"><i class="fa fa-check"></i> Live</a> 
                                                    </td>
                                                </tr>
                                            <?php
                                            }                                            
                                        }else{
                                            echo '<tr class="odd gradeA">
                                                    <td colspan="7"><div class="error-message">No data found</div></td>
                                                    <td style="display: none;"></td>
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
