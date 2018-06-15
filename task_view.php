<?php
  include_once('connect.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}
  $flag = 0;
    if(isset($_GET['t_id'])){
        $t_id = $_GET['t_id'];
    }


    $table = $_SESSION['curr_id'].'task_lists';

    $query = "SELECT * FROM $table WHERE id = $t_id";
    $result = $connection->query($query);
    confirmQuery($result);

      $row = $result->fetch_assoc();
      $list_id     = $row['id'];
      $list_title     = $row['listName'];
      $list_e_time    = $row['editTime'];
      $list_c_time    = $row['createTime'];




 ?>
<?php include_once('includes_t/header.php'); ?>

    <!-- Navigation -->
    <?php include_once('includes_t/navigation.php') ?>
    <!-- Content -->
    <div class="container">

        <div class="row">

            <!-- Task View -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1><?php echo $list_title; ?></h1>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $list_c_time; ?></p>
                <p><span class="glyphicon glyphicon-time"></span> Edited on <?php echo $list_e_time; ?></p>

                <hr>
                <!-- Content -->

<!-- /////////////////insert-tasks-here//////// -->
                <form action="list_update.php" method="post">
                  <?php $_SESSION['list_id']=$list_id; ?>
                <?php
                    $table = $_SESSION['curr_id'].$list_id.'tasks';

                    $query = "SELECT * FROM $table ORDER BY checked ASC,taskPriority DESC,createTime DESC";
                    $result = $connection->query($query);
                    confirmQuery($result);
                    while($row = $result->fetch_assoc()){
                      $flag = 1;
                      $task_id = $row['id'];
                      $task_name     = $row['taskName'];
                      $task_checked    = $row['checked'];
                      $task_list_c_time    = $row['createTime'];
                 ?>
                 <div class="form-check">
                     <input type="checkbox" class="form-check-input" id="task" name="<?php echo $task_id ?>" <?php if($task_checked == '1'){echo "checked";} ?> >
                     <label for="task"><?php echo $task_name; ?></label>
                 </div>

                 <?php
                    }
                  ?>
                  <div>
                    <button type="submit" name="update_list" class="btn btn-primary">Update</button>
                  </div>
                  </form>
                <hr>

            </div>

            <!-- Sidebar -->
<?php include_once('includes_t/sidebar_edit.php') ?>


    <!-- Footer -->
<?php include_once('includes_t/footer.php') ?>
