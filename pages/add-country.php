<?php 
require_once('header.php');
require_once('sidebar.php');
?>            

        <div id="page-wrapper">            
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">Add Country</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <form role="form" id="addCountryForm">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-success">
                            <div class="panel-heading text-center">
                                Country Form Elements
                            </div>
                            <div class="panel-body">
                                <div class="row">                                    
                                    <div class="col-lg-6 col-lg-offset-3">                
                                        <div class="form-group"> 
                                            <label>Country</label> 
                                            <input type="text" class="form-control" name="name" placeholder="Enter Country" required>
                                        </div> 
                                        <div class="col-lg-12 text-center">            
                                            <button type="submit" id="addCountrySubmitButton" class="btn btn-danger"><i class="fa fa-send"></i> Submit</button>
                                            <button type="reset" id="resetFormButton" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
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

            <?php require_once('modals-page.php');?>
            
        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
