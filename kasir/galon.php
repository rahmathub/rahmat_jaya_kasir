<?php 
require 'function.php';
require 'ceklogin.php';

// hitung jumlah pesanan
$h1 = mysqli_query($c, "SELECT * FROM galon");
$h2 = mysqli_num_rows($h1); //jumlah pesanan

// Jumlah Harga Langganan Galon
$totalawal = mysqli_query($c, "SELECT SUM(total_harga) FROM galon"); 
$m=mysqli_fetch_column($totalawal);

// tambah pesanan galon
if(isset($_POST['addordergalon']))  {
    $idp = $_POST['idpelanggan'];
    $harga = $_POST['price'];
    $qty = $_POST['stock'];

    $total_harga = $qty*$harga;

    $updategalon = mysqli_query($c, "UPDATE galon SET status='BELUM' WHERE idorder='$idp'");
    $insergalon = mysqli_query($c, "INSERT INTO galon (idpelanggan,harga,qty,total_harga) VALUES ('$idp','$harga','$qty','$total_harga')");
    
    if($updategalon&&$insergalon)   {
        // jika berhasil
        echo '
        <script>  
            alert("Berhasil ditambahkan si order");
            window.location.href="galon.php"
        </script>
        ';
    } else {
        echo '
        <script>  
            alert("Gagal ditambahkan si order");
            window.location.href="galon.php"
        </script>
        ';

    }
}

if(isset($_POST['lunas']))  {
    $ido = $_POST['ido'];
    
    $update_status = mysqli_query($c, "UPDATE galon SET status='LUNAS' WHERE idorder='$ido'");

    if($update_status)  {
            // jika berhasil
            echo '
            <script>  
                alert("Berhasil MELUNASKAN");
                window.location.href="galon.php"
            </script>
            ';
        } else {
            echo '
            <script>  
                alert("GAGAL DILUNASKAN");
                window.location.href="galon.php"
            </script>
            ';
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
        <title>Data Galon Orderan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .kl{
                font-weight: bold;
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
                        <h1 class="mt-4" style="text-align: center">Data Order Langganan Galon</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Orderan : <?= $h2; ?></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Total Harga Langganan Galon = Rp<?= number_format($m); ?></div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pesanan Baru -->
                            <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Pesanan Galon Baru</i>
                                    </button>
                                    &nbsp
                                    <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#langganan">
                                            <i class="bi bi-bookmark-star" style="font-style: normal;" > Kelola Langganan</i>
                                    </button>
                                    </div>
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
                                            <th>Nama Pelanggan - Alamat</th>
                                            <th>Harga/Galon</th>
                                            <th>Quantity</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                    $get = mysqli_query($c, "SELECT * FROM galon g, pelanggan pl WHERE g.idpelanggan=pl.idpelanggan ORDER BY idorder DESC");

                                    while ($p=mysqli_fetch_array($get)) {
                                        $idorder = $p['idorder'];
                                        $tanggal = $p['tanggal'];
                                        $namapelanggan = $p['namapelanggan'];
                                        $alamat = $p['alamat'];
                                        $harga_galon = $p['harga'];
                                        $qty = $p['qty'];
                                        $total = $p['total_harga'];
                                        $status = $p['status'];

                                        
                                        
                                        
                                    
                                    ?>
                                        <tr>
                                            <td><?= $idorder;  ?></td>
                                            <td><?= $tanggal;  ?></td>
                                            <td><?= $namapelanggan;  ?> - <?= $alamat;  ?></td>
                                            <th>Rp<?= number_format($harga_galon);  ?></th>
                                            <td><?= $qty;  ?></td>
                                            <th>Rp<?= number_format($total);  ?></th>
                                            <th><?= $status;  ?></th>
                                            <td>
                                            <?php  
                                            // cek status
                                            if($status=='BELUM'){
                                                echo '
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selesai'.$idorder.'">
                                                    selesai
                                                </button>
                                                    ';
                                            } else {
                                                // Jika statusnya bukan di pinjam (Sudahh kembali)
                                            }

                                            
                                            ?>
                                        </tr>
                                        

                                            <!-- The Modal Selesai -->
                                            <div class="modal fade" id="selesai<?= $idorder; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Selesaikan </h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>


                                                        
                                                        <!-- Modal body -->
                                                        <form method="post">
                                                            <div class="modal-body">
                                                            Apakah Barang ini sudah selesai?   
                                                            <br>
                                                                <input type="hidden" name="ido" value="<?= $idorder; ?>" >
                                                            </div>
                                                            

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success" name="lunas">Ya</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <?php
                                        
                                        
                                        ?>
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

                                    <tr>
                                        <td colspan="8" class="kl">Jumlah Total Semua Keuangan Langganan : Rp<?= number_format($m); ?></td>
                                    </tr>


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

    <!-- Tambah Pesanan Order Galon -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Orderan Galon Baru</h4>
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
                        <br>
                        <input type="text" name="price" class="form-control" placeholder="Harga Galon" required>
                        <br>
                        <input type="num" name="stock" class="form-control" placeholder="Quantity" required>
                        <br>
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="addordergalon">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        
                    </div>
                </form>


            </div>
        </div>
    </div>



        <!-- Kelola Langganan -->
    <div class="modal fade" id="langganan">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3>Kelola Langganan Galon Baru</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post">
                    <div class="modal-body">
                    <p style="text-align:center">Untuk Menambah Langganan Baru Silahkan Cek Daftarnya</p>
                    <h4 style="text-align:center"><i class="bi bi-bag-plus-fill"><a href="pelanggan.php" target="blank">KLIK DISINI</a></i></h4>
                    
                </form>


            </div>
        </div>
    </div>


</html>
