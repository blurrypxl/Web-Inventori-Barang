<?php
include '../dbconnect.php';

$username = $_POST['username'];
$pass = md5($_POST['password']);
$nickname = $_POST['nickname'];
$role = $_POST['role'];

$addAkun = mysqli_query($conn, "insert into slogin (username, password, nickname, role) values ('$username','$pass','$nickname','$role')");

if ($addAkun) {
  echo "<div class='alert alert-success'>
          <strong>Success!</strong> Redirecting you back in 1 seconds.
        </div>
        <meta http-equiv='refresh' content='1; url= tambahUser.php'/>";
  header("location: tambahUser.php?status=data-berhasil-ditambah");
} else {
  echo "<div class='alert alert-danger'>
          <strong>Failed!</strong> Redirecting you back in 1 seconds.
        </div>
        <meta http-equiv='refresh' content='1; url= tambahUser.php'/>";
  header("location: tambahUser.php?status=data-gagal-ditambah");
}
?>

<html>
<head>
  <title>Tambah User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>