<?php
// Include database connection
include "db.php";
$connect = mysqli_connect("localhost", "root", "", "main");
$data = json_decode(file_get_contents("php://input"), true);
$output = array();
// Check if the request is for loading districts
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "count_Schools") {
    $output1 = array();
    $output2 = array();
    // Query to load districts
    $query = "SELECT COUNT(DISTINCT school) AS num_schools, SUM(CASE WHEN Status = 'Active' THEN 1 ELSE 0 END) AS num_active_devices, count(serial_number) AS num_total_devices FROM data ";
    $query1 = "SELECT district,COUNT(serial_number) as total_devices_districts from data GROUP BY district";
    $query2 = "SELECT district,COUNT(serial_number) as active_devices_districts from data WHERE Status = 'Active' GROUP BY district";
    $result = mysqli_query($connect, $query);
    $result1 = mysqli_query($connect, $query1);
    $result2 = mysqli_query($connect, $query2);

    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }
    while ($row = mysqli_fetch_assoc($result1)) {
        $output1[] = $row;
    }
    while ($row = mysqli_fetch_assoc($result2)) {
        $output2[] = $row;
    }
    $response = array($output, $output1, $output2);

    // Return districts as JSON response
    echo json_encode($response);
}

// Check if the request is for loading Districts
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_Districts") {
    // Query to load districts
    $query = "SELECT district FROM districts ORDER BY district ASC";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Return districts as JSON response
    echo json_encode($output);
}

// Check if the request is for loading blocks
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_Blocks") {
    // Check if district is provided
    if (isset($data["dis"])) {
        $did = $data["dis"];

        // Query to load blocks based on district
        $query = "SELECT block FROM Blocks WHERE District = '$did' ORDER BY block ASC";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

        // Return blocks as JSON response
        echo json_encode($output);
    } else {
        // Return error if district is not provided
        echo json_encode(["error" => "District is not provided"]);
    }
}

// Check if the request is for loading villages
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_Villages") {
    // Check if district and block are provided
    if (isset($data["dis"]) && isset($data["bl"])) {
        $did = $data["dis"];
        $bid = $data["bl"];

        // Query to load Villages based on district nad block
        $query = "SELECT village FROM Villages WHERE District = '$did' AND Block = '$bid' ORDER BY village ASC";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

        // Return Villages as JSON response
        echo json_encode($output);
    } else {
        // Return error if block is not provided
        echo json_encode(["error" => "Block is not provided"]);
    }
}

// Check if the request is for loading Schools
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_Schools") {
    // Check if district, block and village are provided
    if (isset($data["dis"]) && isset($data["bl"]) && isset($data["vill"])) {
        $did = $data["dis"];
        $bid = $data["bl"];
        $vid = $data["vill"];

        // Query to load Schools based on district, block and village
        $query = "SELECT school FROM schools WHERE District = '$did' AND Block = '$bid' AND village = '$vid' ORDER BY school ASC";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

        // Return Schools as JSON response
        echo json_encode($output);
    } else {
        // Return error if Village is not provided
        echo json_encode(["error" => "Village is not provided"]);
    }
}

// Check if the request is for loading Serials
else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_Serials") {
    // Check if district, block, village and school are provided
    if (isset($data["dis"]) && isset($data["bl"]) && isset($data["vill"]) && isset($data["sch"])) {
        $did = $data["dis"];
        $bid = $data["bl"];
        $vid = $data["vill"];
        $sid = $data["sch"];

        // Query to load Serials based on district, block, village and school
        $query = "SELECT serial_number FROM data WHERE District = '$did' AND Block = '$bid' AND village = '$vid' AND school = '$sid' ORDER BY serial_number ASC";
        $result = mysqli_query($connect, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

        // Return Serials as JSON response
        echo json_encode($output);
    } else {
        // Return error if School is not provided
        echo json_encode(["error" => "School is not provided"]);
    }
} 

// Check if the request is for loading All Data
else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_SchoolData") {

    // Query to load All data
    $query = "SELECT dise_code, district, block, village, school FROM data GROUP BY school";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Return output as JSON response
    echo json_encode($output);
} 


else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_AllData") {

    // Query to load All data
    $query = "SELECT dise_code, district, block, village, school, serial_number, comp_number, TFT_serial, WEB_serial, Head_serial, Switch_serial, lab, regDate
    FROM data WHERE STR_TO_DATE(regDate, '%m/%d/%Y') = CURRENT_DATE()";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Return output as JSON response
    echo json_encode($output);
} 

// Check if the request is for loading today's registration information data
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_regInfoData") {
    
    // Define today's date
    $curDate = new DateTime();
    $date = $curDate->format('d');
    $month = $curDate->format('m');
    $year = $curDate->format('Y');

    // Set format to m/d/Y
    $curDate = $month . "/" . $date . "/" . $year;

    // Query to load today's registration information data
    $query = "SELECT dise_code, district, school, serial_number, lab, comp_number, TFT_serial, WEB_serial, Head_serial, Switch_serial, regDate FROM data where regDate = '$curDate'";
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Return output as JSON response
    echo json_encode($output);
}

// Check if the request is for loading today's registration information data
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_ActiveData") {
    
    if(isset($data['sta'])) {
        $sta = mysqli_real_escape_string($connect, $data['sta']);
    } else {
        $sta = null;
    }
    if(empty($sta) || $sta == "null"){
        $query = "SELECT dise_code, district, block, village, school, serial_number, Status FROM data";
    }
    else{
        $query = "SELECT dise_code, district, block, village, school, serial_number, Status FROM data where Status = '$sta'";
    }
    $result = mysqli_query($connect, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Return output as JSON response
    echo json_encode($output);
}

// Check if the request is for loading assets Data based on district
elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "load_assetsData") {
    
    // Check if district is provided
    if(isset($data['dis'])) {
        $did = $data["dis"];
    }

    $query = "SELECT * FROM data where district = '$did' ORDER BY dise_code";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Return output as JSON response
    echo json_encode($output);
}

// Return error if the request is invalid
else {
    echo json_encode(["error" => "Invalid request"]);
}
?>