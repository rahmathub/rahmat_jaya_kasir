<?php 
require 'function.php';
require 'ceklogin.php';
// hitung jumlah barang
$h1 = mysqli_query($c, "SELECT * FROM produk2");
$h2 = mysqli_num_rows($h1); //jumlah barang
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stock Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px;
                height: 100px;
            }
            .zoomable:hover{
                transform: scale(1,2);
                transition: 0.3s ease;
            }

            a{
                text-decoration:none;
                color: black;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
                        <h1 class="mt-4">Stock Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Barang : <?= $h2;  ?></div> 
                                    </div>
                                </div>
                            </div>

                            <!-- tombol -->
                            <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Barang Baru</i>
                                    </button>
                            </div>

                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Barang
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Harga</th>
                                            <th>Harga Diskon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php  
                                    $get = mysqli_query($c, "SELECT * FROM produk2");
                                    $i = 1;

                                    // ambil array di database
                                    while ($p=mysqli_fetch_array($get)) {
                                        $namaproduk = $p['namaproduk2'];
                                        $deskripsi = $p['deskripsi2'];
                                        $hargaproduk = $p['harga2'];
                                        $stockawal = $p['stock2'];
                                        $idproduk = $p['idproduk2'];
                                        $diskon = $p['harga_diskon2'];

                                        // cek gambar atau tdk ada
                                        $gambar = $p['images2'];
                                        if($gambar == null) {
                                            //jika tidak ada gambar
                                            $img = 'No Photo';
                                        } else {
                                            // jika ada gambar
                                            $img = '<img src="images2/'.$gambar.'" class="zoomable">';
                                        }
                                    
                                    ?>
                                        <tr>
                                            <td><?= $i++;  ?></td>
                                            <td><?= $img;  ?></td>
                                            <td><?= $namaproduk;  ?></td>
                                            <td><?= $deskripsi;  ?></td>
                                            <td><?= $stockawal;  ?></td>
                                            <td>Rp<?= number_format($hargaproduk);  ?></td>
                                            <td><s>Rp<?= number_format($diskon);  ?></s></td>
                                            <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idproduk; ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idproduk; ?>">
                                                Delete
                                            </button>
                                            </td>
                                        </tr>

                                        <!-- The Modal Edit -->
                                        <div class="modal fade" id="edit<?= $idproduk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah <?= $namaproduk; ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" required value="<?= $namaproduk; ?>" >
                                                            <br>
                                                            <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required value="<?= $deskripsi; ?>">
                                                            <br>
                                                            <input type="text" name="harga" class="form-control" placeholder="Harga Produk" required value="<?= $hargaproduk; ?>">
                                                            <br>
                                                            <input type="text" name="diskon" class="form-control" placeholder="Harga Produk" required value="<?= $diskon; ?>">
                                                            <br>
                                                            <input type="file" name="file" class="form-control">
                                                            <br>
                                                            <input type="hidden" name="idp" value="<?= $idproduk; ?>" >
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="editbarangstock2">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Modal Delete -->
                                        <div class="modal fade" id="delete<?= $idproduk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus <?= $namaproduk; ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus barang ini    
                                                        <br>
                                                            <input type="hidden" name="idp" value="<?= $idproduk; ?>" >
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusbarang2">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    
                                    <?php  

                                    ;} // end of while

                                    ?>


                                    </tbody>
                                </table>
                            </div>
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

    <!-- The Modal Tambah Barang Baru -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="file" name="file" class="form-control">
                        <br>
                        <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" required >
                        <br>
                        <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                        <br>
                        <input type="num" name="stock" class="form-control" placeholder="Stock Awal" required>
                        <br>
                        <input type="text" name="harga" class="form-control" placeholder="Harga Produk" required>
                        <br>
                        <input type="text" name="diskon" class="form-control" placeholder="Harga Diskon" required>
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahbarangstock2">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>
</html>
