<?php
include 'request.php';

function remove_format($str)
{
  $text = str_replace(",", "", $str);
  return $text;
}

$get = request_get('https://api.kawalcorona.com/indonesia/');
$positif = remove_format($get[0]['positif']);
$sembuh = remove_format($get[0]['sembuh']);
$meninggal = remove_format($get[0]['meninggal']);
$rawat = $positif - $sembuh - $meninggal;

$rate_sembuh = round(($sembuh / $positif) * 100, 2);
$rate_meninggal = round(($meninggal / $positif) * 100, 2);

$positif = number_format($positif, 0, ',', ',');
$rawat = number_format($rawat, 0, ',', ',');
$sembuh = number_format($sembuh, 0, ',', ',');
$meninggal = number_format($meninggal, 0, ',', ',');

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Update Kasus Covid-19 | gladibersih.com</title>
  <link rel="shortcut icon" href="assets/img/fav.png">

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>

<body class="bg-gradient-info">
  <div class="container">
    <!-- Outer Row -->
    <div class="justify-content-center">
      <div class="card o-hidden border-0 shadow-lg mt-5 mb-3">
        <div class="card-body">
          <div class="text-center mt-4">
            <h1 class="h4 text-gray-900 mb-4">Kasus Covid-19 di Indonesia</h1>
          </div>

          <div class="row mx-auto">
            <!-- start card -->
            <div class="col-md-3 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-primary mb-1">Covid-19 Positif</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $positif; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ambulance fa-3x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card -->
            <!-- start card -->
            <div class="col-md-3 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-primary mb-1">Covid-19 Dirawat</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $rawat; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hospital-alt fa-3x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card -->
            <!-- start card -->
            <div class="col-md-3 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-primary mb-1">Sembuh</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sembuh; ?> <small class="ml-1">(<?= $rate_sembuh; ?> %)</small></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-smile-beam fa-3x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card -->
            <!-- start card -->
            <div class="col-md-3 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="font-weight-bold text-primary mb-1">Meninggal</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $meninggal; ?> <small class="ml-1">(<?= $rate_meninggal; ?> %)</small></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-sad-cry fa-3x"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end card -->
          </div> <!-- end row -->

        </div>
      </div>

      <!-- new card -->
      <div class="card o-hidden border-0 shadow-lg">
        <div class="card-body">
          <div class="text-center mt-4">
            <h1 class="h4 text-gray-900 mb-3">Kasus Covid-19 Berdasarkan Provinsi</h1>
          </div>

          <div class="row mx-auto">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Provinsi</th>
                    <th>Positif</th>
                    <th>Sembuh</th>
                    <th>Meninggal</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $getProv = request_get('https://api.kawalcorona.com/indonesia/provinsi/'); 
                foreach ($getProv as $p) {
                ?>
                  <tr>
                    <td><?= $p['attributes']['Provinsi']; ?></td>
                    <td><?= $p['attributes']['Kasus_Posi']; ?></td>
                    <td><?= $p['attributes']['Kasus_Semb']; ?></td>
                    <td><?= $p['attributes']['Kasus_Meni']; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div> <!-- end row -->

        </div>
      </div>

    </div>


  </div>

  <!-- Footer -->
  <footer class="sticky-footer bg-white mt-3">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span><a href="https://gladibersih.com">gladibersih.com</a> &copy; 2020 | Data by <a href="https://kawalcorona.com/">Kawal Corona</a></span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>