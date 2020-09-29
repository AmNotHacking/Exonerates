<?php
include "config.php";
$id = $_POST['id'];


if ($id != "") {
    try {
        $delete_query = "DELETE FROM logs WHERE id='$id'";
        $result = mysqli_query($con, $delete_query);
        echo '1';
    }
    catch (Exception $e) {
        echo '2';
    }
}
else {
    header('Location: http://exonerate.cc');
}

?>