<?php
session_start();
include_once('connect.php');
include_once('functions.php');
$error = 0;

date_default_timezone_set('Asia/Kolkata');

   if(isset($_POST['create_note'])) {

            $note_title        = $connection->real_escape_string($_POST['title']);
            $note_priority     = $connection->real_escape_string($_POST['note_priority']);


            $note_image        = $connection->real_escape_string($_FILES['image']['name']);
            $note_image_temp   = $connection->real_escape_string($_FILES['image']['tmp_name']);

            $note_label        = $connection->real_escape_string($_POST['note_label']);
            $note_content      = $connection->real_escape_string($_POST['note_content']);
            $note_time         = date("l jS \of F Y h:i:s A");
            $note_image        = basename($_FILES["image"]["name"]);

      ////////////////////////////////////////////////////////////////////////
      if($_FILES["image"]["tmp_name"] != null){

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if the file is an image

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.<br>";
                $uploadOk = 0;
            }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists. Change the filename and tryagain.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<h1>Sorry, your file was not uploaded.</h1><br>";
            $error = 1;
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
                $error = 1;
            }
        }

      }else {
        $note_image = "DEFAULT.jpg";
      }

      ///////////////////////////////////////////////////////////////////////


      if($error == 0){

          $table = $_SESSION['curr_id']."notes";

          $query = "INSERT INTO {$table}(title, noteContent, priority, labels, imgPath, editTime, createTime) ";

          $query .= "VALUES('{$note_title}','{$note_content}','{$note_priority}','{$note_label}','{$note_image}','{$note_time}','{$note_time}')";

          $create_note_query = $connection->query($query);

          confirmQuery($create_note_query);

         redirect('usernotes.php');
      }




   }




?>
<?php include_once('includes/header.php'); ?>
<?php include_once('includes/navigation.php'); ?>

<div style="margin:0 auto;width: 80%;">

  <form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
       <label for="title">Note Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>

       <div class="form-group">
     <label for="priority">Priority</label>
     <select name="note_priority" class="form-control" id="">

        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>

     </select>

    </div>


  <div class="form-group">
       <label for="note_image">Note Image</label>
        <input type="file"  name="image">
    </div>

    <div class="form-group">
       <label for="note_label">Note Label</label>
        <input type="text" class="form-control" name="note_label" required>
    </div>

    <div class="form-group">
       <label for="note_content">Note Content</label>
       <textarea class="form-control "name="note_content" id="" cols="30" rows="10">
       </textarea>
    </div>



     <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_note" value="Publish note">
    </div>


</form>

</div>
<footer style="text-align: center;">

        <div style"margin:0 auto;width: 80%;">
            Made with &#10084; by <a href="https://github.com/shakeabi">Abishake</a>
        </div>
</footer>

</div>



<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>
