<?php 
require 'function.php';
require 'ceklogin.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Masuk</title>
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
                        <h1 class="mt-4">Data Barang Masuk</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>

                        <!-- Tombol Tambah Pesanan Baru -->
                        <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Barang Masuk</i>
                                    </button>
                        </div>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Barang Masuk
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php  
                                    $get = mysqli_query($c, "SELECT * FROM masuk2 m, produk2 p WHERE m.idproduk2=p.idproduk2");
                                    $i = 1;

                                    // arraynya di ambil di database
                                    while ($p=mysqli_fetch_array($get)) {
                                        $namaproduk = $p['namaproduk2'];
                                        $deskripsi = $p['deskripsi2'];
                                        $qty = $p['qty2'];
                                        $tanggal = $p['tanggalmasuk2'];
                                        $idmasuk = $p['idmasuk2'];
                                        $idproduk = $p['idproduk2'];

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
                                            <td><?= $namaproduk;?> : <?= $deskripsi;  ?></td>
                                            <td><?= $qty;  ?></td>
                                            <td><?= $tanggal;  ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idmasuk; ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idmasuk; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- The Modal Edit -->
                                        <div class="modal fade" id="edit<?= $idmasuk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah data barang masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" required value="<?= $namaproduk;?> : <?= $deskripsi;  ?>" disabled>
                                                            <br>
                                                            <input type="number" name="qty" class="form-control" placeholder="Quantity" required value="<?= $qty; ?>">
                                                            <br>
                                                            <input type="hidden" name="idm" value="<?= $idmasuk; ?>" >
                                                            <input type="hidden" name="idp" value="<?= $idproduk; ?>" >
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="editbarangmasuk2">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Modal Delete -->
                                        <div class="modal fade" id="delete<?= $idmasuk; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Barang Masuk</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus barang masuk  
                                                        <br>
                                                            <input type="hidden" name="idp" value="<?= $idproduk; ?>" >
                                                            <input type="hidden" name="idm" value="<?= $idmasuk; ?>" >
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusbarangmasuk2">Hapus</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                    <?php  
                                    
                                    }; // end of while
                                    
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

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Masuk </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        Pilih Barang
                        <select name="idproduk" class="form-control">


                            <?php  
                            $getproduk = mysqli_query($c, "SELECT * FROM produk2");
                            while($pl=mysqli_fetch_array($getproduk)){
                                $namaproduk = $pl['namaproduk2'];
                                $stock = $pl['stock2'];
                                $deskripsi = $pl['deskripsi2'];
                                $idproduk = $pl['idproduk2'];
                            
                            ?>

                            <option value="<?= $idproduk; ?>"><?= $namaproduk;  ?> - <?= $deskripsi; ?> (Stock: <?= $stock; ?>)</option>

                            <?php 
                            }
                            
                            
                            ?>


                        </select>

                        <input type="number" name="qty" class="form-control mt-4" placeholder="Jumlah" min="1" required>

                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="barangmasuk2">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>
</html>
