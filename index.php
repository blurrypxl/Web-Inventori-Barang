<?php
session_start();
include 'dbconnect.php';

if (isset($_SESSION['role'])) {
	header("location:stock");
}

if (isset($_GET['pesan'])) {
	if ($_GET['pesan'] == "gagal") {
		echo "Username atau Password salah!";
	} else if ($_GET['pesan'] == "logout") {
		echo "Anda berhasil keluar dari sistem";
	} else if ($_GET['pesan'] == "belum_login") {
		echo "Anda harus Login";
	} else if ($_GET['pesan'] == "noaccess") {
		echo "Akses Ditutup";
	}
}

if (isset($_POST['btn-login'])) {
	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$upass = mysqli_real_escape_string($conn, md5($_POST['password']));

	// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($conn, "select * from slogin where username='$uname' and password='$upass';");
	// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

	// cek apakah username dan password di temukan pada database
	if ($cek > 0) {
		$data = mysqli_fetch_assoc($login);
		if ($data['role'] == "admin") {
			// buat session login dan username
			$_SESSION['user'] = $data['nickname'];
			$_SESSION['user_login'] = $data['username'];
			$_SESSION['id'] = $data['id'];
			$_SESSION['role'] = "admin";
			header("location:stock");
		}
		if ($data['role'] == "super admin") {
			// buat session login dan username
			$_SESSION['user'] = $data['nickname'];
			$_SESSION['user_login'] = $data['username'];
			$_SESSION['id'] = $data['id'];
			$_SESSION['role'] = "super admin";
			header("location:stock");
		} else {
			header("location:index.php?pesan=gagal");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'UA-144808195-1');
	</script>
	<script src="jquery.min.js"></script>
	<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
	</style>
	<link rel="icon" type="image/png" href="favicon.png">
	<!-- Custom styles for this template -->
	<link href="stock/assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center" style="background-color: #212529;">
	<main class="form-signin border border-1 rounded" style="background-color: white;">
		<form method="post">
			<img src="csf.png" width="150">
			<div class="form-floating mt-4">
				<input type="text" class="form-control" placeholder="Username" name="username" autofocus>
			</div>
			<div class="form-floating mt-3">
				<input type="password" class="form-control" placeholder="Password" name="password">
			</div>
			<button type="submit" class="btn w-100" style="background-color: #212529; color:white" name="btn-login">Masuk</button>
		</form>
	</main>
	</div>
</body>

</html>