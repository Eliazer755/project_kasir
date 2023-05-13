<?php
require 'ceklogin.php';
//hitung jumlah pesanan
$h1 = mysqli_query($konek, "select * from detailpesanan");
$h2 = mysqli_num_rows($h1);
?>

<html>
<head>
  <title>Transaksi Barang</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
			<h2>Transaksi Barang</h2>
			<h4>(Inventory)</h4>
				<div class="data-tables datatable-dark">
					
                <div class="row">
                        <div class="col">
                        <form method="POST" class="form-inline">
                        <input type="date" name="tgl_mulai" class="form-control mr-2">                        
                        <input type="date" name="tgl_selesai" class="form-control mr-3">                                          
                        <button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>                        
                        </form>                    
                        </div>
               </div> 

                <table class="table table-bordered" id="mauexport" width="100%">
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
                                         if(isset($_POST['filter_tgl'])){
                                            $mulai = $_POST['tgl_mulai'];
                                            $selesai = $_POST['tgl_selesai'];
                                            if($mulai != null || $selesai != null){                                                
                                                $get = mysqli_query($konek, "select * from detailpesanan p, produk pr where p.id_produk=pr.id_produk
                                                and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY) ORDER BY tanggal DESC");
                                            }else{
                                                $get = mysqli_query($konek, "select * from detailpesanan p, produk pr where p.id_produk=pr.id_produk ORDER BY tanggal DESC");    
                                            }                                            
                                        }else{                                            
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
                                                <td> <?php echo $tanggal; ?> </td>
                                                <td> <?php echo $namaproduk; ?> </td>
                                                <td>Rp <?php echo number_format($harga); ?> </td>
                                                <td> <?php echo $qty; ?> </td>
                                                <td> <?php echo $stok; ?> </td>
                                                <td>Rp <?php echo number_format($subtotal); ?> </td>                                             
                                            </tr>                                           


                                        <?php
                                        }; //end of while
                                        ?>


                                        </tbody>
                                </table>
                                <a href="index.php"><button class="btn btn-info">Go Back</button></a><br /><br />
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>