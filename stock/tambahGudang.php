<!doctype html>
<html class="no-js" lang="en">

<?php
include '../dbconnect.php';
include 'cek.php';

if (isset($_POST['update'])) {
  $id = $_POST['id']; //id akun
  $gudang = $_POST['gudang'];

  // Cek duplikasi username atau nickname
  $cek = mysqli_query($conn, "SELECT * FROM sgudang WHERE nama_gudang='$gudang'");

  if (mysqli_num_rows($cek) > 0) {
    echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 3 seconds.
          </div>
          <meta http-equiv='refresh' content='3; url= tambahGudang.php'/>";
    header("location: tambahGudang.php?status=data-gudang-sudah-tersedia");
  } else {
    $upAkun = mysqli_query($conn, "update sgudang set nama_gudang='$gudang' where id_gudang='$id'");

    //cek apakah berhasil
    if ($upAkun) {
      echo "<div class='alert alert-success'>
              <strong>Success!</strong> Redirecting you back in 1 seconds.
            </div>
            <meta http-equiv='refresh' content='1; url= tambahGudang.php'/>";
      header("location: tambahGudang.php?status=data-berhasil-diupdate");
    } else {
      echo "<div class='alert alert-warning'>
              <strong>Failed!</strong> Redirecting you back in 3 seconds.
            </div>
            <meta http-equiv='refresh' content='3; url= tambahGudang.php'/>";
      header("location: tambahGudang.php?status=data-gagal-diupdate");
    };
  }
};

if (isset($_POST['hapus'])) {
  $id = $_POST['id'];

  $del = mysqli_query($conn, "delete from sgudang where id_gudang='$id'");

  //cek apakah berhasil
  if ($del) {
    echo " <div class='alert alert-success'>
                <strong>Success!</strong> Redirecting you back in 1 seconds.
              </div>
            <meta http-equiv='refresh' content='1; url= tambahGudang.php'/>";
    header("location: tambahGudang.php?status=data-berhasil-dihapus");
  } else {
    echo "<div class='alert alert-warning'>
                <strong>Failed!</strong> Redirecting you back in 1 seconds.
              </div>
             <meta http-equiv='refresh' content='1; url= tambahGudang.php'/>";
    header("location: tambahGudang.php?status=data-gagal-dihapus");
  }
};
?>

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../favicon.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Tambah Supplier | Cipta Selaras Funiture</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/themify-icons.css">
  <link rel="stylesheet" href="assets/css/metisMenu.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/slicknav.min.css">
  <!-- amchart css -->
  <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
  <!-- Start datatable css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
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

  <!-- my css -->
  <link rel="stylesheet" href="assets/css/mycss.css">
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
              <li><a href="index.php"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
              <?php
              if ($_SESSION['role'] == 'super admin') {
                echo '<li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i><ion-icon name="contact"></ion-icon></i><span>Super Admin Page</span></a>
                        <ul class="active">
                          <li>
                            <a href="tambahUser.php"><i class="ti-user"></i><span>Tambah User</span></a>
                          </li>
                          <li>
                            <a href="tambahSupp.php"><i><ion-icon name="people"></ion-icon></i><span>Tambah Supplier</span></a>
                          </li>
                          <li class="active">
                            <a href="tambahGudang.php"><i><ion-icon name="cube"></ion-icon></i><span>Tambah Gudang</span></a>
                          </li>
                        </ul>
                      </li>';
              }
              ?>
              <li>
                <a href="stock.php"><i class="ti-file"></i><span>Stock Barang</span></a>
              </li>
              <li>
                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Transaksi Data
                  </span></a>
                <ul class="active">
                  <li class="active"><a href="masuk.php">Barang Masuk</a></li>
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
      if (isset($_GET['status'])) {
        if ($_GET['status'] == "data-gudang-sudah-tersedia") {
          echo "<div class='alert alert-warning'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data gudang sudah tersedia
                </div>";
        }
        if ($_GET['status'] == "data-berhasil-ditambah") {
          echo "<div class='alert alert-success'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data berhasil ditambah
                </div>";
        }
        if ($_GET['status'] == "data-gagal-ditambah") {
          echo "<div class='alert alert-success'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data gagal ditambah
                </div>";
        }
        if ($_GET['status'] == "data-berhasil-diupdate") {
          echo "<div class='alert alert-success'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data berhasil diupdate
                </div>";
        }
        if ($_GET['status'] == "data-gagal-diupdate") {
          echo "<div class='alert alert-danger'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data gagal diupdate
                </div>";
        }
        if ($_GET['status'] == "data-berhasil-dihapus") {
          echo "<div class='alert alert-success'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data berhasil dihapus
                </div>";
        }
        if ($_GET['status'] == "data-gagal-dihapus") {
          echo "<div class='alert alert-danger'>
                  <button class='close' data-dismiss='alert'>&times</button>
                  Data gagal dihapus
                </div>";
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
                <li><span>Tambah Gudang</span></li>
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
                  <h2><i>
                      <ion-icon name="cube" size="large"></ion-icon>
                    </i> Tambah Gudang</h2>
                  <button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="ti-plus"></span> Tambah</button>
                </div>
                <div class="data-tables datatable-dark">
                  <div class="table-responsive">
                    <table id="dataTable3" class="table table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th>ID Gudang</th>
                          <th>Gudang</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $getGudang = mysqli_query($conn, "select * from sgudang order by id_gudang desc");
                        while ($dataGudang = mysqli_fetch_array($getGudang)) {
                          $id = $dataGudang['id_gudang'];
                        ?>

                          <tr>
                            <td><?php echo $id ?></td>
                            <td><?php echo $dataGudang['nama_gudang'] ?></td>
                            <td><button data-toggle="modal" data-target="#edit<?= $id; ?>" class="btn btn-primary ti-pencil"></button> <button data-toggle="modal" data-target="#del<?= $id; ?>" class="btn btn-danger ti-trash"></button></td>
                          </tr>

                          <!-- The Modal -->
                          <div class="modal fade" id="edit<?= $id; ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form method="post">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Edit Data</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    <label for="id">ID Gudang</label>
                                    <label class="form-control" name="id"><?php echo $dataGudang['id_gudang'] ?></label>

                                    <label for="gudang">Gudang</label>
                                    <input type="text" class="form-control" name="gudang" value="<?php echo $dataGudang['nama_gudang'] ?>" autofocus required>

                                    <input type="hidden" name="id" value="<?= $id ?>">
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
                          <div class="modal fade" id="del<?= $id ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <form method="post">
                                  <!-- Modal Header -->
                                  <div class="modal-header">
                                    <h4 class="modal-title">Hapus Supplier <?php echo $dataGudang['id_gudang'] ?> - <?php echo $dataGudang['nama_gudang'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>

                                  <!-- Modal body -->
                                  <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus akun ini dari tabel akun?
                                  </div>

                                  <input type="hidden" name="id" value="<?= $id ?>">

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
              </div>
            </div>
          </div>
        </div>
        <!-- row area start -->
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
          <h4 class="modal-title">Tambah Gudang Baru</h4>
        </div>
        <div class="modal-body">
          <form action="tambah_gudang_act.php" method="post">
            <div class="form-group">
              <label>Nama Gudang</label>
              <input name="gudang" type="text" class="form-control" placeholder="Masukan gudang">
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

    <!-- ionicons -->
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
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
