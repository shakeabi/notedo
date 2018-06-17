<?php
session_start();
include_once('connect.php');
include_once('functions.php');
$error = 0;

date_default_timezone_set('Asia/Kolkata');



   if(isset($_GET['p_id'])&&isset($_GET['u_id'])){
       $n_id = $_GET['p_id'];
       $u_id = $_GET['u_id'];
   }

     $table = $u_id.'notes';

     $query = "SELECT * FROM $table WHERE id = $n_id";
     $result = $connection->query($query);
     confirmQuery($result);

     $row = $result->fetch_assoc();
     $note_id_d     = $row['id'];
     $note_title_d     = $row['title'];
     $note_content_d   = $row['noteContent'];
     $note_priority_d  = $row['priority'];
     $note_label_d     = $row['labels'];
     $note_imgPath_d   = $row['imgPath'];




   if(isset($_POST['update_note'])) {

            $note_title        = $connection->real_escape_string($_POST['title']);
            $note_priority     = $connection->real_escape_string($_POST['note_priority']);
            if($note_priority==""){
              $note_priority = $note_priority_d;
            }

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
                echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
                $error = 1;
            }
        }

      }else {
        $note_image = $note_imgPath_d;
      }

      ///////////////////////////////////////////////////////////////////////


      if($error == 0){

          $table = $u_id."notes";

          $query = "UPDATE {$table} ";

          $query .= "SET title='{$note_title}',noteContent='{$note_content}',priority='{$note_priority}',labels='{$note_label}',imgPath='{$note_image}',editTime='{$note_time}' ";

          $query .= "WHERE id = $n_id";

          $create_note_query = $connection->query($query);

          confirmQuery($create_note_query);

          redirect("collab_notes_view.php?collab_u_id=$u_id&collab_n_id=$n_id");
      }






   }



?>

<?php include_once('includes/header.php'); ?>
<?php include_once('includes/navigation.php'); ?>

<div style="margin:0 auto;width: 80%;">

  <form action="" method="post" enctype="multipart/form-data">


    <div class="form-group">
       <label for="title">Note Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $note_title_d ?>" required>
    </div>

       <div class="form-group">
     <label for="priority">Priority</label>
     <select name="note_priority" class="form-control" id="" >
        <option value="" selected disabled hidden><?php echo $note_priority_d ?></option>
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
        <input type="text" class="form-control" name="note_label" value="<?php echo $note_label_d ?>" required>
    </div>

    <div class="form-group">
       <label for="note_content">Note Content</label>
       <textarea class="form-control "name="note_content" id="" cols="30" rows="10"><?php echo $note_content_d ?>
       </textarea>
    </div>



     <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_note" value="Update note">
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
