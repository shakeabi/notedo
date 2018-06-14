<?php
  include_once('connect.php');
  include_once('functions.php');


  date_default_timezone_set('Asia/Kolkata');

  if(isset($_POST['add_list'])){
    $list_name = $_POST['list_name'];
    $list_time = date("l jS \of F Y h:i:s A");

    $table = $_SESSION['curr_id']."task_lists";

    $query = "INSERT INTO {$table}(listName, editTime, createTime) ";

    $query .= "VALUES('{$list_name}','{$list_time}','{$list_time}')";

    $create_note_query = $connection->query($query);

    confirmQuery($create_note_query);

    $query = "SELECT listName,id FROM $table";
    $result = $connection->query($query);

    while($row = $result->fetch_assoc()){
      $db_listName = $row['listName'];
      $db_id = $row['id'];
      if($list_name == $db_listName){
        break;
      }
    }

    $tableName_tasks = $_SESSION['curr_id'].$db_id."tasks";
    $query = "CREATE TABLE IF NOT EXISTS $tableName_tasks(
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        taskName VARCHAR(1000) NOT NULL,
        taskPriority int(11) NOT NULL,
        editTime VARCHAR(1000) NOT NULL,
        createTime VARCHAR(1000) NOT NULL
        )";
    $connection->query($query);
  }

?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Add a List</h4>
        <form action="" method="post">
        <div class="input-group">
            <input name="list_name" type="text" class="form-control">
            <span class="input-group-btn">
                <button name="add_list" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-plus"></span>
            </button>
            </span>
        </div>
        </form><!--search form-->
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Labels</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <li><a href="#">Category Name<span class="label label-default">New</span></a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>

</div>
<!-- /.row -->

<hr>
