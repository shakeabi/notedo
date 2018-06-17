<?php
include_once('connect.php');
include_once('functions.php');


date_default_timezone_set('Asia/Kolkata');

 ?>

<div class="col-md-4">


    <div class="well">
      <h3>Add a Task:</h3>
      <form action="collab_task_add.php" method="post">
      <div class="input-group">
          <input name="task_name" type="text" class="form-control" required>
          <select name="task_priority" class="form-control" id="" required>
             <option value="" selected disabled hidden>Priority</option>
             <option value='1'>1</option>
             <option value='2'>2</option>
             <option value='3'>3</option>
             <option value='4'>4</option>
             <option value='5'>5</option>

          </select>
          <span class="input-group-btn">
              <button name="collab_add_task" class="btn btn-default" type="submit" >
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
      </form>
        <br>
        <a href="delete_list.php?t_id=<?php echo $collab_l_id ?>&u_id=<?php echo $collab_u_id ?>"><h4><span class="glyphicon glyphicon-trash"></span> Delete this List</h4></a>
    </div>


</div>

</div>


<hr>
