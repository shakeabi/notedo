<?php
include_once('connect.php');
 ?>

<div class="col-md-4">

    <div class="well">
        <a href="edit_note.php?p_id=<?php echo $note_id ?>"><h4><span class="glyphicon glyphicon-edit"></span> Edit this Note</h4></a><br>
        <a href="delete_note.php?p_id=<?php echo $note_id ?>"><h4><span class="glyphicon glyphicon-trash"></span> Delete this Note</h4></a>
    </div>

</div>

</div>

<hr>
