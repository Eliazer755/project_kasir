<?php

require 'ceklogin.php';
//hitung jumlah pesanan
$h1 = mysqli_query($konek, "select * from detailpesanan");
$h2 = mysqli_num_rows($h1);

// $tampilPeg    =mysqli_query($konek, "SELECT * FROM user WHERE username='$_SESSION[username]'");
// $peg    =mysqli_fetch_array($tampilPeg);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta charset="utf-8">
    <title>PROXY PRIMA</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <style>
        @media print {
            .dataTable-search {
                display: none;
            }

            .dataTable-dropdown {
                display: none;
            }
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">PROXY PRIMA</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">MENU</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-money-check-alt"></i></div>
                            Transaksi
                        </a> <a class="nav-link" href="stok.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                            Stok Barang
                        </a>
                        </a> <a class="nav-link" href="barangmasuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-handshake"></i></div>
                            Barang Masuk
                        </a>
                        </a> <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i></div>
                            Kelola Admin
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <p>ADMIN</p>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">WELCOMEEE</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">D&D Poxy Prima</li>
                    </ol>
                    <a href="export.php"><button class="btn btn-info">Export File</button></a><br /><br />

                    <div class="row">
                        <div class="col">
                            <form method="POST" class="form-inline">
                                <input type="date" name="tgl_mulai" class="form-control mr-3">
                                <input type="date" name="tgl_selesai" class="form-control mr-3">
                                <button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>
                            </form>
                        </div>
                    </div> 
                    <br>                   

                    <?php
                    $ambildatastok = mysqli_query($konek, 'select * from produk where stok < 10');
                    while($fetch=mysqli_fetch_array($ambildatastok)){
                        $barang = $fetch['nama_produk'];                    
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Perhatian!</strong> Stok Barang <?=$barang;?> akan habis
                    </div>
                    <?php
                    }
                    ?>

                    <br>
                    <div class="row">
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
                                            <th>Tanggal</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Jumlah</th>
                                            <th>stok</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbod>


                                        <?php
                                        if (isset($_POST['filter_tgl'])) {
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];
                                            if ($mulai != null || $selesai != null) {
                                                $get = mysqli_query($konek, "select * from detailpesanan p, produk pr where p.id_produk=pr.id_produk
                                                and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY tanggal DESC");
                                            } else {
                                                $get = mysqli_query($konek, "select * from detailpesanan p, produk pr where p.id_produk=pr.id_produk ORDER BY tanggal DESC");
                                            }
                                        } else {
                                            $get = mysqli_query($konek, "select * from detailpesanan p, produk pr where p.id_produk=pr.id_produk ORDER BY tanggal DESC");
                                        }
                                        $i = 1;

                                        while ($p = mysqli_fetch_array($get)) {
                                            $idd = $p['id_detail'];
                                            $idproduk = $p['id_produk'];
                                            $qty = $p['qty'];
                                            $harga = $p['harga'];
                                            $deskripsi = $p['deskripsi'];
                                            $namaproduk = $p['nama_produk'];
                                            $stok = $p['stok'];
                                            $tanggal = $p['tanggal'];
                                            $subtotal = $qty * $harga;
                                        ?>

                                            <tr>
                                                <td> <?= $i++ ?> </td>
                                                <td> <?= $tanggal; ?> </td>
                                                <td> <?= $namaproduk; ?> </td>
                                                <td>Rp <?= number_format($harga); ?> </td>
                                                <td> <?= $qty; ?> </td>
                                                <td> <?= $stok; ?> </td>
                                                <td>Rp <?= number_format($subtotal); ?> </td>
                                            </tr>

                                        <?php
                                        }; //end of while
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
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>





</html>