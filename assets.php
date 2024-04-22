<?php
session_start();
if (!isset ($_SESSION['MainDash56'])) {
  header("Location: login.html"); // replace with the URL of your dashboard page
  exit;
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp" ng-controller="assetsController">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assets</title>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script> -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,700&display=swap" /> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <!-- Apex chart -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <!-- <link rel="stylesheet" href="https://unpkg.com/@popperjs/core@2.11.6/dist/umd/popper.min.css"> -->
  <!-- <link rel="stylesheet" href="https://unpkg.com/tippy.js@6.3.3/dist/tippy.css"> -->
  <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png" />
  <!-- <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png"> -->
  <link rel="manifest" href="assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <!-- <link href="css/style.css" rel="stylesheet"> -->
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link href="css/examples.css" rel="stylesheet">
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css">
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/brand.min.css">
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/flag.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css"><!-- -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="content-wrapper" style="background-color: #f0f0f9;">
    <div class="content-header mx-3">
      <div class="container-fluid">
        <div class="row mb-1">
          <h2 style="color: #1f203f;" class="p-0"><b>Assets</b></h2>
        </div>
      </div>
    </div>

    <section class="content" style="display: flex;flex-direction: column; align-items: center;">
      <div class="col-lg-12">
        <div class="card round card-default shadow" style="border: 0; background-color: #faf8fc">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-2 col-12" ng-init="loadDistricts()">
                <label class="my-1"><b>District</b></label>
                <select name="Districts" ng-model="Did" ng-change="loadData()" class="form-control select2bs4"
                  style="width: 100%">
                  <option value>Please Select</option>
                  <option ng-repeat="dis in Districts" value="{{dis.district}}">{{dis.district}}</option>
                </select>
              </div>
              <div class="col-lg-2 col-12">
                <label class="my-1"><b>Block</b></label>
                <select name="Blocks" ng-model="Bid" ng-change="loadVillages()" class="form-control select2bs4"
                  style="width: 100%">
                  <option value="">Please Select</option>
                  <option ng-repeat="bl in Blocks" value="{{bl.block}}"> {{bl.block}} </option>
                </select>
              </div>
              <div class="col-lg-2 col-12">
                <label class="my-1"><b>Village</b></label>
                <select name="Villages" ng-model="Vid" ng-change="loadSchools()" class="form-control select2bs4"
                  style="width: 100%">
                  <option value="">Please Select</option>
                  <option ng-repeat="vill in Villages" value="{{vill.village}}">{{vill.village}}</option>
                </select>
              </div>
              <div class="col-lg-2 col-12">
                <label class="my-1"><b>School Name</b></label>
                <select name="Schools" ng-model="Sid" class="form-control select2bs4" style="width: 100%"
                  name="district">
                  <option value="">Please Select</option>
                  <option ng-repeat="sch in Schools" value="{{sch.school}}"> {{sch.school}} </option>
                </select>
              </div>
              <!-- <div class="col-lg-1 col-12">
                <div class="form-group">
                  <button id="action" type="submit" class="btn bg rounded-1 btn-clr btn-md w-100"
                    style="margin-top: 30px; border-radius:10px" name="send" ng-model="clear" ng-click="Clear()"> Clear</button>
                </div>
              </div> -->
              <div class="col-lg-2 col-12"></div>
              <div class="col-lg-1 col-12">
                <form action="printCSV.php" method="post">
                  <div class="form-group">
                    <button id="action" type="submit" class="btn bg rounded-1 btn-clr btn-md w-100"
                      style="margin-top: 0px; border-radius:10px" name="generateCSV">
                      <i class="fas fa-solid fa-download"></i><br>Print CSV</button>
                  </div>
                </form>
              </div>
              <div class="col-lg-1 col-12">
                <form action="printPDF.php" method="post">
                  <div class="form-group">
                    <button id="action" type="submit" name="btnPDF" class="btn bg rounded-1 btn-clr btn-md w-100"
                      style="margin-top: 0px; border-radius: 10px;" name="generatePDF">
                      <i class="fas fa-solid fa-download"></i><br>Print PDF</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 my-1">
        <div class="card shadow round" style="border: 0;">
          <div class="card-header round-header" style="height: 50px;">
            <b>List of Assets</b>
          </div>
          <div class="card-body p-3">
            <div class="  p-0 table-responsive">
              <!-- <div ng-init="loadData()"> -->
              <table id="example2" border="1" class="table table-bordered text-nowrap" style="top:0; width:100%;">
                <thead class="fixed-header" style="color: #1f203f; background-color:#5f4279;">
                  <tr>
                    <th class="text-center">Sr</th>
                    <th class="text-center">Dise Code</th>
                    <th class="text-center">School Name</th>
                    <th class="text-center">Lab</th>
                    <th class="text-center">Computer Number</th>
                    <th class="text-center">Desktop Serial</th>
                    <th class="text-center">TFT Serial</th>
                    <th class="text-center">Webcam Serial</th>
                    <th class="text-center">Headphone Serial</th>
                    <th class="text-center">Switch Serial</th>
                  </tr>
                </thead>
                <tbody class="card-body">
                  <tr ng-repeat="d in data | filter: {district: Did, block: Bid, village: Vid, school: Sid}">
                    <td class="text-center">{{$index + 1}}</td>
                    <td class="text-center">{{d.dise_code}}</td>
                    <td class="text-center">{{d.school}}</td>
                    <td class="text-center">{{d.lab}}</td>
                    <td class="text-center">{{d.comp_number}}</td>
                    <td class="text-center">{{d.serial_number}}</td>
                    <td class="text-center">{{d.TFT_serial}}</td>
                    <td class="text-center">{{d.WEB_serial}}</td>
                    <td class="text-center">{{d.Head_serial}}</td>
                    <td class="text-center">{{d.Switch_serial}}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <footer class="main-footer" style="color: #1f203f;">
    Copyright &copy; 2023-2025
    <a href="https://cienciasvr.com/" target="_blank">Ciencias IN VR Private Limited</a>.
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 0.0.2
    </div>
  </footer>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="vendors/chart.js/js/chart.min.js"></script>
  <script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
  <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
  <script src="js/main.js"></script>
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/semantic-ui/dist/semantic.min.js"></script>
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <script>
    //Initialize Select2 Elements
    $('.select2').select2();
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: 'Please Select'
    });
    $(document).ready(function () {
      $('.select2bs4').select2({
        theme: 'bootstrap4',
        placeholder: 'Please Select',
        allowClear: true,
      });
    });
  </script>

  <!-- Initialize the dropdown -->
  <script>
    $(document).ready(function () {
      $('#genderDropdown').dropdown({
        fullTextSearch: true, // Enable full-text search
      });
    });
  </script>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
  <script src="js/main.js"></script>

  <script>
    // $(document).ready(function () {
    //   $('#example2').DataTable({
    //     pageLength: 15,
    //     lengthMenu: [15, 25, 50, 75, 100], // Optional: To include different page lengths in the dropdown
    //     paging: true, // Enable pagination
    //     ordering: true, // Enable sorting
    //     searching: true, // Enable search box
    //     info: true, // Show information
    //     //"scrollX": true, // Enable horizontal scrolling
    //     responsive: true
    //   });
    // });
  </script>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>

  <script src="plugins/datatables/jquery.dataTables.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
</body>

</html>