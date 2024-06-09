<?php

    $id_user = $_GET['id'];

    $sql = "DELETE FROM users WHERE id_user='$id_user'";
    if($conn->query($sql) ===TRUE){
        header("Location:?page=user");
        exit();
    }
    $conn->close();

?>