<?php if(!$this->session->userdata('adminlogged_in')): ?>
    <?php echo redirect('admin/loginAdmin'); ?>
<?php endif; ?>

<h2><?= $title ?></h2>

<?php foreach($messages as $message) : ?>
    <h3><?php echo $message['lastname']; ?></h3>
    <p><a href="<?php echo site_url('/admincustomers/'.$message['lastname']); ?>">See More</a></p>
<?php endforeach; ?>