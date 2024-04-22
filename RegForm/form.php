<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <title>Document</title>
    <link rel="icon" type="image/png" href="../cvrlogo.png" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            padding-left: 40%;
            text-align: center;
            background-color: #f9f9f9;
        }

        .input-container {
            width:30%;
            height:30%;
            background-color: #e7e4fe;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 35%;
            border: 1px solid #e7e4fe;
            border-radius: 18px;
            padding: 20px;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #5f4279;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #78638b;
        }
    </style>
</head>
<body>
    <div class="input-container">
        <form action="insertForm.php" method="post">
            <button> ADD </button>
        </form>
        <br>
        <form action="updateForm.php" method="post">
            <button> UPDATE </button>
        </form>
        <br>
        <form action="deleteForm.php" method="post">
            <button> REMOVE </button>
        </form>
    </div>
</body>

</html>