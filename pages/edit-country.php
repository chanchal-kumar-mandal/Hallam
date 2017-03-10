<?php 
require_once('header.php');
require_once('sidebar.php');
$country_id = $_REQUEST['id'];
$resultCountry = mysqli_query($db->db_conn, "SELECT * FROM countries WHERE id = " . $country_id);
?>            

        <div id="page-wrapper">
        <?php
        if($resultCountry->num_rows > 0){ 
            while($rowCountry = $resultCountry->fetch_assoc()){
            ?>            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Edit Country : <span class="text-danger"><?php echo $rowCountry['name']; ?></span></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="editCountryForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading text-center">
                                Country Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6 col-lg-offset-3">
                                        <div class="form-group"> 
                                            <label>Notes</label> 
                                            <input type="text" class="form-control" name="name" value="<?php echo $rowCountry['name'];?>" required/>
                                        </div>
                                        <input type="hidden" name="country_id" value="<?php echo $country_id;?>">  
                                        <div class="col-lg-12 text-center">
                                            <button type="submit" id="editCountrySubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                        </div>
                                        <!-- /.col-lg-12 --> 
                                    </div>
                                    <!-- /.col-lg-6 -->
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
            </form><!-- /.form --> 
            <?php
            }
        }else{
            echo '<div class="error-message">No Country Found.</div>';
        }
        ?>

            <?php require_once('modals-page.php');?>

        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
