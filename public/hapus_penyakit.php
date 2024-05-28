<?php

    $id_penyakit = $_GET['id'];

    $sql = "DELETE FROM penyakit WHERE id_penyakit='$id_penyakit'";
    if($conn->query($sql) ===TRUE){
        header("Location:?page=penyakit");
        exit();
    }
    $conn->close();

?>