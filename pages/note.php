<?php 
require_once('header.php');
require_once('sidebar.php');
$note_id = $_REQUEST['id'];
$resultNote = mysqli_query($db->db_conn, "SELECT * FROM notes where id = ". $note_id);
?>            

        <div id="page-wrapper">
        <?php          
        if($resultNote->num_rows > 0){ 
            while($rowNote = $resultNote->fetch_assoc()){
            ?>           
               <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Note</h1>
                </div>
                <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    Note Informations
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p>
                                                <?php
                                                if($rowNote['individual_id'] != ""){
                                                    echo '<b>Individual : </b>';
                                                    $resultIndividual = mysqli_query($db->db_conn, "SELECT * FROM individuals WHERE id = " . $rowNote['individual_id']);
                                                    if($resultIndividual->num_rows > 0){
                                                        while($rowIndividual =$resultIndividual->fetch_assoc()){
                                                            echo  '<a href="individual.php?id='.$rowIndividual["id"].'" target="_blank">'.$rowIndividual["firstname"].' '.$rowIndividual["surname"].'</a>';
                                                        }
                                                    }else{
                                                        echo '<span class="">No Individual Found</span>';
                                                    }
                                                }else{
                                                    echo '<b>Company : </b>';
                                                    $resultCompany = mysqli_query($db->db_conn, "SELECT * FROM companies WHERE id = " . $rowNote['company_id']);
                                                    if($resultCompany->num_rows > 0){
                                                        while($rowCompany =$resultCompany->fetch_assoc()){
                                                            echo  '<a href="company.php?id='.$rowCompany["id"].'" target="_blank">'.$rowCompany["company_name"].'</a>';
                                                        }
                                                    }else{
                                                        echo '<span class="">No Comapny Found</span>';
                                                    }
                                                }
                                                ?> 
                                            </p>              
                                            <p>
                                                <b>Note Creation Date : </b>
                                                <?php echo date('d-m-Y', strtotime($rowNote['note_creation_date'])); ?>
                                            </p>             
                                            <p>
                                                <b>Note Creation Time : </b>
                                                <?php echo date('h:i:s a', strtotime($rowNote['note_creation_date'])); ?>
                                            </p>          
                                            <p>
                                                <b>Note : </b>
                                                <?php echo '<pre style="padding:10px;">'.$rowNote["note"].'</pre>'; ?>
                                            </p>               
                                        </div>
                                        <!-- /.col-lg-12 -->
                                        <div class="col-lg-12 text-center"> 
                                            <a href="edit-note.php?id=<?php echo $rowNote['id']?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                                        </div>
                                        <!-- /.col-lg-12 -->
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
                <?php
                }
            }else{
                echo '<div class="error-message">No Note Found</div>';
            }
            ?> 
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
