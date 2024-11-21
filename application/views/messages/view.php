<?php if(!$this->session->userdata('logged_in')): ?>
    <?php echo redirect('customers/login'); ?>
<?php endif; ?>

<?php if($this->session->userdata('customer_id') == $message['customer_id']):?>
    <h2><?php echo $message['title']; ?></h2>
    <small class="message-date">Posted on: <?php echo $message['created_at']; ?></small><br>
    <div class="message-body">
        <?php echo $message['body']; ?>
    </div>
<?php endif; ?>

<?php if($this->session->userdata('customer_id') == $message['customer_id']):?>
    <hr>
    <?php echo form_open('/messages/delete/'.$message['id']); ?>
        <input type="submit" value="Delete" class="btn btn-danger">
    </form>
<?php endif; ?>