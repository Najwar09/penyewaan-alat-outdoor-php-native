<?php

    session_start();
    require 'koneksi/koneksi.php';
    include 'header.php';
    $id = strip_tags($_GET['id']);
    $hasil = $koneksi->query("SELECT * FROM alat WHERE id_alat = '$id'")->fetch();
?>
<div class="container mt-5">
<div class="row">
    <div class="col-sm-6">
        <!-- MENAMPILKAN GAMBAR PADA HALAMAN DETAILS -->
        <img class="card-img-top w-100" 
            style="object-fit:cover;" 
            src="assets/image/<?php echo $hasil['gambar'];?>" alt="">
    </div>

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <!-- MENAMPILKAN DESKRIPSI ALAT PADA HALAMAN DETAILS -->
                <p class="card-text">
                    Deskripsi :
                    <?php echo $hasil['deskripsi'];?>
                </p>

                <!-- JIKA STATUS==TERSEDIA MAKA AVAILABLE JIKA TIDAK MAKA NOT AVAILABLE -->
                <ul class="list-group list-group-flush">
                    <?php if($hasil['status'] == 'Tersedia'){?>
                    <li class="list-group-item bg-primary text-white">
                        <i class="fa fa-check"></i> Available
                    </li>
                    <?php }else{?>
                    <li class="list-group-item bg-danger text-white">
                        <i class="fa fa-close"></i> Not Available
                    </li>
                    <?php }?>
                    <!-- MENAMPILKAN HARGA PADA HALAMAN DETAILS -->
                    <li class="list-group-item bg-dark text-white">
                        <i class="fa fa-money"></i> Rp. <?php echo number_format($hasil['harga']);?>/ day
                    </li>
                </ul>
                <hr/>
                <!-- TOMBOL BOOKING NOW DAN BACK -->
                <center>
                    <a href="booking.php?id=<?php echo $hasil['id_alat'];?>" class="btn btn-success">Booking now!</a>
                    <a href="index.php" class="btn btn-info">Back</a>
                </center>
            </div>
         </div> 
    </div>
</div>
</div>


<?php include 'footer.php';?>