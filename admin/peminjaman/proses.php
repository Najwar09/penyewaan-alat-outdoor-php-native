<?php

 require '../../koneksi/koneksi.php';

if($_GET['id'] == 'konfirmasi')
{
    $data2[] = $_POST['status'];
    $data2[] = $_POST['id_alat'];
    $sql2 = "UPDATE `alat` SET `status`= ? WHERE id_alat= ?";
    $row2 = $koneksi->prepare($sql2);
    $row2->execute($data2);

    echo '<script>alert("Status alat di pinjam");history.go(-1);</script>'; 
}