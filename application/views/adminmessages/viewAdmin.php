<?php if(!$this->session->userdata('adminlogged_in')): ?>
    <?php echo redirect('admin/loginAdmin'); ?>
<?php endif; ?>

<h2><?php echo $message['title']; ?></h2>

<small class="message-date">Posted on: <?php echo $message['created_at']; ?></small><br>
<div class="message-body">
    <?php echo $message['body']; ?>
</div><br>
<small class="message-date">Name: <?php echo $message['name']; ?></small>
<small class="message-date">Last Name: <?php echo $message['lastname']; ?></small>
<small class="message-date">Email: <?php echo $message['email']; ?></small><br>