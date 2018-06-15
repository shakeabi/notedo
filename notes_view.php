<?php
  include_once('connect.php');
  include_once('functions.php');
  session_start();
  if(!isset($_SESSION['curr_id'])){header("Location: index.php");}

    if(isset($_GET['p_id'])){
        $n_id = $_GET['p_id'];
    }


    $table = $_SESSION['curr_id'].'notes';

    $query = "SELECT * FROM $table WHERE id = $n_id";
    $result = $connection->query($query);
    confirmQuery($result);

      $row = $result->fetch_assoc();
      $note_id     = $row['id'];
      $note_title     = $row['title'];
      $note_content   = $row['noteContent'];
      $note_priority  = $row['priority'];
      $note_label     = $row['labels'];
      $note_image     = $row['imgPath'];
      $note_e_time    = $row['editTime'];
      $note_c_time    = $row['createTime'];




 ?>
<?php include_once('includes/header.php'); ?>

    <!-- Navigation -->
    <?php include_once('includes/navigation.php') ?>
    <!-- Content -->
    <div class="container">

        <div class="row">

            <!-- Note View -->
            <div class="col-lg-8">


                <!-- Title -->
                <h1><?php echo $note_title; ?></h1>

                <!-- label -->
                <p class="lead"><?php echo "Label: " .$note_label; ?></p>

                <hr>

                <p style="text-align:right;">
                    Priority: <?php echo $note_priority; ?>
                </p>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Created on <?php echo $note_c_time; ?></p>
                <p><span class="glyphicon glyphicon-time"></span> Edited on <?php echo $note_e_time; ?></p>

                <hr>

                <!-- Image -->
                <img class="img-responsive" src="<?php echo "uploads/" . $note_image; ?>" alt="">

                <hr>

                <!-- Content -->
                <p class="lead"><?php echo $note_content; ?></p>

                <hr>

            </div>

            <!-- Sidebar -->
<?php include_once('includes/sidebar_edit.php') ?>


    <!-- Footer -->
<?php include_once('includes/footer.php') ?>
