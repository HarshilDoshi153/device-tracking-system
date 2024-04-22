<!DOCTYPE html>
<html lang="en">
<!-- Device Serial Number = comp_number(Database)
    Desktop Serial = serial_number(Database) -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <title>Update</title>
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

<h1> UPDATE DETAILS </h1></br>

<body ng-app="myApp" ng-controller="myController">
    <!-- Dise code to select data -->
    <table border-collapse="collapse">
        <form ng-submit="loadFormData()">
            <tr>
                <th>SERIAL NUMBER: <input type="text" name="SerialNumber" ng-model="SerialNumber" required
                        autocomplete="off"></th>
                <th><button style="margin-top:28px;"> GET DETAILS </button></th>
            </tr>
        </form>
    </table>
    </br>
    <!-- Load data into field -->
    <table>
        <form ng-submit="UpdateData()">
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
                <td>DEVICE SERIAL NUMBER:</td>
                <td><input type="text" name="comp_number" ng-model="formData.comp_number" required
                        autocomplete="off"></br></td>
                <td></td>
                <td></td>
                <td>LAB:</td>
                <td><input type="number" min="1" max="2" name="lab" ng-model="formData.lab" required autocomplete="off"
                        placeholder="1 or 2"></br></td>
            </tr>
            <tr>
                <td>TFT SERIAL:</td>
                <td><input type="text" name="TFT_serial" ng-model="TFT_serial" required autocomplete="off"></br></td>
                <td></td>
                <td></td>
                <td>WEBCAM SERIAL:</td>
                <td><input type="text" name="WEB_serial" ng-model="WEB_serial" required autocomplete="off"></br></td>
            </tr>
            <tr>
                <td>HEADPHONE SERIAL:</td>
                <td><input type="text" name="Head_serial" ng-model="Head_serial" required autocomplete="off"></br></td>
                <td></td>
                <td></td>
                <td>SWITCH SERIAL:</td>
                <td><input type="text" name="Switch_serial" ng-model="Switch_serial" required autocomplete="off"></td>
            </tr>
            <tr>
                <td colspan="6"><input type="hidden" name="Status" ng-model="Status" ng-init="Status= 'Inactive'"
                        ng-value="Status" required disabled autocomplete="off"></td>
            <tr>
            <tr>
                <td></td>
                <td></td>
                <td><button> UPDATE </button></td>
            </tr>
        </form>
    </table>
</body>
<script>
    // Define angular
    var app = angular.module("myApp", []);
    app.controller("myController", function ($scope, $http, $location, $window) {
        // function to load form data using serial_number
        $scope.loadFormData = function () {
            $http.post("load_formData.php", { action: 'update', 'serial_number': $scope.SerialNumber })
                .then(function (response) {
                    if (response.data == '"Invalid Serial Number"') {
                        alert(response.data);
                        $scope.serial_number = "";
                    }
                    else {
                        response.data[0].lab = parseInt(response.data[0].lab)
                        $scope.formData = response.data[0];
                        // console.log($scope.formData.lab);
                        // console.log(typeof $scope.formData.lab);
                    }
                })
                .catch(function (error) {
                    console.error("Error" + error);
                })
        }
        // Function to insert data
        $scope.UpdateData = function () {
            $http.post("load_formData.php", { action: 'UpdateData', 'school': $scope.formData.school, 'comp_number': $scope.formData.comp_number, 'lab': $scope.formData.lab, 'serial_number': $scope.SerialNumber, 'TFT_serial': $scope.TFT_serial, 'WEB_serial': $scope.WEB_serial, 'Head_serial': $scope.Head_serial, 'Switch_serial': $scope.Switch_serial })
                .then(function (response) {
                    alert(response.data);
                    // $scope.diseID = $scope.formData.district = $scope.formData.block = $scope.formData.village = $scope.formData.school = $scope.formData.comp_number = $scope.formData.lab = 
                    $scope.TFT_serial = $scope.WEB_serial = $scope.Head_serial = $scope.Switch_serial = "";
                    $window.location.href = 'http://localhost/MainDash56/RegForm/form.php';
                })
                .catch(function (error) {
                    console.error("Error" + error);
                })
        }
    })
</script>

</html>