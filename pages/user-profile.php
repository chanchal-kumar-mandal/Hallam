<?php 
require_once('header.php');
require_once('sidebar.php');
$resultUser = mysqli_query($db->db_conn, "SELECT * FROM users");
?>            

        <div id="page-wrapper">
            <?php 
            while($rowUser = $resultUser->fetch_assoc()){
            ?> 
                <div class="row">
                    <div class="col-lg-4  col-md-offset-4">
                        <div class="login-panel  panel panel-red">
                            <div class="panel-heading text-center"> 
                                <p>
                                </p>             
                            </div>
                            <div class="panel-body text-center">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <i class="fa fa-user fa-5x text-danger"></i>
                                        <p>
                                            <b>Admin</b>
                                        </p>             
                                        <p>
                                            <?php echo $rowUser['firstname']." ". $rowUser['surname']; ?>
                                        </p>             
                                        <p>
                                            <?php echo $rowUser['email']; ?>
                                        </p>       
                                    </div>
                                    <!-- /.col-lg-12 -->
                                    <div class="col-lg-12 text-center"> 
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#changePasswordModal"><i class="fa fa-edit"></i> Change Password</button>
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

            <!-- Change Password Modal -->
            <div class="modal fade" id="changePasswordModal" role="dialog">
                <div class="modal-dialog modal-sm">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Change Password</h4>
                        </div>
                        <div class="modal-body">
                            <form role="form" id="changeUserPasswordForm">
                                <div class="form-group">
                                    <div id="message"></div>
                                </div>
                                <fieldset>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-danger"></i></span>
                                        <input class="form-control" placeholder="Old Password" name="old_password" type="password" value="" required>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-success"></i></span>
                                        <input class="form-control" placeholder="New Password" name="new_password" type="password" value="" required>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock text-warning"></i></span>
                                        <input class="form-control" placeholder="Confirm Password" name="confirm_password" type="password" value="" required>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" id="changeUserPasswordSubmitButton" class="btn btn-sm btn-danger"><i class="fa fa-send"></i> Submit</button>
                                        <button type="reset" id="resetFormButton" class="btn btn-sm btn-warning"><i class="fa fa-refresh"></i> Reset</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <span id='changePasswordButton'></span>
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
      
                </div>
            </div>
            <!-- End Change Password Modal -->

        </div>
        <!-- /#page-wrapper -->

<?php require_once('footer.php');?>    
