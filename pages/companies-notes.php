<?php 
require_once('header.php');
require_once('sidebar.php');
$resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies ORDER BY company_name");
if(isset($_REQUEST['company_id'])){
    $company_id = $_REQUEST['company_id'];
    if($company_id != ""){
        $query_string = " WHERE company_id = " . $_REQUEST['company_id'];
    }else{
        $query_string = " WHERE company_id IS NOT NULL";
    }
}else{
    $company_id = "";
    $query_string = " WHERE company_id IS NOT NULL";
}
$result = mysqli_query($db->db_conn, "SELECT * FROM notes" . $query_string);
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Companies Notes For : 
                        <select class="btn-lg btn-group text-danger" id="notesForCompany" name="notes_for_company" >
                        <option value="">All</option>
                        <?php
                        if($resultCompany->num_rows > 0){
                            while($rowCompany = $resultCompany->fetch_array()){
                                echo '<option value="'.$rowCompany["id"].'" '.(($company_id == $rowCompany["id"]) ? 'selected="selected"' : "").'>'.$rowCompany["company_name"].'</option>';
                            }                                            
                        }else{
                            echo '<option value="">No Company Available</option>';
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
                            Companies Notes DataTable
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Created Date</th>
                                            <th>Created Time</th>
                                            <th>Note</th>
                                            <th class="text-center">Company</th>
                                            <th class="remove-shorting-icons text-center" style="width:150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_array()){
                                                ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo date('d-m-Y', strtotime($row["note_creation_date"])); ?></td>
                                                    <td><?php echo date('h:i:s a', strtotime($row["note_creation_date"])); ?></td>
                                                    <td><?php echo substr($row["note"], 0, 40)."..."; ?></td>
                                                    <?php

                                                        $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = ".$row["company_id"]);   
                                                        if($resultCompany->num_rows > 0){
                                                            while($rowCompany = $resultCompany->fetch_assoc()){
                                                                echo '<td class="text-center"><a href="company.php?id='.$rowCompany["id"].'" target="_blank"> '.$rowCompany["company_name"].'</a></td>';

                                                            }
                                                        }else{
                                                            echo '<td class="text-center"><div class="error-message">No Company</div></td>';
                                                        }
                                                    ?>
                                                    <td class="text-center">
                                                        <a class="btn-xs btn-warning" href="edit-note.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-edit"></i> Edit</a>
                                                        <a class="btn-xs btn-primary" href="note.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i> View</a>
                                                        <a class="btn-xs btn-danger" onclick="deleteContent(<?php echo $row["id"]; ?>, 'note')" href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
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
