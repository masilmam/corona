<?php
include 'request.php';
$get = request_get('https://api.kawalcorona.com/indonesia/');
$positif = $get[0]['positif'];
$sembuh = $get[0]['sembuh'];
$meninggal = $get[0]['meninggal'];
// $hasil = $get[0]['positif'] - $get[0]['sembuh'];

function remove_format($str)
{
  $text = str_replace(",", "", $str);
  return $text;
}

$rawat = remove_format($positif) - remove_format($sembuh) - remove_format($meninggal);
$rawat = number_format($rawat, 0, ',', ',');
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

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
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
      <div class="card o-hidden border-0 shadow-lg my-5">
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sembuh; ?></div>
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
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $meninggal; ?></div>
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
    </div>


  </div>

  <!-- Footer -->
  <footer class="sticky-footer bg-white mt-auto footer">
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

</body>

</html>