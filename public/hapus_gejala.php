<?php

    $id_gejala = $_GET['id'];

    $sql = "DELETE FROM gejala WHERE id_gejala='$id_gejala'";
    if($conn->query($sql) ===TRUE){
        header("Location:?page=gejala");
        exit();
    }
    $conn->close();

?>