<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('messages/create'); ?>
  <div class="mb-3">
    <label>Subject</label>
    <input type="text" class="form-control" name="title">
  </div><br>
  <div class="mb-3">
    <label>Text Area</label>
    <textarea class="form-control" name="body" placeholder="Add Text"></textarea>
  </div><br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>