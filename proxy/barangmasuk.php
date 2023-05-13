<?php

require 'ceklogin.php';
//hitung jumlah pesanan
$h1 = mysqli_query($konek, "select * from supplier");
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
        
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
                            </a>  <a class="nav-link" href="stok.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-cart-plus"></i></div>
                                Stok Barang
                            </a>
                            </a>  <a class="nav-link" href="barangmasuk.php">
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
                        <?php echo $_SESSION['username'] ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">DATA SUPPLIER</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <div class="col-xl-3 col-md-6">
                            <div class="tmb">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        TAMBAH BARANG MASUK
                                        Jumlah Supplier: <?=$h2?>
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
                                            <th>Nama Supplier</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal</th>
                                            <th class="aksi">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbod>


                                        <?php
                                        $get = mysqli_query($konek,"select * from supplier m, produk p where m.id_produk=p.id_produk");
                                        $i = 1;
                                        while($p=mysqli_fetch_array($get)){
                                        $namaproduk = $p['nama_produk'];
                                        $idmasuk = $p['id_masuk'];
                                        $id_produk = $p['id_produk'];
                                        $deskripsi = $p['deskripsi_masuk'];
                                        $namasupplier = $p['nama_supplier'];
                                        $jumlah = $p['qty'];
                                        $tanggal = $p['tanggal'];
                                        ?>

                                        <tr>
                                            <td> <?=$i++;?> </td>
                                            <td> <?=$namaproduk;?> </td>
                                            <td> <?=$namasupplier;?> </td>
                                            <td> <?=$deskripsi;?> </td>
                                            <td> <?=$jumlah;?> </td>
                                            <td> <?=$tanggal;?> </td>
                                            <td class="aksi">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $idmasuk; ?>">
                                            edit
                                            </button> 
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletemasuk<?= $idmasuk; ?>">
                                            delete
                                            </button> 
                                           </td>
                                        </tr>

                                         <!-- Modal edit-->
                                         <div class="modal fade" id="edit<?= $idmasuk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Data Barang Masuk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST">

                                                        <div class="modal-body">
                                                            <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="<?= $namaproduk; ?>" disabled>
                                                            <input type="text" name="nama_supplier" class="form-control mt-2" placeholder="Nama Supplier" value="<?= $namasupplier; ?>">
                                                            <input type="text" name="deskripsi" class="form-control mt-2" placeholder="Deskripsi Produk" value="<?= $deskripsi; ?>">
                                                            <input type="number" name="qty" class="form-control mt-2" placeholder="qty" value="<?= $jumlah; ?>">
                                                            <input type="hidden" name="idm" value="<?= $idmasuk; ?> ">
                                                            <input type="hidden" name="idp" value="<?= $id_produk; ?> ">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                                                            <button type="submit" class="btn btn-primary" name="editmasuk">Save changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal delete-->
                                        <div class="modal fade" id="deletemasuk<?= $idmasuk; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Data Barang Masuk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <form method="POST">

                                                        <div class="modal-body">
                                                        Apakah anda yakin ingin menghapus?
                                                            <input type="hidden" name="idm" value="<?= $idmasuk; ?> ">
                                                            <input type="hidden" name="idp" value="<?= $id_produk; ?> ">
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                                                            <button type="submit" class="btn btn-primary" name="deletemasuk">Save changes</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <?php
                                        };//end of while
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
        //
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('.selectpicker').selectpicker();
    </script>
    </body>


  
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH PESANAN BARU</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST">

                <!--MODAL BODY -->
                <div class="modal-body">
                    Pilih Barang
                    <select name="id_produk" class="selectpicker" data-live-search="true">

                        <?php
                        $getproduk = mysqli_query($konek, "select * from produk");
                        while ($p = mysqli_fetch_array($getproduk)) {
                            $id_produk = $p['id_produk'];
                            $namaproduk = $p['nama_produk'];
                            $deskripsi = $p['deskripsi'];
                            $harga = $p['harga'];
                            $stok = $p['stok'];

                        ?>                
                            <option value="<?= $id_produk; ?>"><?= $namaproduk; ?> - <?= $deskripsi; ?> (Stok: <?= $stok; ?>)</option>
                            
                        <?php
                        }
                        ?>
                    </select>
                        <input type="text" name="nama_supplier" class="form-control mt-4" placeholder="Nama Supplier">
                        <input type="text" name="deskripsi" class="form-control mt-4" placeholder="Deskripsi">
                        <input type="number" name="qty" class="form-control mt-4" placeholder="Jumlah" min="1" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                    <button type="submit" class="btn btn-primary" name="barangmasuk">Save changes</button>
                </div>

            </form>
        </div>
    </div>
</div>

</html>
