<!-- cek apakah sudah login -->
<?php
session_start();

// Jika role-nya bukan admin dan role-nya itu super admin, maka...
if ($_SESSION['role'] == "") {
	header("location:../index.php?pesan=belum_login");
}
// Jika role-nya bukan super admin dan role-nya itu admin, maka...
// if ($_SESSION['role'] != "super admin") {
// 	header("location:../index.php?pesan=belum_login");
// }
