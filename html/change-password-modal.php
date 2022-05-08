<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="<?php changePassword(); ?>" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Change Password</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password"  name="pass1" 
                                       class="form-control"  
                                       placeholder="New Password" 				
                                       value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" 
                                       required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" name="pass2" class="form-control" placeholder="Confirm New Password"value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                         <input type="submit" 
                                       name="btnChangePassword" 
                                       class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
                    </div>
                </div>
            </form>
        </div><!--Close body-->
    </div><!--Close modal-body-->
</div><!-- Close modal-fade-->