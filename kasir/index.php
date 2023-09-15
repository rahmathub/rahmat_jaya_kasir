<?php 
require 'function.php';
require 'ceklogin.php';

// hitung jumlah pesanan
$h1 = mysqli_query($c, "SELECT * FROM pesanan");
$h2 = mysqli_num_rows($h1); //jumlah pesanan



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Pesanan Kelurahan Kolono</title>
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
                        <h1 class="mt-4">Data Pesanan Kelurahan Kolono</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pesanan : <?= $h2; ?></div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pesanan Baru -->
                            <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Pesanan Baru</i>
                                    </button>
                            </div>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                    $get = mysqli_query($c, "SELECT * FROM pesanan p, pelanggan pl WHERE p.idpelanggan=pl.idpelanggan");

                                    while ($p=mysqli_fetch_array($get)) {
                                        $idorder = $p['idorder'];
                                        $tanggal = $p['tanggal'];
                                        $namapelanggan = $p['namapelanggan'];
                                        $alamat = $p['alamat'];

                                        // hitung jumlah
                                        $hitungjumlah = mysqli_query($c, "SELECT * FROM detailpesanan WHERE idpesanan='$idorder'");
                                        $jumlah = mysqli_num_rows($hitungjumlah);
                                        
                                    
                                    ?>
                                        <tr>
                                            <td><?= $idorder;  ?></td>
                                            <td><?= $tanggal;  ?></td>
                                            <td><?= $namapelanggan;  ?> - <?= $alamat;  ?></td>
                                            <td><?= $jumlah;  ?></td>
                                            <td><a href="view.php?idp=<?= $idorder; ?>" class="btn btn-primary" target="blank">Tampilkan</a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idorder; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                            
                                        </tr>

                                        <!-- The Modal Delete -->
                                        <div class="modal fade" id="delete<?= $idorder; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Pesanan </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus Data Pesanan Ini?   
                                                        <br>
                                                            <input type="hidden" name="ido" value="<?= $idorder; ?>" >
                                                            
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusorder">Hapus</button>
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
                    <h4 class="modal-title">Tambah Pesanan Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        Pilih Pelanggan
                        <select name="idpelanggan" class="form-control">


                            <?php  
                            $getpelanggan = mysqli_query($c, "SELECT * FROM pelanggan");
                            while($pl=mysqli_fetch_array($getpelanggan)){
                                $namapelanggan = $pl['namapelanggan'];
                                $idpelanggan = $pl['idpelanggan'];
                                $alamat = $pl['alamat'];
                            
                            ?>

                            <option value="<?= $idpelanggan; ?>"><?= $namapelanggan;  ?> - <?= $alamat; ?></option>

                            <?php 
                            }
                            
                            
                            ?>


                        </select>
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahpesanan">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>

</html>
