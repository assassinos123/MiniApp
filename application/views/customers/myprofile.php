<?php echo validation_errors(); ?>

<?php echo form_open('customers/myprofile'); ?>
  <input type="hidden" name="id" value="<?php echo $this->session->userdata('customer_id'); ?>">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h1 class="text-center"><?= $title; ?></h1>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $this->session->userdata('name'); ?>">
            </div>
            <div class="form-group">
                <label> Last Name</label>
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $this->session->userdata('lastname') ?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $this->session->userdata('email') ?>">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Udpate</button>
        </div>
    </div>
<?php echo form_close(); ?>
