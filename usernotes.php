<?php
  include_once('connect.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

 ?>

<?php include_once('includes/header.php') ?>

    <!-- Navigation -->
<?php include_once('includes/navigation.php') ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    <?php echo "{$_SESSION['curr_username']}'s Notes" ?>
                </h1>

                <?php
                  $table = $_SESSION['curr_id'].'notes';
                  $query = "SELECT * FROM $table ORDER BY editTime DESC";
                  $result = $connection->query($query);

                  while($row = $result->fetch_assoc()){
                    $note_title     = $row['title'];
                    $note_content   = $row['noteContent'];
                    $note_priority  = $row['priority'];
                    $note_label     = $row['labels'];
                    $note_image     = $row['imgPath'];
                    $note_e_time    = $row['editTime'];
                    $note_c_time    = $row['createTime'];
                ?>
                    <!-- Note -->
                    <h2>
                        <a href="#"><?php echo $note_title; ?></a>
                    </h2>
                    <p style="text-align:right;">
                        Priority: <a href="index.php"><?php echo $note_priority; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $note_c_time; ?></p>
                    <p><span class="glyphicon glyphicon-time"></span> Edited on <?php echo $note_e_time; ?></p>
                    <hr>
                    <img class="img-responsive" src="<?php echo "uploads/" . $note_image; ?>" alt="">
                    <hr>
                    <p><?php echo $note_content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                <?php
                  }

                ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include_once('includes/sidebar.php') ?>

        <!-- Footer -->
<?php include_once('includes/footer.php') ?>
