<?php  

session_start();
// koneksi ke database
$c= mysqli_connect('localhost', 'u1593493_kasir', 'Kolono12@', 'u1593493_kasir');

// login
if(isset($_POST['login']))  {
    // initiate variabel
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($c, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung > 0) {
        // jika datax ditemukan
        // berhasil login
        $_SESSION['login'] = 'True';
        header('location:index.php');
    } else {  
        // data tidak ditemukan
        // gagal login
        echo '
        <script>
            alert("Password yang anda masukkan salah");
            window.location.href="login.php";
        </script>
            ';
    }
}


// Tambah barang Stock 
if(isset($_POST['tambahbarangstock']))  {
    $namaproduk = $_POST['namaproduk'];
    $deskripsi = $_POST['deskripsi'];
    $stockawal = $_POST['stock'];
    $hargaproduk = $_POST['harga'];
    $diskon = $_POST['diskon'];
    

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
            move_uploaded_file($file_tmp, 'images/'.$image);

            $addtable = mysqli_query($c, "INSERT INTO produk (images,namaproduk,deskripsi,harga,harga_diskon,stock) VALUES('$image','$namaproduk','$deskripsi','$hargaproduk','$diskon','$stockawal')");

            if($addtable)   {
                header('location:stock.php');
            } else {
                echo "Gagal Menambah Barang Baru";
                header('location:stock.php');
            }
        } else {
            // kalau filenya dari 15 mb
            echo '  
            <script>
            alert("Ukuran terlalu besar");
            window.location.href="stock.php";
            </script>
            ';
        }
    } else {
        // kalau gambar filex tidak png atau jpg
        echo '
        <script>
            alert("File Harus png/jpg");
            window.location.href="stock.php";
        </script>
        ';

    }
}

// Tambah barang Stock2 
if(isset($_POST['tambahbarangstock2']))  {
    $namaproduk = $_POST['namaproduk'];
    $deskripsi = $_POST['deskripsi'];
    $stockawal = $_POST['stock'];
    $hargaproduk = $_POST['harga'];
    $diskon = $_POST['diskon'];
    

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
            move_uploaded_file($file_tmp, 'images2/'.$image);

            $addtable = mysqli_query($c, "INSERT INTO produk2 (images2,namaproduk2,deskripsi2,harga2,harga_diskon2,stock2) VALUES('$image','$namaproduk','$deskripsi','$hargaproduk','$diskon','$stockawal')");

            if($addtable)   {
                header('location:stock2.php');
            } else {
                echo "Gagal Menambah Barang Baru";
                header('location:stock.php');
            }
        } else {
            // kalau filenya dari 15 mb
            echo '  
            <script>
            alert("Ukuran terlalu besar");
            window.location.href="stock2.php";
            </script>
            ';
        }
    } else {
        // kalau gambar filex tidak png atau jpg
        echo '
        <script>
            alert("File Harus png/jpg");
            window.location.href="stock2.php";
        </script>
        ';

    }
}

// Tambah Pelanggan
if(isset($_POST['tambahpelanggan']))    {
    $namapelanggan = $_POST['namapelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($c, "INSERT INTO pelanggan (namapelanggan,notelp,alamat) VALUES ('$namapelanggan','$notelp','$alamat')");

    if($insert) {
        header('location:pelanggan.php');
    } else {
        echo '
        <script>
            alert("Gagal Menambah Pelanggan Baru");
            window.location.href="pelanggan.php";
        </script>
            ';
    }
}

// Tambah Pelanggan2
if(isset($_POST['tambahpelanggan2']))    {
    $namapelanggan = $_POST['namapelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($c, "INSERT INTO pelanggan2 (namapelanggan2,notelp2,alamat2) VALUES ('$namapelanggan','$notelp','$alamat')");

    if($insert) {
        header('location:pelanggan2.php');
    } else {
        echo '
        <script>
            alert("Gagal Menambah Pelanggan Baru");
            window.location.href="pelanggan2.php";
        </script>
            ';
    }
}

// Tambah Pesanan
if(isset($_POST['tambahpesanan']))    {
    $idpelanggan = $_POST['idpelanggan'];

    $insert = mysqli_query($c, "INSERT INTO pesanan (idpelanggan) VALUES ('$idpelanggan')");

    if($insert) {
        header('location:index.php');
    } else {
        echo '
        <script>
            alert("Gagal Menambah Pesanan Baru");
            window.location.href="index.php";
        </script>
            ';
    }
}

// Tambah Pesanan2
if(isset($_POST['tambahpesanan2']))    {
    $idpelanggan = $_POST['idpelanggan'];

    $insert = mysqli_query($c, "INSERT INTO pesanan2 (idpelanggan2) VALUES ('$idpelanggan')");

    if($insert) {
        header('location:index2.php');
    } else {
        echo '
        <script>
            alert("Gagal Menambah Pesanan Baru");
            window.location.href="index2.php";
        </script>
            ';
    }
}

// Tambah Pesanan di file view
if(isset($_POST['addproduk']))    {
    $idproduk = $_POST['idproduk'];
    $idp = $_POST['idp']; // id pesanaan
    $qty = $_POST['qty']; // jumlah yang mau di keluarin

    // hitung stock sekarang ada berapa 
    $hitung1 = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idproduk'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stocksekarang = $hitung2['stock']; // stock brang saat ini

    if($stocksekarang>=$qty)  {
        // kurangi stocknya dengan jumlah yang akan di keluarkan
        $selisih = $stocksekarang-$qty;

        // stock cukup
        $insert = mysqli_query($c, "INSERT INTO detailpesanan (idpesanan,idproduk,qty) VALUES ('$idp','$idproduk','$qty')");
        $update = mysqli_query($c, "UPDATE produk SET stock='$selisih' WHERE idproduk='$idproduk'");

        if($insert&&$update) {
            header('location:view.php?idp='.$idp);
            

        } else {
            echo '
            <script>
                alert("Gagal Menambah Pesanan Baru");
                window.location.href="view.php?idp='.$idp.'";
            </script>
                ';
        }
    } else {
        // stock ga cukup
        echo '
            <script>
                alert("Stock barang tidak cukup");
                window.location.href="view.php?idp='.$idp.'";
            </script>
                ';
    }
}

// Tambah Pesanan di file view2
if(isset($_POST['addproduk2']))    {
    $idproduk = $_POST['idproduk'];
    $idp = $_POST['idp']; // id pesanaan
    $qty = $_POST['qty']; // jumlah yang mau di keluarin

    // hitung stock sekarang ada berapa 
    $hitung1 = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idproduk'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stocksekarang = $hitung2['stock2']; // stock brang saat ini

    if($stocksekarang>=$qty)  {
        // kurangi stocknya dengan jumlah yang akan di keluarkan
        $selisih = $stocksekarang-$qty;

        // stock cukup
        $insert = mysqli_query($c, "INSERT INTO detailpesanan2 (idpesanan2,idproduk2,qty2) VALUES ('$idp','$idproduk','$qty')");
        $update = mysqli_query($c, "UPDATE produk2 SET stock2='$selisih' WHERE idproduk2='$idproduk'");

        if($insert&&$update) {
            header('location:view2.php?idp='.$idp);
            

        } else {
            echo '
            <script>
                alert("Gagal Menambah Pesanan Baru");
                window.location.href="view2.php?idp='.$idp.'";
            </script>
                ';
        }
    } else {
        // stock ga cukup
        echo '
            <script>
                alert("Stock barang tidak cukup");
                window.location.href="view2.php?idp='.$idp.'";
            </script>
                ';
    }
}


// Tambah barang Masuk
if(isset($_POST['barangmasuk']))    {
    $qty = $_POST['qty'];
    $idproduk = $_POST['idproduk'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idproduk'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock'];

    // hitung
    $newstock = $stockskrg+$qty;



    $insertbarangmasuk = mysqli_query($c, "INSERT INTO masuk (idproduk,qty) VALUES ('$idproduk','$qty')");
    $updatetb = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idproduk'");

    if($insertbarangmasuk&&$updatetb)  {
        header('location:masuk.php');
    } else {
        // jika stok tidak cukup
        echo '
        <script>
                alert("Stock barang tidak cukup");
                window.location.href="masuk.php"
        </script>
                ';
    }
}

// Tambah barang Masuk2
if(isset($_POST['barangmasuk2']))    {
    $qty = $_POST['qty'];
    $idproduk = $_POST['idproduk'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idproduk'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock2'];

    // hitung
    $newstock = $stockskrg+$qty;



    $insertbarangmasuk = mysqli_query($c, "INSERT INTO masuk2 (idproduk2,qty2) VALUES ('$idproduk','$qty')");
    $updatetb = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idproduk'");

    if($insertbarangmasuk&&$updatetb)  {
        header('location:masuk2.php');
    } else {
        // jika stok tidak cukup
        echo '
        <script>
                alert("Stock barang tidak cukup");
                window.location.href="masuk2.php"
        </script>
                ';
    }
}

// hapus produk detailpesanan
if(isset($_POST['hapusprodukpesanan'])) {
    $idpr = $_POST['idpr']; // id detailpesanan
    $idp = $_POST['idp'];
    $idorder = $_POST['idorder'];

    // Cek qty Sekarang
    $cek1 = mysqli_query($c, "SELECT * FROM detailpesanan WHERE iddetailpesanan='$idp'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty'];

    // cek stock sekarang
    $cek3 = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);

    // di table produk ada kolom stock 
    $stockskrg = $cek4['stock'];

    $hitung = $stockskrg + $qtysekarang;

    $update = mysqli_query($c, "UPDATE produk SET stock='$hitung' WHERE idproduk='$idpr'"); // update stock
    $hapus = mysqli_query($c, "DELETE FROM detailpesanan WHERE idproduk='$idpr' AND iddetailpesanan='$idp'");

    if($update&&$hapus) {
        header('location:view.php?idp='.$idorder);
    } else {
        echo '
        <script>
            alert("Gagal Menghapus Barangs");
            window.location.href="view.php?idp='.$idorder.'"
        </script>
            ';
    }
}

// hapus produk detailpesanan2
if(isset($_POST['hapusprodukpesanan2'])) {
    $idpr = $_POST['idpr']; // id detailpesanan2
    $idp = $_POST['idp'];
    $idorder = $_POST['idorder'];

    // Cek qty Sekarang
    $cek1 = mysqli_query($c, "SELECT * FROM detailpesanan2 WHERE iddetailpesanan2='$idp'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty2'];

    // cek stock sekarang
    $cek3 = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);

    // di table produk ada kolom stock 
    $stockskrg = $cek4['stock2'];

    $hitung = $stockskrg + $qtysekarang;

    $update = mysqli_query($c, "UPDATE produk2 SET stock2='$hitung' WHERE idproduk2='$idpr'"); // update stock
    $hapus = mysqli_query($c, "DELETE FROM detailpesanan2 WHERE idproduk2='$idpr' AND iddetailpesanan2='$idp'");

    if($update&&$hapus) {
        header('location:view2.php?idp='.$idorder);
    } else {
        echo '
        <script>
            alert("Gagal Menghapus Barangs");
            window.location.href="view2.php?idp='.$idorder.'"
        </script>
            ';
    }
}

// edit barang stock
if(isset($_POST['editbarangstock']))    {
    $np = $_POST['namaproduk'];
    $desc = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp']; //idproduk
    $dk = $_POST['diskon']; //harga diskon

    $allowed_ekstension = array('png','jpg');
    $nama = $_FILES['file']['name']; //ngambil nama gambar
    $dot = explode('.', $nama);
    $extensi = strtolower(end($dot)); //ngambil ekstensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi filenya
    
    // penamaan file gambar menggunakan enkripsi
    $image = md5(uniqid($nama, true) . time()).'.'.$extensi; //menggabungkan nama file yang di enkripsi dengan ekstensinya

    if($ukuran==0){
        // Jika tidak ingin di upload
        $update = mysqli_query($c, "UPDATE produk SET namaproduk='$np', deskripsi='$desc', harga='$harga',harga_diskon='$dk' WHERE idproduk='$idp'");
        if($update) {
            echo '
            <script>
                alert("Berhasil Mengubah Barang Stock");
                window.location.href="stock.php";
            </script>
            ';
        } else {
            echo "Gagal Edit";
            header('location:stock.php');
        }
    } else {
        // jika ingin
        move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($c, "UPDATE produk SET namaproduk='$np', deskripsi='$desc', harga='$harga',harga_diskon='$dk', images='$image' WHERE idproduk='$idp'");
        if($update) {
            echo '
            <script>
                alert("Berhasil Mengubah Barang Stock");
                window.location.href="stock.php";
            </script>
            ';
        } else {
            echo "Gagal Edit";
            header('location:stock.php');
        }

    }

}

// edit barang stock2
if(isset($_POST['editbarangstock2']))    {
    $np = $_POST['namaproduk'];
    $desc = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $idp = $_POST['idp']; //idproduk
    $dk = $_POST['diskon']; //harga diskon

    $allowed_ekstension = array('png','jpg');
    $nama = $_FILES['file']['name']; //ngambil nama gambar
    $dot = explode('.', $nama);
    $extensi = strtolower(end($dot)); //ngambil ekstensinya
    $ukuran = $_FILES['file']['size']; //ngambil size filenya
    $file_tmp = $_FILES['file']['tmp_name']; //ngambil lokasi filenya

    if(file_exists("images2/$nama"))    {
        unlink("images2/$nama");
    }
    
    // penamaan file gambar menggunakan enkripsi
    $image = md5(uniqid($nama, true) . time()).'.'.$extensi; //menggabungkan nama file yang di enkripsi dengan ekstensinya

    if($ukuran==0){
        // Jika tidak ingin di upload
        $update = mysqli_query($c, "UPDATE produk2 SET namaproduk2='$np', deskripsi2='$desc', harga2='$harga', harga_diskon2='$dk' WHERE idproduk2='$idp'");
        if($update) {
            echo '
            <script>
                alert("Berhasil Mengubah Barang Stock");
                window.location.href="stock2.php";
            </script>
            ';
        } else {
            echo "Gagal Edit";
            header('location:stock2.php');
        }
    } else {
        // jika ingin
        move_uploaded_file($file_tmp, 'images2/'.$image);
        $update = mysqli_query($c, "UPDATE produk2 SET namaproduk2='$np', deskripsi2='$desc', harga2='$harga', images2='$image' WHERE idproduk2='$idp'");
        if($update) {
            echo '
            <script>
                alert("Berhasil Mengubah Barang Stock");
                window.location.href="stock2.php";
            </script>
            ';
        } else {
            echo "Gagal Edit";
            header('location:stock2.php');
        }

    }

}

// hapuus Barang Stock
if(isset($_POST['hapusbarang']))    {
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "DELETE FROM produk WHERE idproduk='$idp'");

    if($query)  {
        header('location:stock.php');
    } else {
        // jika gagal
        echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="stock.php"
        </script>
            ';
    }
}

// hapuus Barang Stock2
if(isset($_POST['hapusbarang2']))    {
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "DELETE FROM produk2 WHERE idproduk2='$idp'");

    if($query)  {
        header('location:stock2.php');
    } else {
        // jika gagal
        echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="stock2.php"
        </script>
            ';
    }
}

// Edit Pelanggann
if(isset($_POST['editpelanggan']))  {
    $namapelanggan = $_POST['namapelanggan'];
    $notlp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "UPDATE pelanggan SET namapelanggan='$namapelanggan', notelp='$notlp', alamat='$alamat' WHERE idpelanggan='$idp'");

    if($query)  {
        header('location:pelanggan.php');
    } else {
           // jika gagal
        echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="pelanggan.php"
        </script>
            ';
    }
}

// Edit Pelanggann2
if(isset($_POST['editpelanggan2']))  {
    $namapelanggan = $_POST['namapelanggan'];
    $notlp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "UPDATE pelanggan2 SET namapelanggan2='$namapelanggan', notelp2='$notlp', alamat2='$alamat' WHERE idpelanggan2='$idp'");

    if($query)  {
        header('location:pelanggan2.php');
    } else {
           // jika gagal
        echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="pelanggan2.php"
        </script>
            ';
    }
}

// hapus pelanggan
if(isset($_POST['hapuspelanggan'])) {
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "DELETE FROM pelanggan WHERE idpelanggan='$idp'");

    if($query)  {
        header('location:pelanggan.php');
    } else {
        // jika gagal
        echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="pelanggan.php"
        </script>
            ';
    }
}

// hapus pelanggan2
if(isset($_POST['hapuspelanggan2'])) {
    $idp = $_POST['idp'];

    $query = mysqli_query($c, "DELETE FROM pelanggan2 WHERE idpelanggan2='$idp'");

    if($query)  {
        header('location:pelanggan2.php');
    } else {
        // jika gagal
        echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="pelanggan2.php"
        </script>
            ';
    }
}

// edit barang masuk
if(isset($_POST['editbarangmasuk']))    {
    $idmasuk = $_POST['idm'];
    $qty = $_POST['qty'];
    $idp = $_POST['idp'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idp'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock'];

    // cari tau qtynya sekarang
    $caritau1 = mysqli_query($c, "SELECT * FROM masuk WHERE idmasuk='$idmasuk'");
    $caritau2 = mysqli_fetch_array($caritau1);
    $qtyskrg = $caritau2['qty'];

    if($qty >= $qtyskrg)    {
        // kalau inputan user lebih besar daripada qty yang tercatat sekarang
        // hitung selisih
        $slisih = $qty-$qtyskrg;
        $newstock = $stockskrg+$slisih;

        $query = mysqli_query($c, "UPDATE masuk SET qty='$qty' WHERE idmasuk='$idmasuk'");
        $query2 = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idp'");

        if($query&&$query2)  {
            header('location:masuk.php');
        } else {
                echo '
            <script>
                alert("Gagal Hapus");
                window.location.href="masuk.php"
            </script>
                ';
        }

    } else {
        // kalau lebih kecil
        // hitungselisih
        $slisih = $qtyskrg-$qty;
        $newstock = $stockskrg-$slisih;

        $query = mysqli_query($c, "UPDATE masuk SET qty='$qty' WHERE idmasuk='$idmasuk'");
        $query2 = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idp'");

        if($query&&$query2)  {
            header('location:masuk.php');
        } else {
                echo '
            <script>
                alert("Gagal Hapus");
                window.location.href="masuk.php"
            </script>
                ';
        }
    }


}


// edit barang masuk2
if(isset($_POST['editbarangmasuk2']))    {
    $idmasuk = $_POST['idm'];
    $qty = $_POST['qty'];
    $idp = $_POST['idp'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idp'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock2'];

    // cari tau qtynya sekarang
    $caritau1 = mysqli_query($c, "SELECT * FROM masuk2 WHERE idmasuk2='$idmasuk'");
    $caritau2 = mysqli_fetch_array($caritau1);
    $qtyskrg = $caritau2['qty2'];

    if($qty >= $qtyskrg)    {
        // kalau inputan user lebih besar daripada qty yang tercatat sekarang
        // hitung selisih
        $slisih = $qty-$qtyskrg;
        $newstock = $stockskrg+$slisih;

        $query = mysqli_query($c, "UPDATE masuk2 SET qty2='$qty' WHERE idmasuk2='$idmasuk'");
        $query2 = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idp'");

        if($query&&$query2)  {
            header('location:masuk2.php');
        } else {
                echo '
            <script>
                alert("Gagal Hapus");
                window.location.href="masuk2.php"
            </script>
                ';
        }

    } else {
        // kalau lebih kecil
        // hitungselisih
        $slisih = $qtyskrg-$qty;
        $newstock = $stockskrg-$slisih;

        $query = mysqli_query($c, "UPDATE masuk2 SET qty2='$qty' WHERE idmasuk2='$idmasuk'");
        $query2 = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idp'");

        if($query&&$query2)  {
            header('location:masuk2.php');
        } else {
                echo '
            <script>
                alert("Gagal Hapus");
                window.location.href="masuk2.php"
            </script>
                ';
        }
    }


}

// hapus barang masuk
if(isset($_POST['hapusbarangmasuk']))   {
    $idp = $_POST['idp'];
    $idm = $_POST['idm'];

     // cari tau qtynya sekarang
    $caritau1 = mysqli_query($c, "SELECT * FROM masuk WHERE idmasuk='$idm'");
    $caritau2 = mysqli_fetch_array($caritau1);
    $qtyskrg = $caritau2['qty'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idp'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock'];

    // hitungselisih
    $newstock = $stockskrg-$qtyskrg;

    $query = mysqli_query($c, "DELETE FROM masuk WHERE idmasuk='$idm'");
    $query2 = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idp'");

    if($query&&$query2)  {
        header('location:masuk.php');
    } else {
            echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="masuk.php"
        </script>
            ';
    }

}

// hapus barang masuk2
if(isset($_POST['hapusbarangmasuk2']))   {
    $idp = $_POST['idp'];
    $idm = $_POST['idm'];

     // cari tau qtynya sekarang
    $caritau1 = mysqli_query($c, "SELECT * FROM masuk2 WHERE idmasuk2='$idm'");
    $caritau2 = mysqli_fetch_array($caritau1);
    $qtyskrg = $caritau2['qty2'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idp'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock2'];

    // hitungselisih
    $newstock = $stockskrg-$qtyskrg;

    $query = mysqli_query($c, "DELETE FROM masuk2 WHERE idmasuk2='$idm'");
    $query2 = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idp'");

    if($query&&$query2)  {
        header('location:masuk2.php');
    } else {
            echo '
        <script>
            alert("Gagal Hapus");
            window.location.href="masuk2.php"
        </script>
            ';
    }

}

// hapus order di file index
if(isset($_POST['hapusorder'])) {
    $ido = $_POST['ido']; // id order

    $cekdata = mysqli_query($c, "SELECT * FROM detailpesanan dp WHERE idpesanan='$ido'");
    while($ok=mysqli_fetch_array($cekdata)) {
        // ambil di database
        // balikin stocknya dulu
        $qty = $ok['qty'];
        $idproduk = $ok['idproduk'];
        $iddp = $ok['iddetailpesanan'];


        // caari tau stock sekarang berapa
        $caristock = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idproduk'");
        $caristock2 = mysqli_fetch_array($caristock);
        $stockskrg = $caristock2['stock'];

        $newstock = $stockskrg+$qty;
        $queryupdate = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idproduk'");

        // hapus data
        $querydelete = mysqli_query($c, "DELETE FROM detailpesanan WHERE iddetailpesanan='$iddp'");


    }

    $query = mysqli_query($c, "DELETE FROM pesanan WHERE idorder='$ido'");

    if($queryupdate && $querydelete && $query)  {
        header('location:index.php');
    } else {
        // jika gagal

    }
}


// hapus order di file index2
if(isset($_POST['hapusorder2'])) {
    $ido = $_POST['ido']; // id order

    $cekdata = mysqli_query($c, "SELECT * FROM detailpesanan2 WHERE idpesanan2='$ido'");
    while($ok=mysqli_fetch_array($cekdata)) {
        // ambil di database
        // balikin stocknya dulu
        $qty = $ok['qty2'];
        $idproduk = $ok['idproduk2'];
        $iddp = $ok['iddetailpesanan2'];


        // caari tau stock sekarang berapa
        $caristock = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idproduk'");
        $caristock2 = mysqli_fetch_array($caristock);
        $stockskrg = $caristock2['stock2'];

        $newstock = $stockskrg+$qty;
        $queryupdate2 = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idproduk'");

        // hapus data
        $querydelete = mysqli_query($c, "DELETE FROM detailpesanan2 WHERE iddetailpesanan2='$iddp'");


    }

    $query = mysqli_query($c, "DELETE FROM pesanan2 WHERE idorder2='$ido'");

    if($queryupdate2 && $querydelete && $query)  {
        header('location:index2.php');
    } else {

    };
}



// edit barang detailpesanan
if(isset($_POST['ubahdatapesanan']))    {
        $iddp = $_POST['iddp']; // iddetailpesanan
        $qty = $_POST['qty']; 
        $idpr = $_POST['idpr']; // id produk
        $idp = $_POST['idp']; // id pesanan


        // cari tau qtynya sekarang
        $caritau1 = mysqli_query($c, "SELECT * FROM detailpesanan WHERE iddetailpesanan='$iddp'");
        $caritau2 = mysqli_fetch_array($caritau1);
        $qtyskrg = $caritau2['qty'];

        // caari tau stock sekarang berapa
        $caristock = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idpr'");
        $caristock2 = mysqli_fetch_array($caristock);
        $stockskrg = $caristock2['stock'];

        

        if($qty >= $qtyskrg)    {
            // kalau inputan user lebih besar daripada qty yang tercatat sekarang
            // hitung selisih
            $slisih = $qty-$qtyskrg;
            $newstock = $stockskrg-$slisih;

            $query = mysqli_query($c, "UPDATE detailpesanan SET qty='$qty' WHERE iddetailpesanan='$iddp'");
            $query2 = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idpr'");

            if($query&&$query2)  {
                header('location:view.php?idp='.$idp);
            } else {
                    echo '
                <script>
                    alert("Gagal Hapus");
                    window.location.href="view.php?idp='.$idp.'"
                </script>
                    ';
            }

        } else {
            // kalau lebih kecil
            // hitungselisih
            $slisih = $qtyskrg-$qty;
            $newstock = $stockskrg+$slisih;

            $query = mysqli_query($c, "UPDATE detailpesanan SET qty='$qty' WHERE iddetailpesanan='$iddp'");
            $query2 = mysqli_query($c, "UPDATE produk SET stock='$newstock' WHERE idproduk='$idpr'");

            if($query&&$query2)  {
                header('location:view.php?idp='.$idp);
            } else {
                    echo '
                <script>  
                    alert("Gagal Hapus");
                    window.location.href="view.php?idp='.$idp.'"
                </script>
                    ';
            }
        };

}


// edit barang detailpesanan2
if(isset($_POST['ubahdatapesanan2']))    {
    $iddp = $_POST['iddp2']; // iddetailpesanan
    $qty = $_POST['qty2']; 
    $idpr = $_POST['idpr2']; // id produk
    $idp = $_POST['idp2']; // id pesanan


    // cari tau qtynya sekarang
    $caritau1 = mysqli_query($c, "SELECT * FROM detailpesanan2 WHERE iddetailpesanan2='$iddp'");
    $caritau2 = mysqli_fetch_array($caritau1);
    $qtyskrg = $caritau2['qty2'];

    // caari tau stock sekarang berapa
    $caristock = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idpr'");
    $caristock2 = mysqli_fetch_array($caristock);
    $stockskrg = $caristock2['stock2'];

    

    if($qty >= $qtyskrg)    {
        // kalau inputan user lebih besar daripada qty yang tercatat sekarang
        // hitung selisih
        $slisih = $qty-$qtyskrg;
        $newstock = $stockskrg-$slisih;

        $query = mysqli_query($c, "UPDATE detailpesanan2 SET qty2='$qty' WHERE iddetailpesanan2='$iddp'");
        $query2 = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idpr'");

        if($query&&$query2)  {
            header('location:view2.php?idp='.$idp);
        } else {
                echo '
            <script>
                alert("Gagal Hapus");
                window.location.href="view2.php?idp='.$idp.'"
            </script>
                ';
        }

    } else {
        // kalau lebih kecil
        // hitungselisih
        $slisih = $qtyskrg-$qty;
        $newstock = $stockskrg+$slisih;

        $query = mysqli_query($c, "UPDATE detailpesanan2 SET qty2='$qty' WHERE iddetailpesanan2='$iddp'");
        $query2 = mysqli_query($c, "UPDATE produk2 SET stock2='$newstock' WHERE idproduk2='$idpr'");

        if($query&&$query2)  {
            header('location:view2.php?idp='.$idp);
        } else {
                echo '
            <script>  
                alert("Gagal Hapus");
                window.location.href="view2.php?idp='.$idp.'"
            </script>
                ';
        }
    };

}

//menambah meminjam barang baru
if(isset($_POST['pinjam'])) {
    $idproduk = $_POST['idproduk']; // mengambil id barang dari from
    $qty = $_POST['qty']; //mengambil jumlah quantiti
    $penerima = $_POST['penerima']; // mengambil nama penerima

    // ambil stock sekarang
    $stock_saat_ini = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idproduk'");
    $stock_nya = mysqli_fetch_array($stock_saat_ini);
    $stok = $stock_nya['stock']; // ini valuenya

    // kurangin stocknya
    $new_stock = $stok-$qty;

    
    // mulai queri insert
    $insertpinjam = mysqli_query($c, "INSERT INTO peminjaman (idbarang,qty,peminjam) VALUES ('$idproduk','$qty','$penerima')");

    // mungurangi stock di table stock barang
    $kurangistock = mysqli_query($c, "UPDATE produk SET stock='$new_stock' WHERE idproduk='$idproduk'");

    if($insertpinjam&&$kurangistock)   {
        // jika berhasil
        echo '
        <script>  
            alert("Berhasil ditambahkan si peminjam");
            window.location.href="peminjaman.php"
        </script>
        ';
    } else {
        // jika gagal
        echo '
        <script>  
            alert("Gagal ditambahkan si peminjam");
            window.location.href="peminjaman.php"
        </script>
        ';
    }


}

//menambah meminjam barang baru2
if(isset($_POST['pinjam2'])) {
    $idproduk = $_POST['idproduk']; // mengambil id barang dari from
    $qty = $_POST['qty']; //mengambil jumlah quantiti
    $penerima = $_POST['penerima']; // mengambil nama penerima

    // ambil stock sekarang
    $stock_saat_ini = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idproduk'");
    $stock_nya = mysqli_fetch_array($stock_saat_ini);
    $stok = $stock_nya['stock2']; // ini valuenya

    // kurangin stocknya
    $new_stock = $stok-$qty;

    
    // mulai queri insert
    $insertpinjam = mysqli_query($c, "INSERT INTO peminjaman2 (idbarang2,qty2,peminjam2) VALUES ('$idproduk','$qty','$penerima')");

    // mungurangi stock di table stock barang
    $kurangistock = mysqli_query($c, "UPDATE produk2 SET stock2='$new_stock' WHERE idproduk2='$idproduk'");

    if($insertpinjam&&$kurangistock)   {
        // jika berhasil
        echo '
        <script>  
            alert("Berhasil ditambahkan si peminjam");
            window.location.href="peminjaman2.php"
        </script>
        ';
    } else {
        // jika gagal
        echo '
        <script>  
            alert("Gagal ditambahkan si peminjam");
            window.location.href="peminjaman2.php"
        </script>
        ';
    }


}


// menyelesaikan pinjaman
if(isset($_POST['barangkembali']))  {
    $idpinjam = $_POST['idpinjam'];
    $idbarang = $_POST['idbarang'];


    // eksekusi
    $update_status = mysqli_query($c, "UPDATE peminjaman SET status='Kembali' WHERE idpeminjaman='$idpinjam'");

        // ambil stock sekarang
        $stock_saat_ini = mysqli_query($c, "SELECT * FROM produk WHERE idproduk='$idbarang'");
        $stock_nya = mysqli_fetch_array($stock_saat_ini);
        $stok = $stock_nya['stock']; // ini valuenya

        // ambil qty dari si idpinjam sekarang
        $stock_saat_ini1 = mysqli_query($c, "SELECT * FROM peminjaman WHERE idpeminjaman='$idpinjam'");
        $stock_nya1 = mysqli_fetch_array($stock_saat_ini1);
        $stok1 = $stock_nya1['qty']; // ini valuenya
    
        // kurangin stocknya
        $new_stock = $stok1+$stok;

    
    // kembalikan stocknya
    $kembalikan_stocknya = mysqli_query($c, "UPDATE produk SET stock='$new_stock' WHERE idproduk='$idbarang'");


    if($update_status&&$kembalikan_stocknya)   {
        // jika berhasil
        echo '
        <script>  
            alert("Berhasil ditambahkan si peminjam");
            window.location.href="peminjaman.php"
        </script>
        ';
    } else {
        // jika gagal
        echo '
        <script>  
            alert("Gagal ditambahkan si peminjam");
            window.location.href="peminjaman.php"
        </script>
        ';
    }
}

// menyelesaikan pinjaman2
if(isset($_POST['barangkembali2']))  {
    $idpinjam = $_POST['idpinjam'];
    $idbarang = $_POST['idbarang'];


    // eksekusi
    $update_status = mysqli_query($c, "UPDATE peminjaman2 SET status2='Kembali' WHERE idpeminjaman2='$idpinjam'");

        // ambil stock sekarang
        $stock_saat_ini = mysqli_query($c, "SELECT * FROM produk2 WHERE idproduk2='$idbarang'");
        $stock_nya = mysqli_fetch_array($stock_saat_ini);
        $stok = $stock_nya['stock2']; // ini valuenya

        // ambil qty dari si idpinjam sekarang
        $stock_saat_ini1 = mysqli_query($c, "SELECT * FROM peminjaman2 WHERE idpeminjaman2='$idpinjam'");
        $stock_nya1 = mysqli_fetch_array($stock_saat_ini1);
        $stok1 = $stock_nya1['qty2']; // ini valuenya
    
        // kurangin stocknya
        $new_stock = $stok1+$stok;

    
    // kembalikan stocknya
    $kembalikan_stocknya = mysqli_query($c, "UPDATE produk2 SET stock2='$new_stock' WHERE idproduk2='$idbarang'");


    if($update_status&&$kembalikan_stocknya)   {
        // jika berhasil
        echo '
        <script>  
            alert("Berhasil ditambahkan si peminjam");
            window.location.href="peminjaman2.php"
        </script>
        ';
    } else {
        // jika gagal
        echo '
        <script>  
            alert("Gagal ditambahkan si peminjam");
            window.location.href="peminjaman2.php"
        </script>
        ';
    }
}
?>