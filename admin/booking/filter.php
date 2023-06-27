<?php
session_start();
    require '../../koneksi/koneksi.php';
    include '../header.php';
    if($_GET['cari'])
    {
        $cari = strip_tags($_GET['cari']);
        $query =  $koneksi -> query('SELECT * FROM booking WHERE nama LIKE "%'.$cari.'%" ORDER BY id_alat DESC')->fetchAll();
    }else{
        $query =  $koneksi -> query('SELECT * FROM alat ORDER BY id_alat DESC')->fetchAll();
    }
?>


<div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-sm">
                <?php 
                  if($_GET['cari'])
                {
                    echo '<h4> Keyword Pencarian : '.$cari.'</h4>';
                }else{
                    echo '<h4> Semua Daftar Booking</h4>';
                }
                ?>
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Kode Booking</th>
                            <th>Nama </th>
                            <th>Tanggal Sewa </th>
                            <th>Lama Sewa </th>
                            <th>Total Harga</th>
                            <th>Konfirmasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $no=1; foreach($query as $isi){?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?= $isi['kode_booking'];?></td>
                            <td><?= $isi['nama'];?></td>
                            <td><?= $isi['tanggal'];?></td>
                            <td><?= $isi['lama_sewa'];?> hari</td>
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