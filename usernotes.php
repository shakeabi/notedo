<?php
  include_once('connect.php');
  include_once('functions.php');
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
                  if(!isset($_GET['filter'])){
                    $criteria = "editTime DESC,priority DESC";
                  }
                  else if($_GET['filter']=="time"){
                            $criteria = "editTime DESC,priority DESC";
                          }
                      else {
                              $criteria = "priority DESC,editTime DESC";
                            }
                  if(!isset($_GET['label'])){
                    $label = "1 = 1";
                  }
                  else{
                    $label = "labels = '{$_GET['label']}'";
                  }

                  $query = "SELECT * FROM $table WHERE $label ORDER BY $criteria ";
                  $result = $connection->query($query);
                  confirmQuery($result);
                  while($row = $result->fetch_assoc()){
                    $note_id     = $row['id'];
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
                        <a href="notes_view.php?p_id=<?php echo $note_id ?>"><?php echo $note_title; ?></a><small><?php echo " - " .$note_label; ?></small>
                    </h2>
                    <hr>
                    <p style="text-align:right;">
                        Priority: <?php echo $note_priority; ?>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $note_c_time; ?></p>
                    <p><span class="glyphicon glyphicon-time"></span> Edited on <?php echo $note_e_time; ?></p>
                    <hr>
                    <img class="img-responsive" src="<?php echo "uploads/" . $note_image; ?>" alt="">
                    <hr>
                    <p><?php echo $note_content; ?></p>
                    <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                    <hr>
                <?php
                  }

                ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include_once('includes/sidebar.php') ?>

        <!-- Footer -->
<?php include_once('includes/footer.php') ?>
