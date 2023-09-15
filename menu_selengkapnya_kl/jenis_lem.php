<?php  
require '../kasir/function.php';



// // function calon pembeli
// if(isset($_POST['tambahcalonpembeli']))    {
//     // $namapelanggan = $_POST['namapembeli'];
//     // $notelp = $_POST['notlp'];
//     // $alamat = $_POST['alamatpembeli'];

//     // $insert = mysqli_query($c, "INSERT INTO pelanggan (namapelanggan,notelp,alamat) VALUES ('$namapelanggan','$notelp','$alamat')");

//     $insert = $_POST['tambahcalonpembeli'];

//     if($insert) {
//         echo '
//         <script>
//             alert("Anda berhasil Silahkan melanjutkan pembelian anda");
//             window.location.href="https://api.whatsapp.com/send?phone=6282292830149";
//         </script>
//             ';
//     } else {
//         echo '
//         <script>
//             alert("Gagal melanjutkan pembelian");
//             window.location.href="index.php";
//         </script>
//             ';
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MACAM-MACAM LEM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    <style>
    .rakjualan ul li a{
	display: inline-block;
    }
    </style>
</head>
<body>
    <!-- <div class="papan_jualan_pulsa">
    </div> -->

    <div class="container">
        <!-- Navigasi atas -->
        <div>
            <nav class="blackbar">
                <div class="sub_bar">
                    <ul>
                        <li>
                            <h1>Toko Rahmat Jaya</h1>
                        </li>
                        <li class="bar_login">
                            <a class="nav-link" href="kasir/index.php"><i class="bi bi-person-square"> Masuk untuk Admin</i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="fototoko">
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Pesanan</a></li>
                <li><a href="#tentangkamii">Tentang Kami</a></li>
            </ul>
        </div>

        <div class="content">
            <h2>Kami Menyediakan Bahan Bangunan & Alat-alat Bangunan</h2>
            <p class="penulis">ditulis, Design, Website ini oleh <a href="https://www.instagram.com/rahmat_wijay4nto/"> Rahmat Wijayanto</a> pada 2 September 2022. Toko kami akan terbuka di jam 06.00 pagi paling lambat jam 07.00 am ditutup sampai sore jam 05.30 pm pelayanan jika kondisi malam bisa bertanya di cs admin kami atau di website selama 24 jam jika slow respon mohon dimaafkan. </p>
        </div>
        

        <!-- TOKO AREA KOLONO TIMUR -->
        <div class="rakjualan">
            <div class="judularea">
                <p>Area Kolono Timur</p>
                <hr>
            </div>
            <?php  
            $get = mysqli_query($c, "SELECT * FROM produk WHERE deskripsi='LEM'");
            while ($p=mysqli_fetch_array($get)) {
                $namaproduk = $p['namaproduk'];
                $deskripsi = $p['deskripsi'];
                $hargaproduk = $p['harga'];
                $stockawal = $p['stock'];
                $idproduk = $p['idproduk'];
                $diskon = $p['harga_diskon'];
                // cek gambar atau tdk ada
                $gambar = $p['images'];
                if($gambar == null) {
                    //jika tidak ada gambar
                    $img = 'No Photo';
                } else {
                    // jika ada gambar
                    $img = '<img src="../kasir/images/'.$gambar.'" class="zoomable">';
                }
            ?>

            <div class="baris4">
                <a class="btn btn-light" data-bs-toggle="modal" data-bs-target="#myModal">
                    <?= $img; ?>
                    <p class="judulproduk"><?=$namaproduk; ?></p>
                    <br>
                    <p class="diskon"><s>Rp<?= number_format($diskon); ?></s></p>
                    <p class="jadinya">Harga Rp<?= number_format($hargaproduk); ?></p>
                    <p>Tersisa <?= $stockawal; ?>Buah </p>
                    <p>Lokasi Kelurahan Kolono/Timur</p>
                </a>
            </div>

                <!-- The Modal calon pembeli -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h3 class="modal-title">Apakah Anda yakin memesan barang ini?</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                            <div class="modal-body">
                                <h3>Jika Yakin Silahkan ke Admin WhatsApp Kami</h3>
                                <!-- <input type="text" name="namapembeli" class="form-control" placeholder="Nama Pelanggan" required>
                                <br>
                                <input type="number" name="notlp" class="form-control" placeholder="Nomor telp/hp/wa" required>
                                <br>
                                <input type="text" name="alamatpembeli" class="form-control" placeholder="Alamat tempat tinggal anda" required> -->

                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a href="https://api.whatsapp.com/send?phone=6282292830149"><button type="submit" name="tambahcalonpembeli" class="btn btn-success"><i class="bi bi-send-check"> Ya</i></button></a>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-square"> Tidak Jadi</i></button>
                            </div>

                            </div>
                    </div>
                </div>

            <?php 
            }
            ?>
        </div>
        <br>


        <div class="tentangkami" id="tentangkamii">
            <h2>Tentang Kami</h2>
            <p>Website Kami hanya sebagai jalan pintas di toko offline kami, juga bisa memberi kenyamanan costumer kami oleh karena itu kami membuat website untuk toko online kami, Jika ada keluhan silahkan hubungi cs admin kami.</p>
        </div>


        <!-- PAGINATION -->
        <!-- <div>
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
            </ul>
        </div>
        <br> -->



        <!-- footer bawah -->
        <div class="footer">
            <p class="copy">Copyright 2022. Rahmat Wijayanto</p>
        </div>

    </div>  

    
</body>
</html>