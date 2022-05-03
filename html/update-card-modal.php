<div class="modal fade" id="card" tabindex="-1" role="dialog" aria-labelledby="card" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="change_card.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Change Card</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text"  name="card_number" 
                                       class="form-control"  
                                       placeholder="New Card Number" 				
                                       value="<?php if (isset($_POST['card_number'])) echo $_POST['card_number']; ?>" 
                                       required>
                    </div>
                    <div class="form-group">
                        <input type="text"  name="exp_month" 
                                       class="form-control"  
                                       placeholder="New Expire Month" 				
                                       value="<?php if (isset($_POST['exp_month'])) echo $_POST['exp_month']; ?>" 
                                       required>
                    </div>
                     <div class="form-group">
                        <input type="text" name="exp_year" 
                                       class="form-control" 
                                       placeholder="New Expore Year"
                                       value="<?php if (isset($_POST['exp_year'])) echo $_POST['exp_year']; ?>" 
                                       required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cvv" 
                                       class="form-control" 
                                       placeholder="New CVV"
                                       value="<?php if (isset($_POST['cvv'])) echo $_POST['cvv']; ?>" 
                                       required>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="submit" 
                                       name="btnChangeCard" 
                                       class="btn btn-dark btn-lg btn-block" value="Save Changes"/>
                    </div>
                </div>
            </form>
        </div><!--Close body-->
    </div><!--Close modal-body-->
</div><!-- Close modal-fade-->