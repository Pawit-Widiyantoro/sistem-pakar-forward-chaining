<?php

    $id_aturan = $_GET['id_aturan'];
    $id_gejala = $_GET['id_gejala'];

    $sql = "DELETE FROM detail_basis_aturan WHERE id_aturan='$id_aturan' AND id_gejala='$id_gejala'";
    if($conn->query($sql) ===TRUE){
        header("Location:?page=aturan");
        exit();
    }
    $conn->close();

?>