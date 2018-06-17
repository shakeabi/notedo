<?php
  include_once('connect.php');
  include_once('functions.php');


  date_default_timezone_set('Asia/Kolkata');

?>

<div class="col-md-4">

    <div class="well">
        <h4>Add a List</h4>
        <form action="list_add.php" method="post">
        <div class="input-group">
            <input name="list_name" type="text" class="form-control" required>
            <span class="input-group-btn">
                <button name="add_list" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-plus"></span>
            </button>
            </span>
        </div>
        </form>

    </div>
    <div class="well">
        <h4>Collaborating on:</h4>
        <?php

          $table = $_SESSION['curr_id']."list_collabs";

          $query = "SELECT * FROM {$table} ORDER BY createTime DESC";
          $result = $connection->query($query);
          confirmQuery($result);

          while($row = $result->fetch_assoc()){
            $temp_collab_id = $row['collabId'];
            $temp_list_id = $row['listId'];

            $table = $temp_collab_id."task_lists";

            $query = "SELECT listName FROM {$table} WHERE id = $temp_list_id";
            $result = $connection->query($query);
            confirmQuery($result);
            $row = $result->fetch_assoc();

            $display_list_name = $row['listName'];

            $table = "users";

            $query = "SELECT username FROM {$table} WHERE id = $temp_collab_id";
            $result = $connection->query($query);
            confirmQuery($result);
            $row = $result->fetch_assoc();

            $display_collab_name = $row['username'];
            ?>

            <p>
              <?php echo "<a href='collab_task_view.php?collab_u_id=$temp_collab_id&collab_l_id=$temp_list_id'>".$display_list_name."</a> by: ".$display_collab_name."<br>" ?>
            </p>

        <?php
          }

        ?>


    </div>

</div>

</div>


<hr>
