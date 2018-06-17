<?php
include_once('connect.php');
 ?>

<div class="col-md-4">

    <div class="well">
        <a href="add_note.php"><h4><span class="glyphicon glyphicon-plus"></span> Add A Note</h4></a>

    </div>

    <div class="well">
        <h4>Sort:</h4>
        <form action="" method="get" enctype="multipart/form-data">
          <select name="filter" class="form-control" id="">

             <option value='time'>Newest First</option>
             <option value='priority'>Most Important First</option>

          </select>
          <br>

          <div class="form-group">
             <button type="submit" class="btn btn-primary">Sort</button>
         </div>

        </form>

    </div>

    <div class="well">
        <h4>Labels</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                  <?php
                    $table = $_SESSION['curr_id'].'notes';

                    $query = "SELECT DISTINCT labels FROM $table ORDER BY editTime DESC";
                    $result = $connection->query($query);

                    while($row = $result->fetch_assoc()){
                      $note_label  = $row['labels'];
                  ?>
                      <li><a href="usernotes.php?label=<?php echo $note_label;?>"><span class="label label-default"><?php echo $note_label; ?></span></a>
                      </li>

                  <?php
                    }

                  ?>


                </ul>
            </div>

        </div>
    </div>
    <div class="well">
        <h4>Collaborating on:</h4>
        <?php

          $table = $_SESSION['curr_id']."note_collabs";

          $query = "SELECT * FROM {$table} ORDER BY createTime DESC";
          $result = $connection->query($query);
          confirmQuery($result);

          while($row = $result->fetch_assoc()){
            $temp_collab_id = $row['collabId'];
            $temp_note_id = $row['noteId'];

            $table = $temp_collab_id."notes";

            $query = "SELECT title FROM {$table} WHERE id = $temp_note_id";
            $result = $connection->query($query);
            confirmQuery($result);
            $row = $result->fetch_assoc();

            $display_note_name = $row['title'];

            $table = "users";

            $query = "SELECT username FROM {$table} WHERE id = $temp_collab_id";
            $result = $connection->query($query);
            confirmQuery($result);
            $row = $result->fetch_assoc();

            $display_collab_name = $row['username'];
            ?>

            <p>
              <?php echo "<a href='collab_notes_view.php?collab_u_id=$temp_collab_id&collab_n_id=$temp_note_id'>".$display_note_name."</a> by: ".$display_collab_name."<br>" ?>
            </p>

        <?php
          }

        ?>


    </div>



</div>

</div>

<hr>
