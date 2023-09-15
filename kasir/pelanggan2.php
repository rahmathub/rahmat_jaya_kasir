<?php 
require 'function.php';
require 'ceklogin.php';

// hitung jumlah pelanggan
$h1 = mysqli_query($c, "SELECT * FROM pelanggan2");
$h2 = mysqli_num_rows($h1); //jumlah pelanggan
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Kelola Pelanggan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
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
                        <h1 class="mt-4">Data Pelanggan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pelanggan : <?= $h2; ?></div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pesanan Baru -->
                            <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Pelanggan Baru</i>
                                    </button>
                            </div>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pelanggan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                    $get = mysqli_query($c, "SELECT * FROM pelanggan2");
                                    $i=1;
                                    while ($p=mysqli_fetch_array($get)) {
                                        $namapelanggan = $p['namapelanggan2'];
                                        $notelp = $p['notelp2'];
                                        $alamat = $p['alamat2'];
                                        $idpl = $p['idpelanggan2']
                                    
                                    ?>
                                        <tr>
                                            <td><?= $i++;  ?></td>
                                            <td><?= $namapelanggan;  ?></td>
                                            <td><?= $notelp;  ?></td>
                                            <td><?= $alamat;  ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idpl; ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idpl; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                            
                                        </tr>

                                        
                                        <!-- The Modal Edit -->
                                        <div class="modal fade" id="edit<?= $idpl; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah <?= $namapelanggan; ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            <input type="text" name="namapelanggan" class="form-control" placeholder="Nama Pelanggan" required value="<?= $namapelanggan; ?>" >
                                                            <br>
                                                            <input type="text" name="notelp" class="form-control" placeholder="Deskripsi" required value="<?= $notelp; ?>">
                                                            <br>
                                                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" required value="<?= $alamat; ?>">
                                                            <br>
                                                            <input type="hidden" name="idp" value="<?= $idpl; ?>" >
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="editpelanggan2">Ubah</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Modal Delete -->
                                        <div class="modal fade" id="delete<?= $idpl; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus <?= $namapelanggan; ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus barang ini    
                                                        <br>
                                                            <input type="hidden" name="idp" value="<?= $idpl; ?>" >
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapuspelanggan2">Hapus</button>
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

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data Pelanggan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        <input type="text" name="namapelanggan" class="form-control" placeholder="Nama Pelanggan" required >
                        <br>
                        <input type="number" name="notelp" class="form-control" placeholder="No Telepon" required>
                        <br>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahpelanggan2">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>

</html>
