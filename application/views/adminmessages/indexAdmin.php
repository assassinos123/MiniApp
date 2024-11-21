<h2><?= $title ?></h2>

<?php foreach($messages as $message) : ?>
    <h3><?php echo $message['title']; ?></h3>
    <small class="message-date">Posted on: <?php echo $message['created_at']; ?></small><br>
    <?php echo word_limiter($message['body'], 10); ?>
    <br><br>
    <p><a href="<?php echo site_url('/adminmessages/'.$message['slug']); ?>">Read More</a></p>
<?php endforeach; ?>
<div class="pagination-links">
    <?php echo $this->pagination->create_links(); ?>
</div>