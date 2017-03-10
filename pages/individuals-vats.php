<?php 
require_once('header.php');
require_once('sidebar.php');
$result = mysqli_query($db->db_conn, "SELECT * FROM vats WHERE individual_id IS NOT NULL");
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Individuals VAT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Individuals VAT DataTable
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
                                            <th>Individual</th>
                                            <th class="remove-shorting-icons text-center" style="width:150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){
                                                ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo $row["vat_number"]; ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($row["vat_registered_date"])); ?></td>
                                                    <td><?php echo $row["vat_flat_rate"]; ?></td>
                                                    <td><?php echo $row["vat_return_quarter"]; ?></td>
                                                    <?php
                                                    
                                                        $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = ".$row["individual_id"]);
                                                        if($resultIndividual->num_rows > 0){
                                                            while($rowIndividual = $resultIndividual->fetch_assoc()){
                                                                echo '<td class="text-center"><a href="individual.php?id='.$rowIndividual["id"].'" target="_blank"> '.$rowIndividual["firstname"].' '. $rowIndividual["surname"].'</a></td>';
                                                            }
                                                        }else{
                                                            echo '<td class="text-center"><div class="error-message">No Individual</div></td>';
                                                        }
                                                        ?>
                                                        <td class="text-center">
                                                            <a class="btn-xs btn-warning" href="edit-individual-vat.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit"></i> Edit</a>
                                                            <a class="btn-xs btn-primary" href="individual-vat.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i> View</a>
                                                            <a class="btn-xs btn-danger" onclick="deleteContent(<?php echo $row["id"]; ?>, 'individual-vat')" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
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
