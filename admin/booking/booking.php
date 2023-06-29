<?php

    require '../../koneksi/koneksi.php';
    $title_web = 'Daftar Booking';
    include '../header.php';
    if(empty($_SESSION['USER']))
    {
        session_start();
    }
    if(!empty($_GET['id'])){
        $id = strip_tags($_GET['id']);
        $sql = "SELECT alat.harga, booking.* FROM booking JOIN alat ON 
                booking.id_alat=alat.id_alat WHERE id_login = '$id' ORDER BY id_booking DESC";
    }else{
        $sql = "SELECT alat.harga, booking.* FROM booking JOIN alat ON 
                booking.id_alat=alat.id_alat ORDER BY id_booking DESC";
    }
    $hasil = $koneksi->query($sql)->fetchAll();
?>

<br>
<div class="container">

    <div class="card">
        <div class="card-header text-white bg-primary">
            <div class="flex justify-between">
                <h5 class="card-title">
                Daftar Booking
                </h5>

                <div class="">
                <form class="form-inline" method="post" action="filter.php">
                    <input class="form-control mr-sm-2" type="date" name="tanggal" placeholder="Cari Nama Booking" aria-label="Search">
                    <input class="form-control mr-sm-2" type="date" name="tanggal_kembali" placeholder="Cari Nama Booking" aria-label="Search">
                    <button class="btn my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
            </div>
        </div>
    </div>
        

        


        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Booking</th>
                            <th>Nama </th>
                            <th>Tanggal Sewa </th>
                            <th>Tanggal Kembali </th>
                            <th>Total Harga</th>
                            <th>Konfirmasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $no=1; foreach($hasil as $isi){?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?= $isi['kode_booking'];?></td>
                            <td><?= $isi['nama'];?></td>
                            <td><?= $isi['tanggal'];?></td>
                            <td><?= $isi['tanggal_kembali'];?></td>
                            <td>Rp. <?= number_format($isi['total_harga']);?></td>
                            <td><?= $isi['konfirmasi_pembayaran'];?></td>
                            <td>
                                <a class="btn btn-primary" href="bayar.php?id=<?= $isi['kode_booking'];?>" 
                                role="button">Detail</a>
                                <a class="btn btn-success" href="cetak.php?id=<?= $isi['kode_booking'];?>"
                                role="button" target="_blank">Cetak</a>      
                            </td>
                            
                        </tr>
                        <?php $no++;}?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php  include '../footer.php';?>