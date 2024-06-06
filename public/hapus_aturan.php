<?php

    $id_aturan = $_GET['id'];

    $sql = "DELETE FROM basis_aturan WHERE id_aturan='$id_aturan'";
    $conn->query($sql);
    
    $sql = "DELETE FROM detail_basis_aturan WHERE id_aturan='$id_aturan'";
    $conn->query($sql);

    header("Location:?page=aturan");
    $conn->close();

?>