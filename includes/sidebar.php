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



</div>

</div>

<hr>
