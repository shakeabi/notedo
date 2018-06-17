<?php
include_once('connect.php');
include_once('functions.php');


date_default_timezone_set('Asia/Kolkata');

 ?>

<div class="col-md-4">


    <div class="well">
      <h3>Add a Task:</h3>
      <form action="task_add.php" method="post">
        <?php $_SESSION['list_id']=$list_id; ?>
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
              <button name="add_task" class="btn btn-default" type="submit" >
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
      </form>
        <br>
        <a href="delete_list.php?t_id=<?php echo $list_id ?>&u_id=<?php echo $_SESSION['curr_id'] ?>"><h4><span class="glyphicon glyphicon-trash"></span> Delete this List</h4></a>
    </div>
    <div class="well">
      <h3>Add a Collaborator:</h3>
      <form action="add_list_collab.php" method="post">
        <?php $_SESSION['list_id']=$list_id; ?>
      <div class="input-group">
          <input name="target_collab_id" type="text" class="form-control" placeholder="Enter collaborator's Id" required>
          <span class="input-group-btn">
              <button name="add_list_collab" class="btn btn-default" type="submit" >
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
      </form>
    </div>
    <div class="well">
      <h3>Collaborators:</h3><small>Click on the collaborator to remove them.</small><br>
      <?php
        $table = $_SESSION['curr_id']."task_lists";

        $query = "SELECT collabs FROM $table WHERE id = $list_id";
        $result = $connection->query($query);
        confirmQuery($result);

        $row = $result->fetch_assoc();
        $display_collab_list = explode(" ",$row['collabs']);

        $table = "users";
        foreach ($display_collab_list as $key => $value) {
            $query = "SELECT username FROM $table WHERE id = '{$value}'";
            $result = $connection->query($query);
            confirmQuery($result);
            $temp_row = $result->fetch_assoc();

            echo "<a href='delete_task_collab.php?d_id=$value'>".$temp_row['username']."</a><br>";
        }
      ?>
    </div>

</div>

</div>


<hr>
