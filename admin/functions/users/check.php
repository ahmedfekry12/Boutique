<?php
if ($_SESSION['type'] === 'owner'){
    header ('location: ../../users.php?action=add');
} else {
    $_SESSION['error_type'] = "<div class='alert alert-danger'>Sorry You Do Not Have this Permission</div>";
    header ("location: ../../users.php");
}
?>