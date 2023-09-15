<?php 
require 'function.php';
require 'ceklogin.php';

// hitung jumlah nota barang
$h1 = mysqli_query($c, "SELECT * FROM nota");
$h2 = mysqli_num_rows($h1); //jumlah pesanan


// tambah nota barang
if(isset($_POST['tambahkannota']))  {
    $jenisproduk = $_POST['jenisproduk'];
    $namapemberinota = $_POST['namapemberinota'];
    $namapenerimanota = $_POST['namapenerimanota'];

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
                move_uploaded_file($file_tmp, 'nota/'.$image);
    
                $addtable = mysqli_query($c, "INSERT INTO nota (images,jenisproduk,pemberinota,penerimanota
                                ) VALUES ('$image','$jenisproduk','$namapemberinota','$namapenerimanota')");;

                $updatenota = mysqli_query($c, "UPDATE nota SET status='BELUM PENGECEKAN'");
    
                if($addtable&&$updatenota)   {
                    header('location:cek_nota_barang.php');
                } else {
                    echo "Gagal Menambah Nota Baru";
                    header('location:cek_nota_barang.php');
                }
            } else {
                // kalau filenya dari 15 mb
                echo '  
                <script>
                alert("Ukuran terlalu besar");
                window.location.href="cek_nota_barang.php";
                </script>
                ';
            }
        } else {
            // kalau gambar filex tidak png atau jpg
            echo '
            <script>
                alert("File Harus png/jpg");
                window.location.href="cek_nota_barang.php";
            </script>
            ';
    
        }




    // 
    // $insernota = mysqli_query($c, "INSERT INTO nota (idpelanggan,harga,qty,total_harga) VALUES ('$idp','$harga','$qty','$total_harga')");
    
    // if($updatenota&&$insernota)   {
    //     // jika berhasil
    //     echo '
    //     <script>  
    //         alert("Berhasil ditambahkan si order");
    //         window.location.href="galon.php"
    //     </script>
    //     ';
    // } else {
    //     echo '
    //     <script>  
    //         alert("Gagal ditambahkan si order");
    //         window.location.href="galon.php"
    //     </script>
    //     ';

    // }
}

// mengubah status
if(isset($_POST['selesai']))  {
    $idn = $_POST['idnota'];
    
    $update_status = mysqli_query($c, "UPDATE nota SET status='SELESAI PENGECEKAN' WHERE idnota='$idn'");

    if($update_status)  {
            // jika berhasil
            echo '
            <script>  
                alert("Berhasil PENGECEKAN");
                window.location.href="cek_nota_barang.php"
            </script>
            ';
        } else {
            echo '
            <script>  
                alert("GAGAL PENGECEKAN NOTA");
                window.location.href="cek_nota_barang.php"
            </script>
            ';
        }
    
}

//mengubah data nota
if(isset($_POST['ubahnota']))  {
    $idn = $_POST['idn'];
    $jp = $_POST['jenisproduk'];
    $pn = $_POST['namapemberinota'];
    $npn = $_POST['namapenerimanota'];

    
    $update_data = mysqli_query($c, "UPDATE nota SET jenisproduk='$jp', pemberinota='$pn', penerimanota='$npn' WHERE idnota='$idn'");

    if($update_data)  {
            // jika berhasil
            echo '
            <script>  
                alert("Berhasil Mengubah Data Nota");
                window.location.href="cek_nota_barang.php"
            </script>
            ';
        } else {
            echo '
            <script>  
                alert("GAGAL Mengubah Nota");
                window.location.href="cek_nota_barang.php"
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
        <title>Cek Nota Barang</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .kl{
                font-weight: bold;
            }

            .zoomable{
                width: 100px;
                height: 100px;
            }
            .zoomable:hover{
                transform: scale(1,2);
                transition: 0.3s ease;
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
                        <h1 class="mt-4" style="text-align: center">Daftar Nota Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Nota : <?= $h2; ?></div>
                                </div>
                            </div>

                            <!-- Tombol Tambah Pesanan Baru -->
                                <div class="container mt-3">
                                    <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="bi bi-clipboard-plus" style="font-style: normal;"> Tambah Nota Baru</i>
                                    </button>
                                    &nbsp
                                    <!-- <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#langganan">
                                            <i class="bi bi-bookmark-star" style="font-style: normal;" > Kelola Langganan</i>
                                    </button> -->

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
                                            <th>No</th>
                                            <th>Tanggal Terima Nota</th>
                                            <th>Foto Nota Bukti</th>
                                            <th>Jenis Produk</th>
                                            <th>Nama Pemberi Nota</th>
                                            <th>Nama Penerima Nota</th>
                                            <th>Status Pengecekan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  

                                    $get = mysqli_query($c, "SELECT * FROM nota");
                                    $i = 1;

                                    while ($p=mysqli_fetch_array($get)) {
                                        $idnota = $p['idnota'];
                                        $tanggal = $p['tgltrimanota'];
                                        $jenisproduk = $p['jenisproduk'];
                                        $pemberinota = $p['pemberinota'];
                                        $penerimanota = $p['penerimanota'];
                                        $status = $p['status'];

                                        // cek gambar atau tdk ada
                                        $gambar = $p['images'];
                                        if($gambar == null) {
                                            //jika tidak ada gambar
                                            $img = 'No Photo';
                                        } else {
                                            // jika ada gambar
                                            $img = '<img src="nota/'.$gambar.'" class="zoomable">';
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $i++;  ?></td>
                                            <td><?= $tanggal;  ?></td>
                                            <td><a href="nota/<?= $gambar; ?>"><?= $img;  ?></a></td>
                                            <th><?= $jenisproduk;  ?></th>
                                            <td><?= $pemberinota;  ?></td>
                                            <th><?= $penerimanota;  ?></th>
                                            <th><?= $status;  ?></th>
                                            <th>
                                            <?php  
                                            // cek status
                                            if($status=='BELUM PENGECEKAN'){
                                                echo '
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#selesai'.$idnota.'">
                                                    selesai
                                                </button>
                                                    ';
                                            } else {
                                                // Jika statusnya bukan di sudah selesai pengecekan (Selesai Pengecekan)
                                            }
                                            ?>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubah<?= $idnota; ?>">
                                                    ubah
                                                </button>
                                            </th>
                                        </tr>

                                            <!-- The Modal Selesai -->
                                            <div class="modal fade" id="selesai<?= $idnota; ?>">
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
                                                            Apakah Barang ini sudah selesai dicek notanya?   
                                                            <br>
                                                                <input type="hidden" name="idnota" value="<?= $idnota; ?>" >
                                                            </div>
                                                            

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success" name="selesai">Ya</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                                
                                                            </div>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <!-- The Modal Ubah Nota -->
                                        <div class="modal fade" id="ubah<?= $idnota; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ubah Data Nota Barang </h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>


                                                    
                                                    <!-- Modal body -->
                                                    <form method="post">
                                                        <div class="modal-body">
                                                        Apakah anda yakin ingin Mengubah Nota Ini?   
                                                        <br>
                                                            <input type="hidden" name="idn" value="<?= $idnota; ?>" >
                                                        <br>
                                                        Jenis Produk
                                                            <input type="text" name="jenisproduk" class="form-control" value="<?= $jenisproduk; ?>" required>
                                                        <br>
                                                        Pemberi Nota
                                                            <input type="text" name="namapemberinota" class="form-control" value="<?= $pemberinota; ?>" required> 
                                                        <br>
                                                        Penerima Nota
                                                            <input type="text" name="namapenerimanota" class="form-control" value="<?= $penerimanota; ?>" required>
                                                        </div>
                                                        

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" name="ubahnota">Ubah</button>
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
    
    <!-- Tambahkann Nota Baru -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambahkan Nota Barang Baru</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>


                
                <!-- Modal body -->
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="file" name="file" class="form-control">
                        <br>
                        <input type="text" name="jenisproduk" class="form-control" placeholder="Jenis Produk" required>
                        <br>
                        <input type="text" name="namapemberinota" class="form-control" placeholder="Nama Pemberi Nota" required>
                        <br>
                        <input type="text" name="namapenerimanota" class="form-control" placeholder="Nama Penerima Nota" required>
                        <br>
                    </div>
                    

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahkannota">Submit</button>
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
