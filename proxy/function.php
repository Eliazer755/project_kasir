<?php
session_start();


//koneksi
$konek = mysqli_connect('localhost', 'root','', 'kasir_proxy');

//login
if(isset($_POST['login'])){
    //initiate variabel
    $username = $_POST['username'];
    $password = $_POST['password'];
    $chek = mysqli_query($konek,"SELECT * FROM user WHERE username='$username' and password='$password' ");
    $hitung = mysqli_num_rows($chek);  
    if($hitung>0){
        //jika ditemukan
        //berhasil login

        
        $_SESSION['login'] = 'true';
        header('location:index.php');
    }else{
        //data tidak ditemukan
        //gagal login
        echo'
        <script>alert("Username atau password salah");

        window.location.href="login.php"
        </script>
        ';
    }

}


//tambah stok barang
if(isset($_POST['tambahbarang'])){
    $namaproduk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $insert = mysqli_query($konek,"insert into produk (nama_produk,deskripsi,harga,stok) values('$namaproduk','$deskripsi','$harga','$stok')");
    if($insert){
        header('localtion:stok.php');
    }else{
        echo'
        <script>alert("Gagal tambah barang baru");

        window.location.href="stok.php"
        </script>
        ';
    }
}



//pengurangan stok produk dan tambah data transaksi
if(isset($_POST['addproduk'])){
    $idproduk = $_POST['id_produk'];
    $qty = $_POST['qty'];//jumlah yg mau di keluarin
    

    //hitung stok sekarang ada berapa
    $hitung1 = mysqli_query($konek, "select * from produk where id_produk='$idproduk'");
    $hitung2 = mysqli_fetch_array($hitung1);
    $stoksekarang = $hitung2['stok'];//stok saat ini

    if($stoksekarang>=$qty){
        //menjumlahkan total harga
        $totalharga = $hargabarang*$jmlbeli;
        //kurangi stok nya dengan jumlah di yang dibeli
        $selisih = $stoksekarang-$qty;
        //stok nya cukup
        $insert = mysqli_query($konek,"insert into detailpesanan (id_produk,qty) values('$idproduk','$qty')");
        $update = mysqli_query($konek,"update produk set stok='$selisih' where id_produk='$idproduk'");
        if($insert&&$update){
            header('localtion:transaksi.php');
        }else{
            echo'
            <script>alert("Gagal tambah transaksi baru");
    
            window.location.href="transaksi.php"
            </script>
            ';
        }
    }else{
        echo'
            <script>alert("Stok Barang tidak Mencukupi");
    
            window.location.href="transaksi.php"
            </script>
            ';
    }
}


//menambah supplier
if(isset($_POST['barangmasuk'])){
    $id_produk = $_POST['id_produk'];
    $namasupplier = $_POST['nama_supplier'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];

    //cari tahu stok sekarang 
    $caritaustok = mysqli_query($konek,"select * from produk where id_produk='$id_produk'");
    $caritaustok2 = mysqli_fetch_array($caritaustok);
    $stoksekarang = $caritaustok2['stok'];

    //hitung
    $newstok = $stoksekarang+$qty;

    $insert = mysqli_query($konek,"insert into supplier(id_produk,nama_supplier,deskripsi_masuk,qty) values('$id_produk','$namasupplier','$deskripsi','$qty')");
    $update = mysqli_query($konek,"update produk set stok='$newstok' where id_produk='$id_produk'");
    if($insert&&$update){
        header('localtion:barangmasuk.php');
    }else{
        echo'
        <script>alert("Gagal tambah barang masuk");

        window.location.href="barangmasuk.php"
        </script>
        ';
    }
}

//hapus produk pesanan
if(isset($_POST['hapuspesanan'])){
    $iddetail = $_POST['idd'];
    $idpr = $_POST['idp'];
    //cek qty sekarang
    $cek1 = mysqli_query($konek,"select * from detailpesanan where id_detail='$iddetail'");
    $cek2 = mysqli_fetch_array($cek1);
    $qrtsekarang = $cek2['qty'];

    //cek stok sekarang
    $cek3 = mysqli_query($konek,"select * from produk where id_produk='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);
    $stoksekarang = $cek4['stok'];

    $hitung = $stoksekarang+$qrtsekarang;

    $updatestok = mysqli_query($konek,"update produk set stok='$hitung' where id_produk='$idpr'");
    $delete = mysqli_query($konek, "delete from detailpesanan where id_produk='$idpr' and id_detail='$iddetail'");

    if($updatestok&&$delete){
      header('location:transaksi.php');
    }else{
        echo'
        <script>alert("Gagal delete transaksi");

        window.location.href="transaksi.php"
        </script>
        ';
    }
}


//edit barang
if(isset($_POST['editbarang'])){
    $namaproduk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $idproduk = $_POST['id_produk'];

    $query = mysqli_query($konek,"update produk set nama_produk='$namaproduk', deskripsi='$deskripsi', harga='$harga' where id_produk='$idproduk'");
    if($query){
        header('location:stok.php');
      }else{
          echo'
          <script>alert("Gagal edit stok produk");
  
          window.location.href="stok.php"
          </script>
          ';
      }
}

//delete barang
if(isset($_POST['hapusbarang'])){
    $idproduk = $_POST['id_produk'];

    $query = mysqli_query($konek,"delete from produk where id_produk='$idproduk'");
    if($query){
        header('location:stok.php');
      }else{
          echo'
          <script>alert("Gagal delete stok produk");
  
          window.location.href="stok.php"
          </script>
          ';
      }
}

 //delete barang masuk
 if(isset($_POST['deletemasuk'])){
    $idmasuk = $_POST['idm'];
    $idproduk = $_POST['idp'];

    //cari tau qty sekarang berapa?
    $caritau = mysqli_query($konek,"select * from supplier where id_masuk='$idmasuk'");
    $caritau2 = mysqli_fetch_array($caritau);
    $qtysekrang = $caritau2['qty'];

    //cari tahu stok sekarang 
    $caritaustok = mysqli_query($konek,"select * from produk where id_produk='$idproduk'");
    $caritaustok2 = mysqli_fetch_array($caritaustok);
    $stoksekarang = $caritaustok2['stok'];

    //hitung selisih
    $newstok = $stoksekarang-$qtysekrang;

    $query = mysqli_query($konek,"delete from supplier where id_masuk='$idmasuk'");
    $query2 = mysqli_query($konek,"update produk set stok='$newstok' where id_produk='$idproduk'");
    if($query&&$query2){
        header('location:barangmasuk.php');
      }else{
          echo'
          <script>alert("Gagal delete barang masuk");
  
          window.location.href="barangmasuk.php"
          </script>
          ';
      }
}




//mengubah data barang masuk
if(isset($_POST['editmasuk'])){
    $namasupplier = $_POST['nama_supplier'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];
    $idm = $_POST['idm'];//id masuk
    $idp = $_POST['idp'];//id produk

    //cari tau qty sekarang berapa?
    $caritau = mysqli_query($konek,"select * from supplier where id_masuk='$idm'");
    $caritau2 = mysqli_fetch_array($caritau);
    $qtysekrang = $caritau2['qty'];

    //cari tahu stok sekarang 
    $caritaustok = mysqli_query($konek,"select * from produk where id_produk='$idp'");
    $caritaustok2 = mysqli_fetch_array($caritaustok);
    $stoksekarang = $caritaustok2['stok'];


    if($qtysekrang >= $qty){
        //kalau inputan user lebih besar dari stok barang sekarang
        //hitung selisih
        $selisih = $qty-$qtysekrang;
        $newstok = $stoksekarang+$selisih;
        
        $query = mysqli_query($konek,"update supplier set nama_supplier='$namasupplier', deskripsi_masuk='$deskripsi',  qty='$qty' where id_masuk='$idm'");
        $query2 = mysqli_query($konek,"update produk set stok='$newstok' where id_produk='$idp'");

    if($query&&$query2){
        header('location:barangmasuk.php');
      }else{
          echo'
          <script>alert("Gagal edit supplier");
  
          window.location.href="barangmasuk.php"
          </script>
          ';
      }
    }else{
        //kalau lebih kecil
        //hitung selisih
        $selisih = $qtysekrang-$qty;
        $newstok = $stoksekarang-$selisih;
        $query = mysqli_query($konek,"update supplier set nama_supplier='$namasupplier', deskripsi_masuk='$deskripsi', qty='$qty' where id_masuk='$idm'");
        $query2 = mysqli_query($konek,"update produk set stok='$newstok' where id_produk='$idp'");
    if($query&&$query2){
        header('location:barangmasuk.php');
      }else{
          echo'
          <script>alert("Gagal edit supplier");
  
          window.location.href="barangmasuk.php"
          </script>
          ';
      }
    }
    
}

//mengubah detail data transaksi
if(isset($_POST['edittransaksi'])){
    $namasupplier = $_POST['nama_supplier'];
    $deskripsi = $_POST['deskripsi'];
    $qty = $_POST['qty'];
    $idd = $_POST['idd'];//id transaksi
    $idp = $_POST['idp'];//id produk

    //cari tau qty sekarang berapa?
    $caritau = mysqli_query($konek,"select * from detailpesanan where id_detail='$idd'");
    $caritau2 = mysqli_fetch_array($caritau);
    $qtysekrang = $caritau2['qty'];

    //cari tahu stok sekarang 
    $caritaustok = mysqli_query($konek,"select * from produk where id_produk='$idp'");
    $caritaustok2 = mysqli_fetch_array($caritaustok);
    $stoksekarang = $caritaustok2['stok'];


    if($qtysekrang >= $qty){
        //kalau inputan user lebih besar dari stok barang sekarang
        //hitung selisih
        $selisih = $qty-$qtysekrang;
        $newstok = $stoksekarang-$selisih;
        
        $query = mysqli_query($konek,"update detailpesanan set qty='$qty' where id_detail='$idd'");
        $query2 = mysqli_query($konek,"update produk set stok='$newstok' where id_produk='$idp'");
    if($query&&$query2){
        header('location:transaksi.php');
      }else{
          echo'
          <script>alert("Gagal edit transaksi");
  
          window.location.href="transaksi.php"
          </script>
          ';
      }
    }else{
        //kalau lebih kecil
        //hitung selisih
        $selisih = $qtysekrang-$qty;
        $newstok = $stoksekarang+$selisih;
        $query = mysqli_query($konek,"update detailpesanan set qty='$qty' where id_detail='$idd'");
        $query2 = mysqli_query($konek,"update produk set stok='$newstok' where id_produk='$idp'");
    if($query&&$query2){
        header('location:transaksi.php');
      }else{
          echo'
          <script>alert("Gagal edit transaksi");
  
          window.location.href="transaksi.php"
          </script>
          ';
      }
    }

}

//menambah user
if(isset($_POST['tambauser'])){
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    $insert = mysqli_query($konek,"insert into user (username, password) values('$username','$password')");
    if($insert){
        header('localtion:admin.php');
    }else{
        echo'
        <script>alert("Gagal tambah user baru");

        window.location.href="admin.php"
        </script>
        ';
    }
}

//delete user
if(isset($_POST['hapususer'])){
    $iduser = $_POST['idd'];

    $query = mysqli_query($konek,"delete from user where id_user='$iduser'");
    if($query){
        header('location:admin.php');
      }else{
          echo'
          <script>alert("Gagal delete user");
  
          window.location.href="admin.php"
          </script>
          ';
      }
}

//edit user
if(isset($_POST['edituser'])){
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $idd = $_POST['id_user'];

    $query = mysqli_query($konek,"update user set username='$username', password='$password' where id_user='$idd'");
    if($query){
        header('location:admin.php');
      }else{
          echo'
          <script>alert("Gagal edit User");
  
          window.location.href="admin.php"
          </script>
          ';
      }
}

