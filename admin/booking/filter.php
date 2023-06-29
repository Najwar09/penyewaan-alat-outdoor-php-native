<?php
session_start();
    require '../../koneksi/koneksi.php';
    include '../header.php';
    
    $tanggalAwal = $_POST['tanggal'];
    $tanggalAkhir = $_POST['tanggal_kembali'];
    
    $query = $koneksi->query("SELECT * FROM booking WHERE tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir' ORDER BY tanggal DESC");
    $data = $query->fetchAll();


?>


<div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                <!--  -->
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
                        <?php  $no=1; foreach($data as $isi){?>
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
                <button class="btn btn-danger"><a href="../booking/booking.php" style="color: white;">Kembali</a></button>
            </div>
        </div>
    </div>
</div>
<?php  include '../footer.php';?>