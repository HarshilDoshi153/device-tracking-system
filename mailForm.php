<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link rel="icon" type="image/png" href="./cvrlogo.png" />
    <title>Send Mail</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e7e4fe;
            margin-left: 40%;
            margin-right: 40%;
            padding: 10px;
        }

        input[type="email"],
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

<body ng-app='myApp' ng-controller='myController'>
    <div style="background-color: #f9f9f9; padding:18px; margin-top: 100%;">
        <div class="col-md-10">
            <div class="form-group">
                <h3>Email</h3>
                <input type="email" ng-model="email" name="email" placeholder="abc@xyz.com" required>
            </div>
        </div>
        <div style="display: flex;">
            <div class="col-md-4">
                <div class="form-group">
                    <button name="send" value="Send" ng-click="allData()">All Data</button>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div class="form-group">
                    <button name="send" value="Send" ng-click="todayData()">Daily Data</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var app = angular.module("myApp", []);
    app.controller("myController", function ($scope, $http) {
        $scope.todayData = function () {
            $http.post("sendMail.php", { action: 'todayData', 'email': $scope.email })
                .then(function (response) {
                    alert(response.data);
                })
                .catch(function (error) {
                    console.error(" " + error);
                })
        }
        $scope.allData = function () {
            $http.post("sendMail.php", { action: 'allData', 'email': $scope.email })
                .then(function (response) {
                    alert(response.data);
                })
                .catch(function (error) {
                    console.error(" " + error);
                })
        }
    })
</script>
</html>