<?php 
require 'function.php';
require 'ceklogin.php';

// hitung jumlah pesanan
$h1 = mysqli_query($c, "SELECT * FROM stock_katalog_cat_avian");
$h2 = mysqli_num_rows($h1); //jumlah pesanan

if(isset($_POST['tambahkatalog']))  {
    $np = $_POST['namaproduk'];
    $ds = $_POST['deskripsi'];
    $hr = $_POST['harga'];
    $sk = $_POST['stk_k'];
    $st = $_POST['stk_t'];

    // soal upload gambar
    $allowed_ekstension = array('png','jpg');
    $nama = $_FILES['file']['name']; //ngambil nama gambar
    $dot = explode('.', $nama);
    $extensi = strtolower(end($dot)); //ngambil ekstensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi filenya

    // penamaan file gambar menggunakan enkripsi
    $image = md5(uniqid($nama, true) . time()).'.'.$extensi; //menggabungkan nama file yang di enkripsi dengan ekstensinya

        // proses upload gambar
        if(in_array($extensi, $allowed_ekstension) === true)    {
            // validasi ukuran filenya
            if($ukuran < 15000000){
                move_uploaded_file($file_tmp, 'katalog_avian/'.$image);
    
                $addtable = mysqli_query($c, "INSERT INTO stock_katalog_cat_avian (namaproduk,deskripsi,harga,stock_kolono,stock_tumbujy,
                                images) VALUES ('$np','$ds','$hr','$sk','$st','$image')");;
    
                if($addtable)   {
                    header('location:katalog_cat_avian.php');
                } else {
                    echo "Gagal Menambah Barang Baru";
                    header('location:katalog_cat_avian.php');
                }
            } else {
                // kalau filenya dari 15 mb
                echo '  
                <script>
                alert("Ukuran terlalu besar");
                window.location.href="katalog_cat_avian.php";
                </script>
                ';
            }
        } else {
            // kalau gambar filex tidak png atau jpg
            echo '
            <script>
                alert("File Harus png/jpg");
                window.location.href="katalog_cat_avian.php";
            </script>
            ';
    
        }
}

if(isset($_POST['ubahkatalog']))    {
    $idp = $_POST['idp'];
    $np = $_POST['namaproduk'];
    $dskp = $_POST['deskripsi'];
    $hrg = $_POST['harga'];
    $st_k = $_POST['stk_k'];
    $st_t = $_POST['stk_t'];

    // soal upload gambar
    $allowed_ekstension = array('png','jpg');
    $nama = $_FILES['file']['name']; //ngambil nama gambar
    $dot = explode('.', $nama);
    $extensi = strtolower(end($dot)); //ngambil ekstensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi filenya

    // penamaan file gambar menggunakan enkripsi
    $image = md5(uniqid($nama, true) . time()).'.'.$extensi; //menggabungkan nama file yang di enkripsi dengan ekstensinya

        // validasi ukuran filenya
        if($ukuran==0){
            // jika tidak ingin diupload foto saat di ubah
            $update = mysqli_query($c, "UPDATE stock_katalog_cat_avian SET namaproduk='$np', deskripsi='$dskp',
                        harga='$hrg', stock_kolono='$st_k', stock_tumbujy='$st_t' WHERE idproduk='$idp'");

            if($update)   {
                echo '
                <script>
                    alert("Berhasil Mengubah Katalog Cat Avian");
                    window.location.href="katalog_cat_avian.php";
                </script>
                ';
            } else {
                echo "Gagal Mengubah Katalog Cat Avian";
                header('location:katalog_cat_avian.php');
            }
        } else {
            //jika ingin mengupload foto saat mengubah foto
            move_uploaded_file($file_tmp, 'katalog_avian/'.$image);
            $update = mysqli_query($c, "UPDATE stock_katalog_cat_avian SET namaproduk='$np', deskripsi='$dskp',
                        harga='$hrg', stock_kolono='$st_k', stock_tumbujy='$st_t', images='$image' WHERE idproduk='$idp'");
            if($update) {
                echo '
                <script>
                    alert("Berhasil Mengubah Katalog Cat Avian");
                    window.location.href="katalog_cat_avian.php";
                </script>
                ';
            } else {
                echo "Gagal Edit";
                header('location:katalog_cat_avian.php');
            }
        }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Pesanan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <style>
            .zoomable{
                width: 290px;
                height: 210px;
            }

            #ll{
                margin: -1px;
                padding: 6px;
                
            }

        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                    <?php  
                    require 'header.php';
                    ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style="text-align: center">Data Katalog Cat Avian</h1>
                        <ol class="breadcrumb mb-4">
                            <h3 class="breadcrumb-item active">Selamat Datang</h3>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Katalog : <?= $h2; ?></div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pesanan Baru -->
                            <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;" >&nbsp Tambah Katalog Cat Avian</i>
                                    </button>
                            </div>
                    <?php
                    
                    $get = mysqli_query($c, "SELECT * FROM stock_katalog_cat_avian");

                    while ($p=mysqli_fetch_array($get)) {
                        $namaproduk = $p['namaproduk'];
                        $deskripsi = $p['deskripsi'];
                        $harga = $p['harga'];
                        $stockln = $p['stock_kolono'];
                        $stocktj = $p['stock_tumbujy'];
                        $idproduk = $p['idproduk'];

                        // cek gambar atau tdk ada
                        $gambar = $p['images'];
                        if($gambar == null) {
                            //jika tidak ada gambar
                            $img = 'No Photo';
                        } else {
                            // jika ada gambar
                            $img = '<img src="katalog_avian/'.$gambar.'" class="zoomable">';
                        }                    
                    ?>

                    <!-- Katalog Cat Avian-->
                    <div id="ll" class="col-sm-3" >
                        <div data-bs-toggle="modal" data-bs-target="#katalog<?= $idproduk; ?>">
                            <div class="btn-group">
                                <button class="card btn-secondary"><?= $img;  ?></button>
                            </div>
                        </div>
                    </div>

                    <!--Modal Katalog Cat Avian-->
                    <div class="portfolio-modal modal fade" id="katalog<?= $idproduk; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                                <div class="modal-body text-center pb-5">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div>
                                                <!-- Portfolio Modal - Title-->
                                                <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?= $namaproduk; ?></h2>
                                                <br>
                                                <!-- Icon Divider-->
                                                <div class="divider-custom">
                                                    <div class="divider-custom-line"></div>
                                                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                    <div class="divider-custom-line"></div>
                                                </div>
                                                <!-- Portfolio Modal - Image-->
                                                <?= $img;  ?>
                                                <!-- Portfolio Modal - Text-->
                                                <h3>INFO CAT AVIAN</h3>
                                                <div class="card bg-secondary text-white mb-3">
                                                    <div class="card-body">Nama Produk : <?= $namaproduk;  ?></div>
                                                </div>
                                                <div class="card bg-secondary text-white mb-3">
                                                    <div class="card-body">Deskripsi : <?= $deskripsi;  ?></div>
                                                </div>
                                                <div class="card bg-secondary text-white mb-3">
                                                    <div class="card-body">Harga : Rp<?=  number_format($harga) ;  ?></div>
                                                </div>
                                                <div class="card bg-secondary text-white mb-3">
                                                    <div class="card-body">Stok Barang Di Kolono : <?= $stockln;  ?> klg</div>
                                                </div>
                                                <div class="card bg-secondary text-white mb-3">
                                                    <div class="card-body">Stock Barang Ditumbu Jaya  : <?= $stocktj;  ?> klg</div>
                                                </div>
                                                <p class="mb-4"></p>
                                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ubah<?= $idproduk; ?>">
                                                    <i class="bi bi-pen-fill"></i>
                                                    Ubah
                                                </button>
                                                <button class="btn btn-dark" data-bs-dismiss="modal">
                                                    <i class="fas fa-xmark fa-fw"></i>
                                                    Keluar
                                                </button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tambah Pesanan Order Galon -->
                    <div class="modal fade" id="ubah<?= $idproduk; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Ubah Katalog <?= $namaproduk;  ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>


                                
                                <!-- Modal body -->
                                <form method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" required value="<?= $namaproduk;  ?>" required>
                                        <br>
                                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" value="<?= $deskripsi; ?>" required>
                                        <br>
                                        <input type="text" name="harga" class="form-control" placeholder="Harga Produk" value="<?= $harga; ?>" required>
                                        <br>
                                        <input type="num" name="stk_k" class="form-control" value="<?= $stockln;  ?>" required>
                                        <br>
                                        <input type="num" name="stk_t" class="form-control" value="<?= $stocktj;  ?>" required>
                                        <br>
                                        <input type="file" name="file" class="form-control">
                                        <input type="hidden" name="idp" value="<?= $idproduk; ?>">
                                    </div>
                                    
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success" name="ubahkatalog">Ubah</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Keluar</button>
                                        
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>




                    <?php  
                    }
                    ?>
                </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Katalog Cat Avian</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" required value="CAT AVIAN NO 1##" required>
                        <br>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" value="BAHAN BANGUNAN" required>
                        <br>
                        <input type="text" name="harga" class="form-control" placeholder="Harga Produk" value="78000" required>
                        <br>
                        <input type="num" name="stk_k" class="form-control" placeholder="Stock Barang Cat Kolono" required>
                        <br>
                        <input type="num" name="stk_t" class="form-control" placeholder="Stock Barang Cat Kolono Timur" required>
                        <br>
                        <input type="file" name="file" class="form-control">
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahkatalog">Tambahkan</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>

</html>