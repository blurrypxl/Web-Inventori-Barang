<?php
include '../dbconnect.php';
$barang = $_POST['barang']; //id barang
$qty = $_POST['qty'];
$tanggal = $_POST['tanggal'];
$tujuan = $_POST['tujuan'];
$ket = $_POST['ket'];

$dt = mysqli_query($conn, "select * from sstock_brg where idx='$barang'");
$data = mysqli_fetch_array($dt);
$stock = $data['stock'];

$sisa = $stock - $qty;

if ($stock < $qty) {
  echo "<div class='alert alert-warning'>
          <strong>Failed!</strong> Redirecting you back in 1 seconds.
        </div>
        //<meta http-equiv='refresh' content='1; url=keluar.php?status='qty-lebih-besar-dari-stock'/>";
  header("location: keluar.php?status=qty-lebih-besar-dari-stock");
}
if ($stock >= $qty) {
  $query1 = mysqli_query($conn, "update sstock_brg set stock='$sisa' where idx='$barang'");

  $query2 = mysqli_query($conn, "insert into sbrg_keluar (idx,tgl,jumlah,penerima,keterangan) values('$barang','$tanggal','$qty','$tujuan','$ket')");

  if ($query1 && $query2) {
    echo "<div class='alert alert-success'>
          <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
          <meta http-equiv='refresh' content='1; url= keluar.php'/>
    ";
  } else {
    echo "<div class='alert alert-warning'>
          <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
          <meta http-equiv='refresh' content='1; url= keluar.php'/>
    ";
  }
}
?>

<html>

<head>
  <title>Barang Keluar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>