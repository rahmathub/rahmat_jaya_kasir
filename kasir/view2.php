<?php 
require 'function.php';
require 'ceklogin.php';

if(isset($_GET['idp']))  {
    $idp = $_GET['idp'];

    $ambilnamapelanggan = mysqli_query($c, "SELECT * FROM pesanan2 p, pelanggan2 pl WHERE p.idpelanggan2=pl.idpelanggan2 AND p.idorder2='$idp'");
    $np = mysqli_fetch_array($ambilnamapelanggan);
    $namapel = $np['namapelanggan2'];
} else {
    header('location:index2.php');
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
                        <h1 class="mt-4">Data Pesanan : <?= $idp;  ?></h1>
                        <h4 class="mt-4">Pelanggan : <?= $namapel;  ?></h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Barang :</div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pesanan Baru -->
                            <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Barang</i>
                                    </button>
                            </div>
                    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Sub-Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                    $get = mysqli_query($c, "SELECT * FROM detailpesanan2 p, produk2 pr WHERE p.idproduk2=pr.idproduk2 AND idpesanan2='$idp'");
                                    $i=1; 

                                    while ($p=mysqli_fetch_array($get)) {
                                        $idpr = $p['idproduk2'];
                                        $iddp = $p['iddetailpesanan2'];
                                        $stockawal = $p['qty2'];
                                        $harga = $p['harga2'];
                                        $namaproduk = $p['namaproduk2'];
                                        $desc = $p['deskripsi2'];
                                        $subtotal = $stockawal*$harga;

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
                                            <td><?= $namaproduk;  ?> (<?= $desc;  ?>)</td>
                                            <td>Rp<?= number_format($harga); ?></td>
                                            <td><?= number_format($stockawal); ?></td>
                                            <td>Rp<?= number_format($subtotal); ?></td>
                                            <td>
                                                <!-- Dua Tombol -->
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idpr; ?>">
                                                    Edit
                                                </button>
                                                
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $idpr; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                            
                                        </tr>

                                        <!-- The Modal Edit-->
                                        <div class="modal fade" id="edit<?= $idpr; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Detail Pesanan </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Apakah anda yakin mengubah data pesanan?
                                                            <!-- dolar idp ada di atas alamatnya -->
                                                            <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" value="<?= $namaproduk; ?> : <?= $desc; ?>" disabled>
                                                            <input type="number" name="qty2" class="form-control mt-2" placeholder="Stock" value="<?= $stockawal; ?>">
                                                            <input type="hidden" name="iddp2" value="<?= $iddp; ?>">
                                                            <input type="hidden" name="idpr2" value="<?= $idpr; ?>">
                                                            <input type="hidden" name="idp2" value="<?= $idp; ?>">
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahdatapesanan2">Ya</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            
                                                        </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>

                                        <!-- The Modal Delete-->
                                        <div class="modal fade" id="delete<?= $idpr; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Apakah anda yakin menghapus barang ini? </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                            Apakah anda yakin menghapus barang ini?
                                                            <!-- dolar idp ada di atas alamatnya -->
                                                            <input type="hidden" name="idp" value="<?= $iddp; ?>">
                                                            <input type="hidden" name="idpr" value="<?= $idpr; ?>">
                                                            <input type="hidden" name="idorder" value="<?= $idp; ?>">
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="hapusprodukpesanan2">Ya</button>
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
                    <h4 class="modal-title">Tambah Barang </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                        Pilih Barang
                        <select name="idproduk" class="form-control">


                            <?php  
                            $getproduk = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2 NOT IN (SELECT idproduk2 FROM detailpesanan2 WHERE idpesanan2='$idp')");
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
                        <input type="hidden" name="idp" value="<?= $idp; ?>">
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="addproduk2">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>

</html>
