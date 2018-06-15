<?php
include_once('connect.php');
include_once('functions.php');
session_start();
if(!isset($_SESSION['curr_id'])){header("Location: index.php");}
$flag=0;
 ?>

<?php include_once('includes_t/header.php') ?>

    <!-- Navigation -->
<?php include_once('includes_t/navigation.php') ?>

    <!-- Content -->
    <div class="container">

        <div class="row">

            <!-- Task Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo "{$_SESSION['curr_username']}'s Task Lists";?>
                </h1>
<!-- //////////////////////////////////////////////////////////////////////// -->
                <?php
                  $table = $_SESSION['curr_id'].'task_lists';

                  $query = "SELECT * FROM $table ORDER BY editTime DESC ";
                  $result = $connection->query($query);
                  confirmQuery($result);
                  while($row = $result->fetch_assoc()){
                    $flag = 1;
                    $task_list_id = $row['id'];
                    $task_list_title     = $row['listName'];
                    $task_list_e_time    = $row['editTime'];
                    $task_list_c_time    = $row['createTime'];
                ?>
                    <!-- TaskList -->
                    <h2>
                        <a href="task_view.php?t_id=<?php echo $task_list_id ?>"><?php echo $task_list_title; ?></a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $task_list_c_time; ?></p>
                    <p><span class="glyphicon glyphicon-time"></span> Edited on <?php echo $task_list_e_time; ?></p>
                    <hr>
                <?php
                  }
                    if(!$flag){
                      echo "<h2>Nothing to display!</h2>";
                    }
                ?>
<!-- //////////////////////////////////////////////////////////////////////// -->

            </div>


            <!-- Sidebar -->
<?php include_once('includes_t/sidebar.php') ?>

        <!-- Footer -->
<?php include_once('includes_t/footer.php') ?>
