<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <title>Delete</title>
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
            width: 30%;
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
            background-color: #f2f2f2;
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
    </style>
</head>

<body ng-app="myApp" ng-controller="myController">
    <h1> DELETE DETAILS </h1></br>
    <table>
        <form ng-submit="DeleteData()" method="post">
            <tr>
                <th colspan="7">SERIAL NUMBER: <input type="text" name="SerialNumber" ng-model="SerialNumber" required
                        autocomplete="off"></th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td><button> DELETE </button></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </form>
    </table>
</body>
<script>
    var app = angular.module("myApp", []);
    app.controller("myController", function ($scope, $http, $window, $location) {
        $scope.DeleteData = function () {
            $http.post("load_formData.php", { action: 'DeleteData', 'serial_number': $scope.SerialNumber })
                .then(function (response) {
                    alert(response.data);
                    $scope.SerialNumber = "";
                    $window.location.href = 'http://localhost/MainDash56/RegForm/form.php';
                })
                .catch(function (error) {
                    console.error("Error" + error);
                })
        }
    })
</script>

</html>