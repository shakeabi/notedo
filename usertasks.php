<?php
include_once('connect.php');
include_once('functions.php');
session_start();
if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

 ?>

<?php include_once('includes_t/header.php') ?>

    <!-- Navigation -->
<?php include_once('includes_t/navigation.php') ?>

    <!-- Page Content -->
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
                    $task_list_title     = $row['listName'];
                    $task_list_e_time    = $row['editTime'];
                    $task_list_c_time    = $row['createTime'];
                ?>
                    <!-- Note -->
                    <h2>
                        <a href="#"><?php echo $task_list_title; ?></a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $task_list_c_time; ?></p>
                    <p><span class="glyphicon glyphicon-time"></span> Edited on <?php echo $task_list_e_time; ?></p>
                    <hr>
                    <!-- <p><?php //echo $note_content; ?></p> -->
                    <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                    <hr>
                <?php
                  }

                ?>
<!-- //////////////////////////////////////////////////////////////////////// -->
                <!-- Second Task Post -->
                <h2>
                    <a href="#">Task Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, quasi, fugiat, asperiores harum voluptatum tenetur a possimus nesciunt quod accusamus saepe tempora ipsam distinctio minima dolorum perferendis labore impedit voluptates!</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Third Task Post -->
                <h2>
                    <a href="#">Task Post Title</a>
                </h2>
                <p class="lead">
                    by <a href="index.php">Start Bootstrap</a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:45 PM</p>
                <hr>
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, voluptates, voluptas dolore ipsam cumque quam veniam accusantium laudantium adipisci architecto itaque dicta aperiam maiores provident id incidunt autem. Magni, ratione.</p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>


            </div>

            <!-- Task Sidebar Widgets Column -->
<?php include_once('includes_t/sidebar.php') ?>

        <!-- Footer -->
<?php include_once('includes_t/footer.php') ?>
