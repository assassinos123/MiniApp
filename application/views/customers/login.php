<?php echo form_open('customers/login'); ?>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center"><?php echo $title; ?></h1><br>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required autofocus>     
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>     
            </div><br>
            <button type="submit" class="btn btn-primary btn-block">Login</button><br>           
            <a href="<?php echo base_url(); ?>customers/forgotpassword">Forgot Password?</a>
        </div>
    </div>
<?php echo form_close(); ?>