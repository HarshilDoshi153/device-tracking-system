<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

try {
    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "main");
    $data = json_decode(file_get_contents("php://input"), true);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Email settings
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'harshildoshi153@gmail.com';
    $mail->Password = 'buccrojtoqhjscjj';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('210120107519@git.org.in');
    if(!isset($data['email']) || $data['email'] == ''){
        // echo "Invalid Email Address";
    } else{
        $mail->addAddress($data['email']);
    }
    $mail->isHTML(true);

    // Fetch data from the database
    $today = date('m/d/Y');
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "todayData") {
        $sql = "SELECT dise_code, district, block, village, school, serial_number, comp_number, TFT_serial, WEB_serial, Head_serial, Switch_serial, lab, regDate FROM data WHERE regDate = '$today' ORDER BY dise_code";
        $mail->Subject = "Daily Device Report";
        $mail->Body = "Please find the attached CSV file";
    } else if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($data["action"]) && $data["action"] === "allData") {
        $sql = "SELECT dise_code, district, block, village, school, serial_number, comp_number, TFT_serial, WEB_serial, Head_serial, Switch_serial, lab, regDate FROM data ORDER BY dise_code";
        $mail->Subject = "Device Report";
        $mail->Body = "Please find the attached CSV file";
    } else {
        $sql = "SELECT dise_code, district, block, village, school, serial_number, comp_number, TFT_serial, WEB_serial, Head_serial, Switch_serial, lab, regDate FROM data ORDER BY dise_code";
        $mail->Subject = "Device Report";
        $mail->Body = "Please find the attached CSV file";
    }
    $result = $conn->query($sql);

    // Check if query was successful
    if (!$result) {
        die("Error executing SQL query: " . $conn->error);
    }

    // Create a temporary CSV file
    $csvFile = tempnam(sys_get_temp_dir(), 'data_' . $today);
    $csvHandle = fopen($csvFile, 'w');

    // Check if CSV file was created successfully
    if (!$csvHandle) {
        die("Failed to create CSV file");
    }

    // Write CSV headers
    $headers = ['Dise Code', 'District', 'Block', 'Village', 'School', 'Device Serial Number', 'Computer Number', 'TFT Serial', 'WEBCAM Serial', 'HEADPHONE Serial', 'SWITCH Serial', 'Lab', 'Reg. Date'];
    if (fputcsv($csvHandle, $headers) === false) {
        die("Failed to write CSV headers");
    }

    // Write data to CSV
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rowData = [
                $row['dise_code'],
                $row['district'],
                $row['block'],
                $row['village'],
                $row['school'],
                $row['serial_number'],
                $row['comp_number'],
                $row['TFT_serial'],
                $row['WEB_serial'],
                $row['Head_serial'],
                $row['Switch_serial'],
                $row['lab'],
                $row['regDate']
            ];
            if (fputcsv($csvHandle, $rowData) === false) {
                die("Failed to write CSV data");
            }
        }
    }

    // Close CSV file handle
    fclose($csvHandle);
    // Attach the CSV file
    $mail->addAttachment($csvFile, 'data.csv');
    $mail->send();
    echo "Mail Send Successfully";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>