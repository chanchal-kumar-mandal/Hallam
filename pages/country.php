<?php 
require_once('header.php');
require_once('sidebar.php');
$country_id = $_REQUEST['id'];
$resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries where id = ". $country_id);
?>            

        <div id="page-wrapper">
            <?php 
            while($rowCountry = $resultCountry->fetch_assoc()){
            ?>           
               <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Country</h1>
                </div>
                <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-6  col-lg-offset-3">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center">
                                    Country Informations
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">         
                                            <p>
                                                <b>Country Name : </b>
                                                <?php echo $rowCountry["name"]; ?>
                                            </p>               
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
                ?> 
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
