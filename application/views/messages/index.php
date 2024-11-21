<h2><?= $title ?></h2>
<?php foreach($messages as $message) : ?>
    <?php if($this->session->userdata('customer_id') == $message['customer_id']):?>
        <h3><?php echo $message['title']; ?></h3>
        <small class="message-date">Posted on: <?php echo $message['created_at']; ?></small><br>
        <?php echo word_limiter($message['body'], 10); ?>
        <br><br>
        <p><a href="<?php echo site_url('/messages/'.$message['slug']); ?>">Read More</a></p>
    <?php endif; ?>
<?php endforeach; ?>
<div class="pagination-links">
    <?php echo $this->pagination->create_links(); ?>
</div>