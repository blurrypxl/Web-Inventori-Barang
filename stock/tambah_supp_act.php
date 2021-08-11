<?php
include '../dbconnect.php';

$supply = $_POST['supplier'];

// Cek duplikat supplier
$cek = mysqli_query($conn, "SELECT * FROM ssuplier_brg WHERE nama_supplier='$supply'");

if (mysqli_num_rows($cek) > 0) {
  echo "<div class='alert alert-warning'>
          <strong>Failed!</strong> Redirecting you back in 1 seconds.
        </div>
        <meta http-equiv='refresh' content='1; url= tambahSupp.php'/>";
  header("location: tambahSupp.php?status=data-supplier-sudah-ada");
}
else {
  $addSupp = mysqli_query($conn, "insert into ssuplier_brg (nama_supplier) values ('$supply')");

  if ($addSupp) {
    echo "<div class='alert alert-success'>
          <strong>Success!</strong> Redirecting you back in 1 seconds.
        </div>
        <meta http-equiv='refresh' content='1; url=tambahSupp.php'/>";
    header("location: tambahSupp.php?status=data-berhasil-ditambah");
  }
  else {
    echo "<div class='alert alert-danger'>
          <strong>Failed!</strong> Redirecting you back in 1 seconds.
        </div>
        <meta http-equiv='refresh' content='1; url=tambahSupp.php'/>";
    header("location: tambahSupp.php?status=data-gagal-ditambah");
  }
}
?>

<html>

<head>
  <title>Tambah Supplier</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>