<?php
  session_start();

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
                    <?php echo "{$_SESSION['username']}'s Tasks";?>
                </h1>

                <?php
                  $table = $_SESSION['id'].'notes';
                  $query = "SELECT * FROM $table";
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
                    <p class="lead">
                        by <a href="index.php">Priority: <?php echo $note_priority; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $note_c_time; ?></p><br>
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

            <!-- Task Sidebar Widgets Column -->
<?php include_once('includes_t/sidebar.php') ?>

        <!-- Footer -->
<?php include_once('includes_t/footer.php') ?>
