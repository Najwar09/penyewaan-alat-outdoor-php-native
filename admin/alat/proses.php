<?php

require '../../koneksi/koneksi.php';
$title_web = 'Tambah Alat Outdoor';
include '../header.php';
if (empty($_SESSION['USER'])) {
    session_start();
}

// PROSES TAMBAH DATA

if ($_GET['aksi'] == 'tambah') {
    $dir = '../../assets/image/';
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );

    if ($_FILES['gambar']["error"] > 0) {
        echo '<script>alert("Error file");history.go(-1)</script>';
        exit();
    } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
        echo '<script>alert("You can only upload JPG, PNG and GIF file");window.location="tambah.php"</script>';
        exit();
    } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
        echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");window.location="tambah.php"</script>';
        exit();
    } else {
        if (move_uploaded_file($tmp_name, $target_path)) {
            $data[] = $_POST['harga'];
            $data[] = $_POST['deskripsi'];
            $data[] = $_POST['status'];
            $data[] = $newfilename;

            $sql = "INSERT INTO `alat`(`harga`, `deskripsi`, `status`, `gambar`) 
                VALUES (?,?,?,?)";
            $row = $koneksi->prepare($sql);
            $row->execute($data);
            echo '<script>alert("sukses");window.location="alat.php"</script>';
        } else {
            echo '<script>alert("Harap Upload Gambar !");window.location="tambah.php"</script>';
        }
    }
}





if ($_GET['aksi'] == 'edit') {
    $dir = '../../assets/image/';
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $temp = explode(".", $_FILES["gambar"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_path = $dir . basename($newfilename);
    $allowedImageType = array("image/gif",   "image/JPG",   "image/jpeg",   "image/pjpeg",   "image/png",   "image/x-png"  );

    $gambar = $_POST['gambar_cek'];

    $id = $_GET['id'];

    $data[] = $_POST['harga'];
    $data[] = $_POST['deskripsi'];
    $data[] = $_POST['status'];
    if ($_FILES['gambar']["size"] > 0) {
        if ($_FILES['gambar']["error"] > 0) {
            echo '<script>alert("Error file");history.go(-1)</script>';
            exit();
        } elseif (!in_array($_FILES['gambar']["type"], $allowedImageType)) {
            echo '<script>alert("You can only upload JPG, PNG and GIF file");history.go(-1)</script>';
            exit();
        } elseif (round($_FILES['gambar']["size"] / 1024) > 4096) {
            echo '<script>alert("WARNING !!! Besar Gambar Tidak Boleh Lebih Dari 4 MB !");history.go(-1)</script>';
            exit();
        } else {
            if (move_uploaded_file($tmp_name, $target_path)) {
                if (file_exists('../../assets/image/'.$gambar)) {
                    unlink('../../assets/image/'.$gambar);
                }
                $data[] = $newfilename;
            } else {
                echo '<script>alert("Error file");history.go(-1)</script>';
                exit();
            }
        }
    } else {
        $data[] = $_POST['gambar_cek'];
    }
    $data[] = $id;
    $sql = "UPDATE alat SET harga=?, deskripsi=?, status=?, gambar=?
        WHERE id_alat = ?";
    $row = $koneksi->prepare($sql);
    $row->execute($data);

    echo '<script>alert("sukses");window.location="alat.php"</script>';
}


if (!empty($_GET['aksi'] == 'hapus')) {
    $id = $_GET['id'];
    $gambar = $_GET['gambar'];

    unlink('../../assets/image/'.$gambar);

    $sql = "DELETE FROM alat WHERE id_alat = ?";
    $row = $koneksi->prepare($sql);
    $row->execute(array($id));

    echo '<script>alert("sukses hapus");window.location="alat.php"</script>';
}
