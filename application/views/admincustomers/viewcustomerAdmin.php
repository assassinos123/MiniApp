<?php if(!$this->session->userdata('adminlogged_in')): ?>
    <?php echo redirect('admin/loginAdmin'); ?>
<?php endif; ?>

<h2><?= $title ?></h2>
<small class="message-date">Name: <?php echo $message['name']; ?></small>
<small class="message-date">Last Name: <?php echo $message['lastname']; ?></small>
<small class="message-date">Email: <?php echo $message['email']; ?></small><br><br>

<?php echo form_open('/admincustomers/delete/'.$message['id']); ?>
        <input type="submit" value="Delete Customer" class="btn btn-danger">
</form>

<?php echo form_open('/admincustomers/editcustomerAdmin/'.$message['id']); ?>
        <input type="submit" value="Edit Customer" class="btn btn-success">
</form>

<?php echo form_open('/admincustomers/showcustomermessagesAdmin/'.$message['id']); ?>
        <input type="submit" value="Show Customer's Messages" class="btn btn-success">
</form>
