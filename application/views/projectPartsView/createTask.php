
<div class="row">

    <div class="col-md-6 col-md-offset-3">

            <div class="form-error alert-danger"><?php echo validation_errors();?></div>
        <?php if(isset($createError)):?>
               
        <div class="form-error alert-danger"><?php $createError['msg']?></div>

        <?php endif;?>

        <?php echo form_open("admin/projects/parts/add/". $project_id ."/".$part_id."/". $post_type ,'class="well well-lg"');?>
  <div class="form-group">
    <label for="task_name">Task Name:</label>
    <input type="text" class="form-control" name="task_name" id="name">
  </div>
  <div class="form-group">
    <label for="details">Task Details:</label>
    <textarea class="form-control" id="details" name="task_details"></textarea>
  </div>

  <button type="submit" class="btn btn-default btn-block">Create</button>
<?php echo form_close();?>

    </div>



</div>