<div class="row">

    <div class="col-md-6 col-md-offset-3">
        <div class="form-error alert-danger"><?php echo validation_errors();?></div>
        <?php echo form_open("admin/login",'class="well well-lg"');?>
  <div class="form-group">
    <label for="username">Username:</label>
    <input type="text" class="form-control" name="username" id="username">
  </div>
  <div class="form-group">
    <label for="password">Password:</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <button type="submit" class="btn btn-default btn-block">Login</button>
<?php echo form_close();?>

    </div>



</div>