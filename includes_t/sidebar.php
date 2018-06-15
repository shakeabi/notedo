<?php
  include_once('connect.php');
  include_once('functions.php');


  date_default_timezone_set('Asia/Kolkata');

?>

<div class="col-md-4">

    <div class="well">
        <h4>Add a List</h4>
        <form action="list_add.php" method="post">
        <div class="input-group">
            <input name="list_name" type="text" class="form-control" required>
            <span class="input-group-btn">
                <button name="add_list" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-plus"></span>
            </button>
            </span>
        </div>
        </form>

    </div>

</div>

</div>


<hr>
