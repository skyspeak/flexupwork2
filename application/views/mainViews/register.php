<div class="row">

    <div class="col-md-6 col-md-offset-3">

        <div class="form-error alert-danger"><?php echo validation_errors();?></div>
        <?php echo form_open("admin/register",'class="well well-lg"');?>
    <div class="form-group">
    <label for="name">Full Name:</label>
    <input type="type" class="form-control" name="name" id="name">
  </div>
      <div class="form-group">
    <label for="name">Username:</label>
    <input type="type" class="form-control" name="username" id="name">
  </div>
  <div class="form-group">
    <label for="email">Email address:</label>
    <input type="email" class="form-control" name="email" id="email">
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
    <input type="password" class="form-control" name="password" id="pwd">
  </div>
    
  <button type="submit" class="btn btn-default btn-block">Register</button>

  <?php echo form_close();?>

    </div>



</div>