<?php

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE itissues SET status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_page.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
