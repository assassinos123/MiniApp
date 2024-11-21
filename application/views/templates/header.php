<html>
    <head>
        <title>App</title>
        <link rel="stylesheet" href="https://bootswatch.com/3/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    </head>
    <body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">App</a>
            </div>
            <div id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><a href="<?php echo base_url(); ?>about">About</a></li>                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php if(!$this->session->userdata('logged_in') AND (!$this->session->userdata('adminlogged_in'))): ?>
                    <li><a href="<?php echo base_url(); ?>customers/login">Log in</a></li>
                    <li><a href="<?php echo base_url(); ?>admin/loginAdmin">Log in Admin</a></li>
                    <li><a href="<?php echo base_url(); ?>customers/register">Registration</a></li>
                <?php endif; ?>
                <?php if($this->session->userdata('logged_in')): ?>
                    <li><a href="<?php echo base_url(); ?>customers/myprofile">My Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>messages">Messages</a></li>
                    <li><a href="<?php echo base_url(); ?>messages/create">Submit New Message</a></li>
                    <li><a href="<?php echo base_url(); ?>customers/logout">Log out</a></li>
                <?php endif; ?>
                <?php if($this->session->userdata('adminlogged_in')): ?>
                    <li><a href="<?php echo base_url(); ?>admin/myprofile">My Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>adminmessages">All Message History</a></li>
                    <li><a href="<?php echo base_url(); ?>admincustomers">All Customers</a></li>  
                    <li><a href="<?php echo base_url(); ?>admin/logoutAdmin">Log out</a></li>
                <?php endif; ?> 
                </ul>
            </div>
        </div>
    </nav>        

    <div class="container">
        <!--Flash Messages-->
        <?php if($this->session->flashdata('failed_email')): ?>
            <?php echo '<p class="alert alert alert-danger">'.$this->session->flashdata('failed_email').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('customer_registered')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('customer_registered').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('message_sent')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('message_sent').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('message_deleted')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('message_deleted').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('login_failed')): ?>
            <?php echo '<p class="alert alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('customer_loggedin')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('customer_loggedin').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('customer_loggedout')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('customer_loggedout').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('customer_updated')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('customer_updated').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('admin_loggedin')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('admin_loggedin').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('admin_loggedout')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('admin_loggedout').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('admin_updated')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('admin_updated').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('customer_deleted')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('customer_deleted').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('customerprofile_updated')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('customerprofile_updated').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('failed_sending_email')): ?>
            <?php echo '<p class="alert alert alert-danger">'.$this->session->flashdata('failed_sending_email').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('success_sending_email')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('success_sending_email').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('link_expired')): ?>
            <?php echo '<p class="alert alert alert-danger">'.$this->session->flashdata('link_expired').'</p>'; ?>
        <?php endif; ?>

        <?php if($this->session->flashdata('resetpass')): ?>
            <?php echo '<p class="alert alert alert-success">'.$this->session->flashdata('resetpass').'</p>'; ?>
        <?php endif; ?>
      