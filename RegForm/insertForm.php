<!DOCTYPE html>
<html lang="en">
<!-- Device Serial Number = comp_number(Database)
    Desktop Serial = serial_number(Database) -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <title>Insert</title>
    <link rel="icon" type="image/png" href="../cvrlogo.png" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e7e4fe;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            background-color: #f9f9f9;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        button {
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #5f4279;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
        }

        button:hover {
            background-color: #78638b;
        }

        input[disabled] {
            background-color: #ddd;
        }
    </style>
</head>


<body ng-app="myApp" ng-controller="myController">
    <h1> INSERT DETAILS </h1></br>
    <!-- Dise code to select data -->
    <table>
        <div style="border-radius:10px;" >
        <form ng-submit="loadFormData()">
            <tr>
                <th>DISE CODE: <input type="text" name="dise_code" ng-model="diseID" required autocomplete="off"></th>
                <th><button style="margin-top:28px;"> GET DETAILS </button></th>
            </tr>
        </form>
    </div>
    </table>
    </br>
    <!-- Load data into field -->
    <table>
        <form ng-submit="InsertData()">
            <tr>
                <td>DISTRICT:</td>
                <td><input type="text" name="district" ng-model="formData.district" required disabled
                        autocomplete="off"></br>
                </td>
                <td></td>
                <td></td>
                <td>BLOCK:</td>
                <td><input type="text" name="block" ng-model="formData.block" required disabled autocomplete="off"></br>
                </td>
            </tr>
            <tr>
                <td>VILLAGE:</td>
                <td><input type="text" name="village" ng-model="formData.village" required disabled
                        autocomplete="off"></br></td>
                <td></td>
                <td></td>
                <td>SCHOOL:</td>
                <td><input type="text" name="school" ng-model="formData.school" required disabled
                        autocomplete="off"></br></td>
            </tr>
            <tr>
                <td>COMPUTER NUMBER:</td>
                <td><input type="text" name="comp_number" ng-model="formData.comp_number" required
                        autocomplete="off"></br></td>
                <td></td>
                <td></td>
                <td>LAB:</td>
                <td><input type="number" min="1" max="2" name="lab" ng-model="formData.lab" required autocomplete="off"
                        placeholder="1 or 2"></br></td>
            </tr>
            <tr>
                <td>DESKTOP SERIAL:</td>
                <td><input type="text" name="serial_number" ng-model="SerialNumber" required disabled
                        autocomplete="off"></br>
                </td>
                <td></td>
                <td></td>
                <td>TFT SERIAL:</td>
                <td><input type="text" name="TFT_serial" ng-model="TFT_serial" required autocomplete="off"></br></td>
            </tr>
            <tr>
                <td>WEBCAM SERIAL:</td>
                <td><input type="text" name="WEB_serial" ng-model="WEB_serial" required autocomplete="off"></br></td>
                <td></td>
                <td></td>
                <td>HEADPHONE SERIAL:</td>
                <td><input type="text" name="Head_serial" ng-model="Head_serial" required autocomplete="off"></br></td>
            </tr>
            <tr>
                <td>SWITCH SERIAL:</td>
                <td><input type="text" name="Switch_serial" ng-model="Switch_serial" required autocomplete="off"></td>
                <td></td>
                <td></td>
                <td>REGISTRATION DATE:</td>
                <td><input type="date" id="dateInput" name="regDate" value="<?php echo date('Y-m-d'); ?>" required
                        disabled autocomplete="off">
                </td>
            </tr>
            <tr>
                <td colspan="6"><input type="hidden" name="Status" ng-model="Status" ng-init="Status= 'Inactive'"
                        ng-value="Status" required disabled autocomplete="off"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button> INSERT </button></td>
            </tr>
        </form>
    </table>
</body>
<script>
    // Define angular
    var app = angular.module("myApp", []);
    app.controller("myController", function ($scope, $http, $window, $location) {
        // set regDate to current date
        $scope.regDate = new Date().toISOString().slice(0, 10);
        $scope.uniqueId = Date.now().toString(36) + Math.random().toString(36).substr(2, 5);
        $scope.SerialNumber = $scope.uniqueId.toUpperCase();
        // function to load form data using dise code
        $scope.loadFormData = function () {
            $http.post("load_formData.php", { action: 'insert', 'dise_code': $scope.diseID })
                .then(function (response) {
                    if (response.data == '"Invalid Dise code"') {
                        alert(response.data);
                        $scope.diseID = "";
                    }
                    else {
                        response.data[0].lab = parseInt(response.data[0].lab)
                        $scope.formData = response.data[0];
                    }
                })
                .catch(function (error) {
                    console.error("Error" + error);
                })
        }
        // Function to insert data
        $scope.InsertData = function () {
            $http.post("load_formData.php", { action: 'InsertData', 'dise_code': $scope.diseID, 'district': $scope.formData.district, 'block': $scope.formData.block, 'village': $scope.formData.village, 'school': $scope.formData.school, 'comp_number': $scope.formData.comp_number, 'lab': $scope.formData.lab, 'serial_number': $scope.SerialNumber, 'TFT_serial': $scope.TFT_serial, 'WEB_serial': $scope.WEB_serial, 'Head_serial': $scope.Head_serial, 'Switch_serial': $scope.Switch_serial, 'regDate': $scope.regDate, 'Status': $scope.Status })
                .then(function (response) {
                    alert(response.data);
                    // $scope.diseID = $scope.formData.district = $scope.formData.block = $scope.formData.village = $scope.formData.school = $scope.formData.comp_number = $scope.formData.lab = 
                    $scope.SerialNumber = $scope.TFT_serial = $scope.WEB_serial = $scope.Head_serial = $scope.Switch_serial = $scope.regDate = "";
                    $window.location.href = 'http://localhost/MainDash56/RegForm/form.php';

                })
                .catch(function (error) {
                    console.error("Error" + error);
                })
        }
    })
</script>

</html>