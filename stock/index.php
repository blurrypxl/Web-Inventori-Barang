<!doctype html>
<html class="no-js" lang="en">
<?php
include '../dbconnect.php';
include 'cek.php';
?>

<head>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="../favicon.png">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Dashboard | Cipta Selaras Funiture</title>
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
  <!-- others css -->
  <link rel="stylesheet" href="assets/css/typography.css">
  <link rel="stylesheet" href="assets/css/default-css.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <!-- modernizr css -->
  <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
  <!-- start chart js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
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
              <li class="active"><a href="index.php"><i class="ti-dashboard"></i><span>Dashboard</span></a></li>
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
              <li>
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
            <div class="search-box pull-left">
              <form action="#">
                <h5>Selamat Datang, <?= $_SESSION['user']; ?>!</h5>
              </form>
            </div>
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
              </ul>
            </div>
          </div>
          <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right" style="color:black; padding:0px;"></div>
          </div>
        </div>
      </div>
      <!-- page title area end -->
      <?php
      $label = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
      ?>
      <div class="main-content-inner">
        <div class="sales-report-area mt-5 mb-5">
          <div class="row">
            <?php
            for ($bulan = 1; $bulan < 13; $bulan++) {
              $qBrgMasuk = mysqli_query($conn, "select sum(jumlah) as jumlah from sbrg_masuk where MONTH(tgl)='$bulan'");
              $row = $qBrgMasuk->fetch_array();
              $jumlah_masuk[] = $row['jumlah'];
            }
            ?>
            <div class="col-md-4">
              <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                  <div class="icon"><i class="fa fa-arrow-down" aria-hidden="true"></i></div>
                  <div class="s-report-title text-center ">
                    <h4 class="header-title mb-0">Barang Masuk</h4>
                  </div>
                  <div class="d-flex justify-content-between pb-2"></div>
                </div>
                <canvas id="brg_masuk" height="100"></canvas>

                <script>
                  const brgMasuk = document.getElementById('brg_masuk').getContext('2d');
                  const chartBrgMasuk = new Chart(brgMasuk, {
                    type: 'line',
                    data: {
                      labels: <?php echo json_encode($label); ?>,
                      datasets: [{
                        label: 'Grafik Barang Masuk',
                        backgroundColor: "rgba(255, 99, 133, 0.50)",
                        borderColor: 'rgb(255, 99, 132)',
                        data: <?php echo json_encode($jumlah_masuk); ?>
                      }]
                    },
                    options: {
                      legend: {
                        display: false
                      },
                      scales: {
                        xAxes: [{
                          display: !1,
                          gridLines: {
                            zeroLineColor: "transparent"
                          },
                          ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>

            <?php
            for ($bulan = 1; $bulan < 13; $bulan++) {
              $qBrgKeluar = mysqli_query($conn, "select sum(jumlah) as jumlah from sbrg_keluar where MONTH(tgl)='$bulan'");
              $row = $qBrgKeluar->fetch_array();
              $jumlah_keluar[] = $row['jumlah'];
            }
            ?>
            <div class="col-md-4">
              <div class="single-report mb-xs-30">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                  <div class="icon"><i class="fa fa-arrow-up" aria-hidden="true"></i></div>
                  <div class="s-report-title text-center">
                    <h4 class="header-title mb-0">Barang Keluar</h4>
                  </div>
                  <div class="d-flex justify-content-between pb-2"></div>
                </div>
                <canvas id="brg_keluar" height="100"></canvas>

                <script>
                  const brgKeluar = document.getElementById("brg_keluar");
                  const chartBrgKeluar = new Chart(brgKeluar, {
                    type: 'line',
                    data: {
                      labels: <?php echo json_encode($label); ?>,
                      datasets: [{
                        label: 'Grafik Barang Keluar',
                        backgroundColor: 'rgb(255, 198, 99, 0.50)',
                        borderColor: 'rgb(255, 198, 99, 1)',
                        data: <?php echo json_encode($jumlah_keluar); ?>
                      }]
                    },
                    options: {
                      legend: {
                        display: false
                      },
                      scales: {
                        xAxes: [{
                          display: !1,
                          gridLines: {
                            zeroLineColor: "transparent"
                          },
                          ticks: {
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>

            <?php
            $stockBrg = mysqli_query($conn, "select * from sstock_brg");

            while ($queryStockBrg = mysqli_fetch_array($stockBrg)) {
              $nama_brg[] = $queryStockBrg['nama'];

              $qStock = mysqli_query($conn, "select sum(stock) as stock from sstock_brg where idx='" . $queryStockBrg['idx'] . "'");
              $row = $qStock->fetch_array();
              $jumlah_stock[] = $row['stock'];
            }
            ?>
            <div class="col-md-4">
              <div class="single-report">
                <div class="s-report-inner pr--20 pt--30 mb-3">
                  <div class="icon"><i class="fa fa-database" aria-hidden="true"></i></div>
                  <div class="s-report-title text-center">
                    <h4 class="header-title mb-0">Stok Barang</h4>
                  </div>
                  <div class="d-flex justify-content-between pb-2"></div>
                </div>
                <canvas id="stok_barang" height="100"></canvas>
                <script>
                  const stokBrg = document.getElementById("stok_barang").getContext('2d');
                  const chartStokBrg = new Chart(stokBrg, {
                    // The type of chart we want to create
                    type: 'bar',
                    // The data for our dataset
                    data: {
                      labels: <?php echo json_encode($nama_brg) ?>,
                      datasets: [{
                        label: "Grafik Stok Barang",
                        backgroundColor: "rgba(54, 255, 56, 1)",
                        borderColor: '#0b76b6',
                        data: <?php echo json_encode($jumlah_stock) ?>
                      }]
                    },
                    // Configuration options go here
                    options: {
                      legend: {
                        display: false
                      },
                      animation: {
                        easing: "easeInOutBack"
                      },
                      scales: {
                        xAxes: [{
                          display: !1,
                          gridLines: {
                            zeroLineColor: "transparent"
                          },
                          ticks: {
                            padding: 0,
                            fontColor: "rgba(0,0,0,0.5)",
                            fontStyle: "bold",
                            beginAtZero: true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
        <!-- sales report area end -->
      </div>
      <!-- page container area end -->

      <!-- footer area start-->
      <footer>
        <div class="footer-area p-4">
          <p class="text-right">Cipta Selaras Funiture &copy; 2021</p>
        </div>
      </footer>
      <!-- footer area end-->
      
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

      <!-- start highcharts js -->
      <script src="https://code.highcharts.com/highcharts.js"></script>
      <!-- start zingchart js -->
      <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
      <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
      </script>
      <!-- all line chart activation -->
      <!-- <script src="assets/js/line-chart.js"></script> -->
      <!-- all pie chart -->
      <script src="assets/js/pie-chart.js"></script>
      <!-- others plugins -->
      <script src="assets/js/plugins.js"></script>
      <script src="assets/js/scripts.js"></script>
</body>

</html>