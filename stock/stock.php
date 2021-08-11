<!doctype html>
<html class="no-js" lang="en">

<?php
include '../dbconnect.php';
include 'cek.php';

if (isset($_POST['update'])) {
  $idx = $_POST['idbrg'];
  $nama = $_POST['nama'];
  $jenis = $_POST['jenis'];
  $merk = $_POST['merk'];
  $ukuran = $_POST['ukuran'];
  $satuan = $_POST['satuan'];
  $supplier = $_POST['supplier']; // ID Supplier
  $lokasi = $_POST['lokasi']; // ID Gudang

  if ($satuan == "Pilih satuan" && $supplier == "Pilih supplier" && $lokasi == "Pilih lokasi") {
    $updatedata = mysqli_query($conn, "update sstock_brg set nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran' where idx='$idx'");
  }
  if ($satuan != "Pilih satuan" && $supplier == "Pilih supplier" && $lokasi == "Pilih lokasi") {
    $updatedata = mysqli_query($conn, "update sstock_brg set nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran', satuan='$satuan' where idx='$idx'");
  }
  if ($satuan == "Pilih satuan" && $supplier != "Pilih supplier" && $lokasi == "Pilih lokasi") {
    $updatedata = mysqli_query($conn, "update sstock_brg set nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran', id_supplier='$supplier' where idx='$idx'");
  }
  if ($satuan == "Pilih satuan" && $supplier == "Pilih supplier" && $lokasi != "Pilih lokasi") {
    $updatedata = mysqli_query($conn, "update sstock_brg set nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran', lokasi='$lokasi' where idx='$idx'");
  }
  if ($satuan != "Pilih satuan" && $supplier != "Pilih supplier" && $lokasi != "Pilih lokasi") {
    $updatedata = mysqli_query($conn, "update sstock_brg set nama='$nama', jenis='$jenis', merk='$merk', ukuran='$ukuran', satuan='$satuan', id_supplier='$supplier', lokasi='$lokasi' where idx='$idx'");
  }

  //cek apakah berhasil
  if ($updatedata) {
    echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 2 seconds.
              </div>
            <meta http-equiv='refresh' content='2; url= stock.php'/>  ";
  } else {
    echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 2 seconds.
              </div>
             <meta http-equiv='refresh' content='2' url= stock.php'/> ";
  }
};

if (isset($_POST['hapus'])) {
  $idx = $_POST['idbrg'];

  $delete = mysqli_query($conn, "delete from sstock_brg where idx='$idx'");
  //hapus juga semua data barang ini di tabel keluar-masuk
  $deltabelkeluar = mysqli_query($conn, "delete from sbrg_keluar where id='$idx'");
  $deltabelmasuk = mysqli_query($conn, "delete from sbrg_masuk where id='$idx'");

  //cek apakah berhasil
  if ($delete && $deltabelkeluar && $deltabelmasuk) {
    echo "<div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
          <meta http-equiv='refresh' content='1; url= stock.php'/>  ";
  } else {
    echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
          <meta http-equiv='refresh' content='1; url= stock.php'/> ";
  }
};
?>

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../favicon.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Stock Barang | Cipta Selaras Funiture</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">
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
  <!-- amchart css -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

  <!-- others css -->
  <link rel="stylesheet" href="assets/css/typography.css">
  <link rel="stylesheet" href="assets/css/default-css.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <!-- modernizr css -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
  <!-- preloader area start -->
  <div id="preloader">
    <div class="loader"></div>
  </div>
  <!-- preloader area end -->
  <!-- page container area start -->
  <div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
      <div class="sidebar-header">
        <a href="index.php"><img src="../logo.png" alt="logo" width="100%"></a>
      </div>
      <div class="main-menu">
        <div class="menu-inner">
          <nav>
            <ul class="metismenu" id="menu">
              <li>
                <a href="index.php"><i class="ti-dashboard"></i><span>Dashboard</span></a>
              </li>
              <?php
              if ($_SESSION['role'] == 'super admin') {
                echo '<li>
                        <a href="javascript:void(0)" aria-expanded="true"><i><ion-icon name="contact"></ion-icon></i><span>Super Admin Page</span></a>
                        <ul class="collapse">
                          <li>
                            <a href="tambahUser.php"><i class="ti-user"></i><span>Tambah User</span></a>
                          </li>
                          <li>
                            <a href="tambahSupp.php"><i><ion-icon name="people"></ion-icon></i><span>Tambah Supplier</span></a>
                          </li>
                          <li>
                            <a href="tambahGudang.php"><i><ion-icon name="cube"></ion-icon></i><span>Tambah Gudang</span></a>
                          </li>
                        </ul>
                      </li>';
              }
              ?>
              <li class="active">
                <a href="stock.php"><i class="ti-file"></i><span>Stock Barang</span></a>
              </li>
              <li>
                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Transaksi Data
                  </span></a>
                <ul class="collapse">
                  <li><a href="masuk.php">Barang Masuk</a></li>
                  <li><a href="keluar.php">Barang Keluar</a></li>
                </ul>
              </li>
              <li>
                <a href="logout.php"><span>Logout</span></a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
      <!-- header area start -->
      <div class="header-area">
        <div class="row align-items-center">
          <!-- nav and search button -->
          <div class="col-md-6 col-sm-8 clearfix">
            <div class="nav-btn pull-left">
              <span></span>
              <span></span>
              <span></span>
            </div>
            <!-- <div class="search-box pull-left">
                            <form action="#">
                                <h5>Selamat Datang, <?= $_SESSION['user']; ?>!</h5>
                            </form>
                        </div> -->
          </div>
          <!-- profile info & task notification -->
          <div class="col-md-6 col-sm-4 clearfix">
            <ul class="notification-area pull-right">
              <li>
                <h3>
                  <div class="date">
                    <script type='text/javascript'>
                      var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                      var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                      var date = new Date();
                      var day = date.getDate();
                      var month = date.getMonth();
                      var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                      var yy = date.getYear();
                      var year = (yy < 1000) ? yy + 1900 : yy;
                      document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                      //-->
                    </script></b>
                  </div>
                </h3>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- header area end -->
      <?php
      $periksa_bahan = mysqli_query($conn, "select * from sstock_brg where stock <1");
      while ($p = mysqli_fetch_array($periksa_bahan)) {
        if ($p['stock'] <= 1) {
      ?>
          <script>
            $(document).ready(function() {
              $('#pesan_sedia').css("color", "white");
              $('#pesan_sedia').append("<i class='ti-flag'></i>");
            });
          </script>
      <?php
          echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>" . $p['nama'] . "</u> <u>" . ($p['merk']) . "</u> &nbsp <u>" . $p['ukuran'] . "</u></strong> yang tersisa sudah habis</div>";
        }
      }
      ?>

      <!-- page title area start -->
      <div class="page-title-area">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
              <ul class="breadcrumbs pull-left">
                <li><a href="index.php">Dashboard</a></li>
                <li><span>Stock Barang</span></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right" style="color:black; padding:0px;"></div>
          </div>
        </div>
      </div>
      <!-- page title area end -->
      <div class="main-content-inner">

        <!-- market value area start -->
        <div class="row mt-5 mb-5">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center">
                  <h2>Daftar Barang</h2>
                  <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span><i class="ti-plus"></i> Tambah Barang</button>
                </div>
                <div class="data-tables datatable-dark">
                  <div class="table-responsive">
                    <table id="dataTable3" class="table table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th>No</th>
                          <th>Nama Barang</th>
                          <th>Jenis</th>
                          <th>Merk</th>
                          <th>Ukuran</th>
                          <th>Stock</th>
                          <th>Satuan</th>
                          <th>Supplier</th>
                          <th>Lokasi</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $brgs = mysqli_query($conn, "SELECT sstock_brg.idx, sstock_brg.id_supplier, sstock_brg.nama, sstock_brg.jenis, sstock_brg.merk, sstock_brg.ukuran, sstock_brg.stock, sstock_brg.satuan, sstock_brg.lokasi, ssuplier_brg.id_supplier, ssuplier_brg.nama_supplier FROM sstock_brg JOIN ssuplier_brg ON sstock_brg.id_supplier = ssuplier_brg.id_supplier ORDER BY sstock_brg.idx DESC");
                        $no = 1;
                        while ($p = mysqli_fetch_array($brgs)) {
                          $idb = $p['idx'];
                        ?>
                          <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $p['nama'] ?></td>
                            <td><?php echo $p['jenis'] ?></td>
                            <td><?php echo $p['merk'] ?></td>
                            <td><?php echo $p['ukuran'] ?></td>
                            <td><?php echo $p['stock'] ?></td>
                            <td><?php echo $p['satuan'] ?></td>
                            <td><?php echo $p['nama_supplier'] ?></td>
                            <td><?php echo $p['lokasi'] ?></td>
                            <td><button data-toggle="modal" data-target="#edit<?= $idb; ?>" class="btn btn-primary"><i class="ti-pencil"></i></button> <button data-toggle="modal" data-target="#del<?= $idb; ?>" class="btn btn-danger"><i class="ti-trash"></i></button></td>
                          </tr>
                          <!-- The Modal -->
                          <div class="modal fade" id="edit<?= $idb; ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form method="post">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Barang <?php echo $p['nama'] ?> - <?php echo $p['jenis'] ?> - <?php echo $p['ukuran'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $p['nama'] ?>">

                                    <label for="jenis">Jenis</label>
                                    <input type="text" id="jenis" name="jenis" class="form-control" value="<?php echo $p['jenis'] ?>">

                                    <label for="merk">Merk</label>
                                    <input type="text" id="merk" name="merk" class="form-control" value="<?php echo $p['merk'] ?>">

                                    <label for="ukuran">Ukuran</label>
                                    <input type="text" id="ukuran" name="ukuran" class="form-control" value="<?php echo $p['ukuran'] ?>">

                                    <label for="stock">Stock</label>
                                    <input type="text" id="stock" name="stock" class="form-control" value="<?php echo $p['stock'] ?>" readonly>

                                    <label for="satuan">Satuan</label>
                                    <div class="row">
                                      <div class="col">
                                        <input type="text" class="form-control" value="<?php echo $p['satuan'] ?>" readonly>
                                      </div>
                                      <div class="col">
                                        <select name="satuan" class="custom-select form-control" style="height: 3.3em;">
                                          <option value="Pilih satuan">Ubah satuan (optional)</option>
                                          <option value="Unit">Unit</option>
                                          <option value="Meter">Meter</option>
                                          <option value="Centimeter">Centimeter</option>
                                          <option value="Milimeter">Milimeter</option>
                                        </select>
                                      </div>
                                    </div>

                                    <label for="supplier">Supplier</label>
                                    <div class="row">
                                      <div class="col">
                                        <input type="text" class="form-control" value="<?php echo $p['nama_supplier'] ?>" readonly>
                                      </div>
                                      <div class="col">
                                        <select name="supplier" class="custom-select form-control" style="height: 3.3em;">
                                          <option value="Pilih supplier">Ubah supplier (optional)</option>
                                          <?php
                                          $supplier = mysqli_query($conn, "SELECT * FROM ssuplier_brg");
                                          while ($qSupplier = mysqli_fetch_array($supplier)) {
                                          ?>
                                            <option value="<?php echo $qSupplier['id_supplier'] ?>"><?php echo $qSupplier['nama_supplier'] ?></option>
                                          <?php
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>

                                    <label for="lokasi">Lokasi</label>
                                    <input type="hidden" name="idbrg" value="<?= $idb; ?>">
                                    <div class="row">
                                      <div class="col">
                                        <input type="text" class="form-control" value="<?php echo $p['lokasi'] ?>" readonly>
                                      </div>
                                      <div class="col">
                                        <select name="lokasi" class="custom-select form-control" style="height: 3.3em;">
                                          <option value="Pilih lokasi">Ubah lokasi (optional)</option>
                                          <?php
                                          $getGudang = mysqli_query($conn, "SELECT * FROM sgudang");
                                          while ($gudang = mysqli_fetch_array($getGudang)) {
                                          ?>
                                            <option value="<?php echo $gudang['id_gudang'] ?>"><?php echo $gudang['nama_gudang'] ?></option>
                                          <?php
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" name="update">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>

                          <!-- The Modal -->
                          <div class="modal fade" id="del<?= $idb; ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form method="post">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Hapus Barang <?php echo $p['nama'] ?> - <?php echo $p['jenis'] ?> - <?php echo $p['ukuran'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus barang ini dari daftar stock?
                                    <input type="hidden" name="idbrg" value="<?= $idb; ?>">
                                  </div>

                                  <!-- Modal footer -->
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success" name="hapus">Hapus</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>

                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <a href="exportstkbhn.php" target="_blank" class="btn btn-info">Export Data</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- row area start-->
    </div>
  </div>
  <!-- main content area end -->
  </div>
  <!-- page container area end -->

  <!-- footer area start-->
  <footer>
    <div class="footer-area p-4">
      <p class="text-right">Cipta Selaras Funiture &copy; 2021</p>
    </div>
  </footer>
  <!-- footer area end-->

  <!-- modal input -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Masukkan stok manual</h4>
        </div>
        <div class="modal-body">
          <form action="tmb_brg_act.php" method="post">
            <div class="form-group">
              <label>Nama</label>
              <input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
            </div>
            <div class="form-group">
              <label>Jenis</label>
              <input name="jenis" type="text" class="form-control" placeholder="Jenis / Kategori Barang">
            </div>
            <div class="form-group">
              <label>Merk</label>
              <input name="merk" type="text" class="form-control" placeholder="Merk Barang">
            </div>
            <div class="form-group">
              <label>Ukuran</label>
              <input name="ukuran" type="text" class="form-control" placeholder="Ukuran">
            </div>
            <div class="form-group">
              <label>Stock</label>
              <input name="stock" type="number" min="0" class="form-control" placeholder="Qty">
            </div>
            <div class="form-group">
              <label>Satuan</label>
              <select name="satuan" class="custom-select form-control" style="height: 3.3em;">
                <option selected>Pilih satuan</option>
                <option value="Unit">Unit</option>
                <option value="Meter">Meter</option>
                <option value="Centimeter">Centimeter</option>
                <option value="Milimeter">Milimeter</option>
              </select>
            </div>
            <div clas="form-group">
              <label>Supplier</label>
              <select name="supplier" class="custom-select form-control" style="height: 3.3em;">
                <option selected>Pilih supplier</option>
                <?php
                $supplier = mysqli_query($conn, "SELECT * FROM ssuplier_brg");
                while ($qSupplier = mysqli_fetch_array($supplier)) {
                ?>
                  <option value="<?php echo $qSupplier['id_supplier'] ?>"><?php echo $qSupplier['nama_supplier'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Lokasi</label>
              <!-- <input name="lokasi" type="text" class="form-control" placeholder="Lokasi barang"> -->
              <select name="lokasi" class="custom-select form-control" style="height: 3.3em;">
                <option selected>Pilih lokasi</option>
                <?php
                $getGudang = mysqli_query($conn, "SELECT * FROM sgudang");
                while ($gudang = mysqli_fetch_array($getGudang)) {
                ?>
                  <option value="<?php echo $gudang['id_gudang'] ?>"><?php echo $gudang['nama_gudang'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $('input').on('keydown', function(event) {
          if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
            var $t = $(this);
            event.preventDefault();
            var char = String.fromCharCode(event.keyCode);
            $t.val(char + $t.val().slice(this.selectionEnd));
            this.setSelectionRange(1, 1);
          }
        });
      });

      $(document).ready(function() {
        $('#dataTable3').DataTable({
          dom: 'Bfrtip',
          buttons: [
            'print'
          ]
        });
      });
    </script>
    <!-- Ionic Icon -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
      zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
      ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>


</body>

</html>