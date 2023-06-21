<?php

    require '../../koneksi/koneksi.php';
    $title_web = 'Konfirmasi';
    session_start();
    if(empty($_SESSION['USER']))
    {
        echo '<script>alert("login dulu");window.location="index.php"</script>';
    }
    $kode_booking = $_GET['id'];
    $hasil = $koneksi->query("SELECT * FROM booking WHERE kode_booking = '$kode_booking'")->fetch();

    $id_booking = $hasil['id_booking'];
    $hsl = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->fetch();
    $c = $koneksi->query("SELECT * FROM pembayaran WHERE id_booking = '$id_booking'")->rowCount();


    $id = $hasil['id_alat'];
    $isi = $koneksi->query("SELECT * FROM alat WHERE id_alat = '$id'")->fetch();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css" >
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="../../assets/css/font-awesome.css" >
    
</head>
<body>
    <br>
    <br>
    <center><h2>LAPORAN TRANSAKSI</h2></center>
    
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kode Booking</th>
      <th scope="col">Nama</th>
      <th scope="col">Tanggal Sewa</th>
      <th scope="col">Lama Sewa</th>
      <th scope="col">Total Harga</th>
      <th scope="col">Konfirmasi</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><?php echo $hasil['kode_booking'];?></td>
      <td><?php echo $hasil['nama'];?></td>
      <td><?php echo $hasil['tanggal'];?></td>
      <td><?php echo $hasil['lama_sewa'];?> hari</td>
      <td>Rp. <?= number_format($hasil['total_harga']);?></td>
      <td><?php echo $hasil['konfirmasi_pembayaran'];?></td>
      
    </tr>
    
  </tbody>
</table>
    <script>
        window.print();
    </script>
</body>
</html>
<br>
<br>
<br>
<br>
<br>
