<?php
include_once('connect.php');
 ?>

<div class="col-md-4">

    <div class="well">
        <a href="edit_note.php?p_id=<?php echo $note_id ?>"><h4><span class="glyphicon glyphicon-edit"></span> Edit this Note</h4></a><br>
        <a href="delete_note.php?p_id=<?php echo $note_id ?>&u_id=<?php echo $_SESSION['curr_id']; ?>"><h4><span class="glyphicon glyphicon-trash"></span> Delete this Note</h4></a>
    </div>
    <div class="well">
      <h3>Add a Collaborator:</h3>
      <form action="add_note_collab.php" method="post">
        <?php $_SESSION['note_id']=$note_id; ?>
      <div class="input-group">
          <input name="target_collab_id" type="text" class="form-control" placeholder="Enter collaborator's Id" required>
          <span class="input-group-btn">
              <button name="add_note_collab" class="btn btn-default" type="submit" >
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div>
      </form>
    </div>
    <div class="well">
      <h3>Collaborators:</h3><small>Click on the collaborator to remove them.</small><br>
      <?php
        $table = $_SESSION['curr_id']."notes";

        $query = "SELECT collabs FROM $table WHERE id = $note_id";
        $result = $connection->query($query);
        confirmQuery($result);

        $row = $result->fetch_assoc();
        $display_collab_list = explode(" ",$row['collabs']);

        $table = "users";
        foreach ($display_collab_list as $key => $value) {
            $query = "SELECT username FROM $table WHERE id = '{$value}'";
            $result = $connection->query($query);
            confirmQuery($result);
            $temp_row = $result->fetch_assoc();

            echo "<a href='delete_note_collab.php?d_id=$value'>".$temp_row['username']."</a><br>";
        }
      ?>
    </div>

</div>

</div>

<hr>
