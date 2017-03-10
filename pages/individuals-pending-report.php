<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Individuals Work Pending For Tax Year : <span class="text-danger"><?php echo $latest_tax_year;?><span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div> 
            <!-- /.row -->
            <!--<div class="row">
                <div class="col-lg-12">
                    <div id="message"></div>
                </div>-->
                <!-- /.col-lg-12 -->
            <!--</div>-->
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
                                            <th class="remove-shorting-icons text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $individuals_id_name = array();
                                        if($resultIndividualsPending->num_rows > 0){
                                            while($row = $resultIndividualsPending->fetch_array()){
                                            $individual_id = $row['id'];    
                                            $individuals_id_name[] = array('id' => $row["id"], 'name' => $row["firstname"].' '. $row["surname"]);
                                            ?>
                                                <tr class="odd gradeA">
                                                    <td><?php echo $row["firstname"].' '. $row["surname"];?></td>
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
                                                    <td class="center"><?php if($row['utr'] == '0'){ echo '';} else{ echo $row['utr']; }?></td>
                                                    <td class="text-center"> 
                                                        <a class="btn-xs btn-primary" href="individual.php?id=<?php echo $row["id"]; ?>"><i class="fa fa-eye"></i> View</a>
                                                    </td>
                                                </tr>
                                        <?php
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
                <button class="btn btn-danger"  data-toggle="modal" data-target="#emailIndividualsModal"><i class="fa fa-send"></i> Send Email</button>
            </row>
            <!-- /.row -->

            <!-- Email Modal -->
            <div class="modal fade" id="emailIndividualsModal" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-danger">Email Send To Individuals</h4>
                        </div>
                        <div class="modal-body text-left">
                            <form role="form" id="individulsEmailSubmitForm" method="post">  
                                <div class="form-group">
                                    <label>To</label>
                                    <div class="btn-group">
                                        <select id="individuals" name="individuals" multiple="multiple" style="display: none;">
                                        <?php 
                                        if(count($individuals_id_name) > 0){
                                            foreach($individuals_id_name as $row1){
                                                echo '<option value="'.$row1["id"].'">'.$row1["name"].'</option>';
                                            }                                            
                                        }else{
                                            echo '<option>No individuals Available</option>';
                                        }
                                        ?>
                                        </select>
                                        <button id="individuals-toggle" class="btn btn-danger">Select All</button>
                                    </div>
                                    <input type="hidden" id="individualIds" name="individualIds" value="">
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
                                    <button type="submit" class="btn btn-danger" name="individualsEmailSubmitButton"><i class="fa fa-send"></i> Send</button>
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
