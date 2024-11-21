<?php echo validation_errors(); ?>

<?php echo form_open('customers/forgotpassword'); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center"><?php echo $title; ?></h1><br>       
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control" name="password" placeholder=" New Password">
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm New Password">
            </div><br>
            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
        </div>
    </div>
</form>