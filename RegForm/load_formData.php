<?php
// database connection 
include "../db.php";
// load form data
$data = json_decode(file_get_contents("php://input"), true);
$output = array();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset ($data["action"]) && $data["action"] === "insert") {
    $dise = mysqli_real_escape_string($connect, $data['dise_code']);
    // fetch data from database based on dise_code
    $query = "SELECT district, block, village, school, comp_number, lab FROM data WHERE dise_code = '$dise'";
    $result = mysqli_query($connect, $query);
    $rowCount = mysqli_num_rows($result);
    // If the result is empty then print "invalid dise_code" otherwise fetch data
    if ($rowCount > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        // Return data back to form
        echo json_encode($output);
    } else {
        echo json_encode("Invalid Dise Code");
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset ($data["action"]) && $data["action"] === "InsertData") {
    $timezone = new DateTimeZone('Asia/Kolkata');

    $dise = mysqli_real_escape_string($connect, $data['dise_code']);
    $district = mysqli_real_escape_string($connect, $data['district']);
    $block = mysqli_real_escape_string($connect, $data['block']);
    $village = mysqli_real_escape_string($connect, $data['village']);
    $school = mysqli_real_escape_string($connect, $data['school']);
    $comp_number = mysqli_real_escape_string($connect, $data['comp_number']);
    $lab = mysqli_real_escape_string($connect, $data['lab']);
    $serial_number = mysqli_real_escape_string($connect, $data['serial_number']);
    $TFT_serial = mysqli_real_escape_string($connect, $data['TFT_serial']);
    $WEB_serial = mysqli_real_escape_string($connect, $data['WEB_serial']);
    $Head_serial = mysqli_real_escape_string($connect, $data['Head_serial']);
    $Switch_serial = mysqli_real_escape_string($connect, $data['Switch_serial']);
    $regDate = mysqli_real_escape_string($connect, $data['regDate']);
    $Status = mysqli_real_escape_string($connect, $data['Status']);

    // Format the date to m/d/Y
    $formattedDate = date('m/d/Y', strtotime($regDate));
    $current_run = new DateTime('now', $timezone);
    $start_time = $current_run->format('H:i:s');
    $start_timestamp = strtotime($start_time);
    $start_time_in_seconds = date('H', $start_timestamp) * 3600 + date('i', $start_timestamp) * 60 + date('s', $start_timestamp);
    $end_time_in_seconds = $start_time_in_seconds + 300;
    $end_time = gmdate("H:i:s", $end_time_in_seconds);
    $timeDiff = $end_time_in_seconds - $start_time_in_seconds;
    $duration = gmdate("H:i:s", $timeDiff);


    // Insert query
    $insertData = "INSERT INTO data(`dise_code`, `district`, `block`, `village`, `school`, `serial_number`, `comp_number`, `TFT_serial`, `WEB_serial`, `Head_serial`, `Switch_serial`, `lab`, `regDate`, `Status`) VALUES ('$dise','$district','$block','$village','$school','$serial_number','$comp_number','$TFT_serial','$WEB_serial','$Head_serial','$Switch_serial','$lab','$formattedDate','$Status')";

    // Count labs to check that 1 lab only contain maximum 15 devices or desktops
    $countLabs = "SELECT count($lab) AS num_labs FROM DATA WHERE school = '$school' AND lab = '$lab'";
    $result = mysqli_query($connect, $countLabs);
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Check that one lab contains less then 15 devices
    if ($output[0]['num_labs'] < 15) {
        $compNumbers = "SELECT comp_number from data where comp_number = '$comp_number' AND dise_code = '$dise' AND lab = '$lab'";
        $result = mysqli_query($connect, $compNumbers);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {
            echo json_encode("Computer Number already exists");
        } else {
            // Below query is used to check duplicate data
            $query = "SELECT * FROM data WHERE serial_number = '$serial_number' OR TFT_serial = '$TFT_serial' OR WEB_serial = '$WEB_serial' OR Head_serial = '$Head_serial' OR Switch_serial = '$Switch_serial'";
            $result = mysqli_query($connect, $query);
            $rowCount = mysqli_num_rows($result);

            // If the rowcount is greater than 0 then data already exists in the database otherwise insert the data into database
            if ($rowCount > 0) {
                echo json_encode("The value you entered is already exists in the database.");
            } else {
                $result = mysqli_query($connect, $insertData);
                echo json_encode("Data Inserted Successfully");
                // Set the path where the json file is created
                $folderPath = 'C:\xampp\htdocs\MainDash56\Data/';
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true); // 0777 is the default mode, you can change it as needed
                }
                // Set the file path and file name
                $fileName1 = $folderPath . $serial_number . '_timingsData.json';
                $fileName2 = $folderPath . $serial_number . '_app_usage_data.json';

                file_put_contents($fileName1, '{
                "entries": [
                    {
                        "serial_number": "' . $serial_number . '",
                        "date": "' . $formattedDate . '",
                        "start_time": "' . $start_time . '",
                        "end_time": "' . $end_time . '",
                        "duration": "' . $duration . '"
                    }
                    ]
                }');
                file_put_contents($fileName2, '[
                    {
                        "pachage_name": "Unknown Package",
                        "date": "' . $formattedDate . '",
                        "start_time": "' . $start_time . '",
                        "end_time": "' . $end_time . '",
                        "duration": "' . $duration . '"
                    }
                    ]');
            }
        }
    } else {
        echo json_encode("Lab $lab of $school can only contain maximum 15 devices");
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset ($data["action"]) && $data["action"] === "update") {
    $serial_number = mysqli_real_escape_string($connect, $data['serial_number']);
    // fetch data from database based on dise_code
    $query = "SELECT district, block, village, school, comp_number, lab FROM data WHERE serial_number = '$serial_number'";
    $result = mysqli_query($connect, $query);
    $rowCount = mysqli_num_rows($result);
    // If the result is empty then print "Invalid Serial Number" otherwise fetch data
    if ($rowCount > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
        // Return data back to form
        echo json_encode($output);
    } else {
        echo json_encode("Invalid Serial Number");
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset ($data["action"]) && $data["action"] === "UpdateData") {
    date_default_timezone_set('Asia/Kolkata');

    $school = mysqli_real_escape_string($connect, $data['school']);
    $serial_number = mysqli_real_escape_string($connect, $data['serial_number']);
    $comp_number = mysqli_real_escape_string($connect, $data['comp_number']);
    $lab = mysqli_real_escape_string($connect, $data['lab']);
    $TFT_serial = mysqli_real_escape_string($connect, $data['TFT_serial']);
    $WEB_serial = mysqli_real_escape_string($connect, $data['WEB_serial']);
    $Head_serial = mysqli_real_escape_string($connect, $data['Head_serial']);
    $Switch_serial = mysqli_real_escape_string($connect, $data['Switch_serial']);

    // Update query
    $updateData = "UPDATE `DATA` SET comp_number = '$comp_number', lab = '$lab', TFT_serial = '$TFT_serial', WEB_serial = '$WEB_serial', Head_serial = '$Head_serial', Switch_serial = '$Switch_serial' WHERE serial_number = '$serial_number'";

    // Count labs to check that 1 lab only contain maximum 15 devices or desktops
    $countLabs = "SELECT count($lab)  AS num_labs FROM DATA WHERE school = '$school' AND lab = '$lab'";
    $result = mysqli_query($connect, $countLabs);
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }

    // Check that one lab contains less then 15 devices
    if ($output[0]['num_labs'] < 15) {
        // Below query is used to check duplicate data
        $query = "SELECT * FROM data WHERE TFT_serial = '$TFT_serial' OR WEB_serial = '$WEB_serial' OR Head_serial = '$Head_serial' OR Switch_serial = '$Switch_serial'";
        $result = mysqli_query($connect, $query);
        $rowCount = mysqli_num_rows($result);

        // If the rowcount is greater than 0 then data already exists in the database otherwise insert the data into database
        if ($rowCount > 0) {
            echo json_encode("The value you entered is already exists in the database.");
        } else {
            $result = mysqli_query($connect, $updateData);
            echo json_encode("Data Updated Successfully");
        }
    } else {
        echo json_encode("Lab $lab of $school can only contain maximum 15 devices");
    }
} else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset ($data["action"]) && $data["action"] === "DeleteData") {

    $serial_number = mysqli_real_escape_string($connect, $data['serial_number']);

    // Delete query
    $deleteData = "DELETE FROM `DATA` WHERE serial_number = '$serial_number'";

    $result = mysqli_query($connect, $deleteData);
    if ($result) {
        // File path for JSON file
        $filePath = "C:/xampp/htdocs/MainDash56/Data/{$serial_number}_timingsData.json";
        
        // Check if the file exists before attempting to delete
        if (file_exists($filePath)) {
            // Delete the file
            unlink($filePath);
        }
        $filePath = "C:/xampp/htdocs/MainDash56/Data/{$serial_number}_app_usage_data.json";
        echo json_encode("Data Deleted Successfully");
    } else {
        echo json_encode("Error Deleting Data");
    }
}
?>