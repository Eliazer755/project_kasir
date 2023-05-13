<?php

require 'ceklogin.php';
//hitung jumlah pesanan
$h1 = mysqli_query($konek, "select * from produk");
$h2 = mysqli_num_rows($h1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>PROXY PRIMA</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    <style>
        @media print{
            .dataTable-search, .dataTable-dropdown, .aksi, .tmb{
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
                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
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
                    <h1 class="mt-4">DATA STOK BARANG</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Selamat Datang</li>
                    </ol>
                    <div class="col-xl-3 col-md-6">
                        <div class="tmb">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">
                            TAMBAH DATA STOK BARANG
                            Jumlah Stok Barang : <?= $h2 ?>
                           </div>                                                      
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                ADD
                            </button>

                        </div>
                        </div>
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
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th class="aksi">Aksi</th>
                                    </tr>
                                </thead>
                                <tbod>


                                    <?php
                                    $get = mysqli_query($konek, "select * from produk");
                                    $i = 1;
                                    while ($p = mysqli_fetch_array($get)) {
                                        $namaproduk = $p['nama_produk'];
                                        $deskripsi = $p['deskripsi'];
                                        $harga = $p['harga'];
                                        $stok = $p['stok'];
                                        $idproduk = $p['id_produk'];
                                    ?>

                                        <tr>
                                            <td> <?= $i++; ?> </td>
                                            <td> <?= $namaproduk; ?> </td>
                                            <td> <?= $deskripsi; ?> </td>
                                            <td>Rp <?= number_format($harga); ?> </td>
                                            <td> <?= $stok; ?> </td>
                                            <td class="aksi">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2<?= $idproduk; ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal3<?= $idproduk; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal edit-->
                                        <div class="modal fade" id="exampleModal2<?= $idproduk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $namaproduk; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST">

                                                        <div class="modal-body">                                                            
                                                            <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?= $namaproduk; ?>">                                                            
                                                            <input type="text" name="deskripsi" class="form-control mt-2" placeholder="Deskripsi Produk" value="<?= $deskripsi; ?>">
                                                            <input type="text" name="harga" class="form-control mt-2" placeholder="Harga Produk" value="<?= $harga; ?>">
                                                            <input type="hidden" name="id_produk" value="<?= $idproduk; ?> ">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                                                            <button type="submit" class="btn btn-primary" name="editbarang">Save changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal delete-->
                                        <div class="modal fade" id="exampleModal3<?= $idproduk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $namaproduk; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST">

                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin menghapus?
                                                            <input type="hidden" name="id_produk" value="<?= $idproduk; ?> ">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                                                            <button type="submit" class="btn btn-primary" name="hapusbarang">Save changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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
</body>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH DATA STOK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST">

                <div class="modal-body">
                    <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk">
                    <input type="text" name="deskripsi" class="form-control mt-2" placeholder="Deskripsi Produk">
                    <input type="text" name="harga" class="form-control mt-2" placeholder="Harga Produk">
                    <input type="text" name="stok" class="form-control mt-2" placeholder="Stok Produk">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                    <button type="submit" class="btn btn-primary" name="tambahbarang">Save changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

</html>