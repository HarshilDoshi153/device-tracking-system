<?php
  session_start();
  if(!isset($_SESSION['MainDash56'])) {
    header("Location: login.html"); // replace with the URL of your dashboard page
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" type="image/png" href="./cvrlogo.png"/>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css" />
  <!-- Apex chart -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>
  <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png" />
  <link rel="manifest" href="assets/favicon/manifest.json" />
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png" />
  <meta name="theme-color" content="#ffffff" />
  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css" />
  <link rel="stylesheet" href="css/vendors/simplebar.css" />
  <link href="css/examples.css" rel="stylesheet" />
  <link href="vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/free.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/brand.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@2.0.0-beta.3/css/flag.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body ng-app="myApp" ng-controller="myController" class="hold-transition sidebar-mini layout-fixed">
  <!-- =========Navbar======= -->
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="height: 60px">
      <!-- Left navbar links -->
      <ul class="navbar-nav mx-3">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a id="fullscreen-toggle" class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
      <!-- Right navbar links -->
    </nav>
    <!-- /.navbar -->
    <!-- ==========Main Sidebar Container========= -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="https://www.cienciasvr.com" target="_blank">
        <img src="./loogo.png" class="" width="250" height="140" alt="Logo" />
      </a>
      <hr style="
              margin: 0px;
              height: 0.1px;
              border-width: 3px;
              color: #28a745;
              border-color: #1f203f;
              " />
      <!-- ===========Sidebar========== -->
      <div class="sidebar p-0" style="background-color: #1f203f">
        <nav class="mt-2">
          <ul class="sidebar-nav nav nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Dashboard -->
            <li class="nav-item">
              <a class="nav-link" href="#!indexPage" style="display: flex; align-items: center; height: 50px">
                <i class="cil-applications mx-2" style="font-size: 22px"></i>
                <p style="margin-left: 10px">Dashboard</p>
              </a>
            </li>
            <!-- LiveStatus -->
            <li class="nav-item">
              <a class="nav-link" href="#!liveStatus" style="display: flex; align-items: center; height: 50px">
                <i class="cil-toggle-on mx-2" style="font-size: 22px"></i>
                <p style="margin-left: 10px">Live Status</p>
              </a>
            </li>
            <!-- Schools -->
            <li class="nav-item">
              <a class="nav-link" href="#!school" style="display: flex; align-items: center; height: 50px">
                <i class="cil-school mx-2" style="font-size: 22px"></i>
                <p style="margin-left: 10px">Schools</p>
              </a>
            </li>
            <!-- Assets Link -->
            <li class="nav-item">
              <a href class="nav-link" style="display: flex; align-items: center; height: 50px">
                <i class="cil-screen-desktop mx-2" style="font-size: 22px"></i>
                <p style="margin-left: 10px">
                  Assets
                  <i class="fas fa-angle-left right my-1"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- Assets List Link -->
                <li class="nav-item">
                  <a href="#!assets" class="nav-link" style="display: flex; align-items: center; height: 50px">
                    <i class="cil-chevron-right mx-3" style="font-size: 18px"></i>
                    <p>Assets List</p>
                  </a>
                </li>
                <!-- Reg. Info Link -->
                <li class="nav-item">
                  <a href="#!regInfo" class="nav-link" style="display: flex; align-items: center; height: 50px">
                    <i class="cil-chevron-right mx-3" style="font-size: 18px"></i>
                    <p>Reg. Info</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Activity Link -->
            <li class="nav-item">
              <a href class="nav-link" style="display: flex; align-items: center; height: 50px">
                <i class="cil-window-restore mx-2" style="font-size: 22px"></i>
                <p style="margin-left: 10px">
                  Activity
                  <i class="fas fa-angle-left right my-1"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <!-- Device Timing Link -->
                <li class="nav-item">
                  <a href="#!device" class="nav-link" style="display: flex; align-items: center; height: 50px">
                    <i class="cil-chevron-right mx-3" style="font-size: 18px"></i>
                    <p>Device Timing</p>
                  </a>
                </li>
                <!-- Application Timing Link -->
                <li class="nav-item">
                  <a href="#!activity" class="nav-link" style="display: flex; align-items: center; height: 50px">
                    <i class="cil-chevron-right mx-3" style="font-size: 18px"></i>
                    <p>Application Timing</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Reports Link -->
            <li class="nav-item">
              <a href="#!reports" class="nav-link" style="display: flex; align-items: center; height: 50px">
                <i class="cil-touch-app mx-2" style="font-size: 22px"></i>
                <p style="margin-left: 10px">Reports</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- Login -->
        <a href="login.html" style="bottom: 0;">
          <button class="logOut cil-account-logout" type="button"></button></a>
      </div>
    </aside>
    <div ng-view></div>

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
    <script src="plugins/jquery/jquery.min.js"></script>

    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script>
      document.getElementById('fullscreen-toggle').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default link behavior (i.e., page refresh)

        // Check if fullscreen mode is enabled, and toggle accordingly
        if (!document.fullscreenElement) {
          document.documentElement.requestFullscreen(); // Enter fullscreen mode
        } else {
          if (document.exitFullscreen) {
            document.exitFullscreen(); // Exit fullscreen mode
          }
        }
      });
    </script>
    <script>
      var app = angular.module("myApp", ["ngRoute"]);
      // Angular Routing 
      app.config(function ($routeProvider) {
        $routeProvider
        .when("/", {
          templateUrl: "index.php",
          controller: "myController"
        })
        .when("/", {
          templateUrl: "indexPage.php",
          controller: "indexPageController"
        })
          .when("/liveStatus", {
            templateUrl: "liveStatus.php",
            controller: "liveStatusController",
          })
          .when("/school", {
            templateUrl: "school.php",
            controller: "schoolController"
          })
          .when("/assets", {
            templateUrl: "assets.php",
            controller: "assetsController"
          })
          .when("/regInfo", {
            templateUrl: "regInfo.php",
            controller: "regInfoController"
          })
          .when("/device", {
            templateUrl: "duration.php",
            controller: "deviceController"
          })
          .when("/activity", {
            templateUrl: "activity.php",
            controller: "activityController"
          })
          .when("/reports", {
            templateUrl: "reports.php",
            controller: "reportsController"
          })
          .otherwise({
            redirectTo: "/",
            controller: "myController"
          });
      })
      var InitializeVariables = function ($scope) {
        $scope.Did = '';
        $scope.Bid = '';
        $scope.Vid = '';
        $scope.Sid = '';
      }
      // Function to load Districts in dropdown menu
      var loadDistricts = function ($scope, $http) {
        $scope.loadDistricts = function () {
          $http.post("load_Data.php", { action: "load_Districts" })
            .then(function (response) {
              $scope.Districts = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        }
        // Calling function when district is selected
        loadBlocks($scope, $http);
      }
      // Function to load Blocks in dropdown menu
      var loadBlocks = function ($scope, $http) {
        $scope.loadBlocks = function () {
          $http.post("load_Data.php", { action: "load_Blocks", 'dis': $scope.Did })
            .then(function (response) {
              $scope.Blocks = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        }
        // Calling function when block is selected
        loadVillages($scope, $http);
      }
      // Function to load Villages in dropdown menu
      var loadVillages = function ($scope, $http) {
        $scope.loadVillages = function () {
          $http.post("load_Data.php", { action: "load_Villages", 'bl': $scope.Bid, 'dis': $scope.Did })
            .then(function (response) {
              $scope.Villages = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        }
        // Calling function when village is selected
        loadSchools($scope, $http);
      }
      // Function to load Schools in dropdown menu
      var loadSchools = function ($scope, $http) {
        $scope.loadSchools = function () {
          $http.post("load_Data.php", { action: "load_Schools", 'vill': $scope.Vid, 'bl': $scope.Bid, 'dis': $scope.Did })
            .then(function (response) {
              $scope.Schools = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        }
        // Calling function when school is selected
        loadSerials($scope, $http);
      }
      // Function to load Serial_numbers in dropdown menu
      var loadSerials = function ($scope, $http) {
        $scope.loadSerials = function () {
          $http.post("load_Data.php", { action: "load_Serials", 'sch': $scope.Sid, 'vill': $scope.Vid, 'bl': $scope.Bid, 'dis': $scope.Did })
            .then(function (response) {
              $scope.Serials = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        }
      }
      // Function to destroy and Reinitialize Datatable
      var destroyAndInitDataTable = function ($timeout) {
        // Check if DataTable instance exists and destroy it
        if ($.fn.DataTable.isDataTable('#example2')) {
          $('#example2').DataTable().destroy();
        }
        // Reinitialize DataTable with new data
        $timeout(function () {
          $("#example2").DataTable({
            pageLength: 15,
            lengthMenu: [15, 25, 50, 75, 100], // Optional: To include different page lengths in the dropdown
            paging: true, // Enable pagination
            ordering: true, // Enable sorting
            searching: true, // Enable search box
            info: true, // Show information
            // scrollX: true, // Enable horizontal scrolling
            responsive: true
          });
        }, 10);
      }
      // Main controller
      app.controller("myController", function ($scope) {
        $scope.activeLink = 'link1';
        // $scope.setActiveLink('link0');

        $scope.setActiveLink = function (link) {
          $scope.activeLink = link;
        };
      });
      // IndexPage Controller - Used to load indexPage.html
      app.controller("indexPageController", function ($scope, $http) {
        console.log("IndexPage Loaded");
        // Function to load number of total android, total active android and total schools and also load charts
        $scope.countSchools = function () {

          $http.post("load_Data.php", { action: 'count_Schools' })
            .then(function (response) {
              // Define two arrays that is used to display the total devices and active devices district wise when user hover on the map
              $scope.total_devices_districtWise = {};
              $scope.active_devices_districtWise = {};
              // Loop to store the data in such a way that district as key and total_devices as value
              angular.forEach(response.data[1], function (item) {
                $scope.total_devices_districtWise[item.district] = item.total_devices_districts;
              });
              // Loop to store the data in such a way that district as key and active_devices as value
              angular.forEach(response.data[2], function (item) {
                $scope.active_devices_districtWise[item.district] = item.active_devices_districts;
              });
              $scope.num_schools = response.data[0][0].num_schools;
              $scope.num_active_devices = response.data[0][0].num_active_devices;
              $scope.num_total_devices = response.data[0][0].num_total_devices;
              // if the value is less than or equal to 9 then prepend the 0 with value. (make 9 to 09)
              if ($scope.num_active_devices <= 9) {
                $scope.num_active_devices = "0" + $scope.num_active_devices;
              }
              if ($scope.num_schools <= 9) {
                $scope.num_schools = "0" + $scope.num_schools;
              }
              if ($scope.num_total_devices <= 9) {
                $scope.num_total_devices = "0" + $scope.num_total_devices;
              }

              // Get the canvas element
              var ctxDesktop = document.getElementById("myDoughnutChart1").getContext("2d");
              // Doughnut Desktop chart data
              $scope.desktopData = {
                labels: ["Active", "Inactive"],
                datasets: [
                  {
                    data: [$scope.num_active_devices, $scope.num_total_devices - $scope.num_active_devices],
                    backgroundColor: ["#4388cc", "#90c6fc", "#ffce56"],
                    hoverBackgroundColor: ["#85c2ff", "#c7e3ff", "#ffce56"],
                  },
                ],
              };
              $scope.options = {
                cutoutPercentage: 50, // Adjust the size of the center hole (0 for a pie chart, 50 for a doughnut chart)
                responsive: true,
                maintainAspectRatio: false,
              };
              // Create the Desktop doughnut chart
              var myDoughnutChart = new Chart(ctxDesktop, {
                type: "doughnut",
                data: $scope.desktopData,
                options: $scope.options,
              });
              // Get the android canvas element
              var ctxAndroid = document.getElementById("myDoughnutChart2").getContext("2d");
              // Doughnut Android chart data
              $scope.androidData = {
                labels: ["Active", "Inactive"],
                datasets: [
                  {
                    data: [$scope.num_active_devices, $scope.num_total_devices - $scope.num_active_devices],
                    backgroundColor: ["#f2b32c", "#ffd170", "#ffce56"],
                    hoverBackgroundColor: ["#ffcf69", "#ffd887", "#ffce56"],
                  },
                ],
              };
              // Doughnut chart options
              var myDoughnutChart = new Chart(ctxAndroid, {
                type: "doughnut",
                data: $scope.androidData,
                options: $scope.options,
              });
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        }
      })
      // Livestatus Controller - Used to load liveStatus.html
      app.controller("liveStatusController", function ($scope, $http, $timeout) {
        console.log("liveStatus Loaded");
        InitializeVariables($scope);
        $scope.sta = 'Active';
        $scope.loadData = function () {
          $http.post("load_Data.php", { action: 'load_ActiveData', 'sta': $scope.sta })
            .then(function (response) {
              $scope.data = response.data;
              // Calling function to destroy and ReInitialize the datatable 
              destroyAndInitDataTable($timeout);
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        },
          // Calling function to load Districts
          loadDistricts($scope, $http);
      });
      // School Controller - Used to load the school.html
      app.controller("schoolController", function ($scope, $http, $timeout) {
        console.log("school Loaded");
        // Initialize Variables
        InitializeVariables($scope);
        $scope.loadData = function () {
          $http.post("load_Data.php", { action: 'load_SchoolData' })
            .then(function (response) {
              $scope.data = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        },
        $scope.Clear = function(){
          $scope.dise = "";
          $scope.Did = "";
          $scope.Bid = "";
          $scope.Vid = "";
          $scope.Sid = "";
        }
          // Calling function to load Districts
          loadDistricts($scope, $http);
        $timeout(function () {
          $(document).ready(function () {
            $("#example2").DataTable({
              pageLength: 15,
              lengthMenu: [15, 25, 50, 75, 100], // Optional: To include different page lengths in the dropdown
              paging: true, // Enable pagination
              ordering: true, // Enable sorting
              searching: true, // Enable search box
              info: true, // Show information
              // scrollX: true, // Enable horizontal scrolling
              responsive: true,
            });
          });
        }, 50);
      });
      // Assets Controller - Used to load assets.html
      app.controller("assetsController", function ($scope, $http, $timeout) {
        console.log("assets Loaded")
        // Initialize variables
        InitializeVariables($scope);
        // var dataTableInitialized = false; // Flag to track DataTable initialization
        // var dataTableInstance; // Reference to DataTable instance
        $scope.loadData = function () {
          $http.post("load_Data.php", { action: 'load_assetsData', 'dis': $scope.Did })
            .then(function (response) {
              $scope.data = response.data;
              destroyAndInitDataTable($timeout);
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
          $http.post("load_Data.php", { action: "load_Blocks", 'dis': $scope.Did })
            .then(function (response) {
              $scope.Blocks = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        },
        $scope.Clear = function(){
          $scope.Did = "";
          $scope.Bid = "";
          $scope.Vid = "";
          $scope.Sid = "";
          $scope.loadData();
        }
          // Calling function to load Districts
          loadDistricts($scope, $http);
        // Problem in loading the datatable
        $timeout(function () {
          $(document).ready(function () {
            $("#example2").DataTable({
              pageLength: 15,
              lengthMenu: [15, 25, 50, 75, 100], // Optional: To include different page lengths in the dropdown
              paging: true, // Enable pagination
              ordering: true, // Enable sorting
              searching: true, // Enable search box
              info: true, // Show information
              scrollX: true, // Enable horizontal scrolling
              responsive: true,
            });
          });
        }, 100);
      });
      // DateRange filter to filter the data based on the fromDate and toDate (only used in assets)
      app.filter('dateRange', function () {
        return function (items, fromDate, toDate) {
          var result = [];

          var from_date = new Date(fromDate).getTime();
          var to_date = new Date(toDate).getTime();

          angular.forEach(items, function (item) {
            var itemDate = new Date(item.regDate).getTime();

            if (itemDate >= from_date && itemDate <= to_date) {
              result.push(item);
            }
          });
          return result;
        };
      });
      // regInfo Controller - Used to load regInfo.html (Registration Info)
      app.controller("regInfoController", function ($scope, $http, $timeout) {
        console.log("regInfo Loaded");
        // Initialize variables
        InitializeVariables($scope);
        // Load Data based on the current date
        $scope.loadData = function () {
          $http.post("load_Data.php", { action: 'load_regInfoData' })
            .then(function (response) {
              $scope.data = response.data;
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
          // Load the data based on from date and to date
          $http.post("load_Data.php", { action: 'load_AllData' })
            .then(function (response) {
              $scope.Alldata = response.data;
              destroyAndInitDataTable($timeout);
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        },
        $scope.Clear = function(){
          $scope.dise = "";
          $scope.Did = "";
          $scope.Bid = "";
          $scope.Vid = "";
          $scope.Sid = "";
          $scope.fromDate = "";
          $scope.toDate = "";
        }
          // Calling function to load Districts
          loadDistricts($scope, $http);
      });
      // device Controller - Used to load duration.html (Device On-Off Timing Page)
      app.controller("deviceController", function ($scope, $http, $timeout) {
        console.log("Device Loaded");
        // Initialize variables
        InitializeVariables($scope);
        // Load the JSON Data based on the Serial_number
        $scope.loadData = function (serial) {
          $http.post(`Data/${serial}_timingsData.json`)
            .then(function (response) {
              $scope.data = response.data.entries;
              destroyAndInitDataTable($timeout);
            })
            .catch(function (error) {
              console.error("Error : " + error);
            })
        },
          // Calling function to load Districts
          loadDistricts($scope, $http);
      });
      // Activity Controller - Used to load activity.html (Application On-Off Timing Page)
      app.controller("activityController", function ($scope, $http, $timeout) {
        console.log("Activity Loaded");
        // Initialize variables
        InitializeVariables($scope);
        //Load the JSON Data based on the Serial_number
        $scope.loadData = function (serial) {
          $http.post(`Data/${serial}_app_usage_data.json`)
            .then(function (response) {
              $scope.data = response.data;
              destroyAndInitDataTable($timeout);
            })
            .catch(function (error) {
              $scope.data = null;
              console.error("Error" + error);
            })
        },
          // Calling function to load Districts
          loadDistricts($scope, $http);
      });
      // Reports Controller - Used to load reports.html
      app.controller("reportsController", function ($scope, $http, $timeout) {
        console.log("reports Loaded");
        // Initialize variables
        InitializeVariables($scope);
        // Load the JSON Data based on the Serial_number
        $scope.loadData = function (serial) {
          $http.post(`Data/${serial}_timingsData.json`)
            .then(function (response) {
              $scope.data = response.data.entries;
              destroyAndInitDataTable($timeout);
            })
            .catch(function (error) {
              console.error("Error" + error);
            })
        },
          // Calling function to load Districts
          loadDistricts($scope, $http);
      });

    </script>
  </body>
  
  </html>