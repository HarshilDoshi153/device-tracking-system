<?php
// Database connection
$connect = mysqli_connect("localhost", "root", "", "main");

// Check connection
if (!$connect) {
    die ("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the "data" table
$query = "SELECT dise_code, district, block, village, school, serial_number, comp_number, TFT_serial, WEB_serial, Head_serial, Switch_serial, lab, regDate FROM data ORDER BY dise_code ASC";
$result = mysqli_query($connect, $query);

// Check if any data is returned
if ($result->num_rows > 0) {
    // Define CSV file name
    $csvFileName = 'Data.csv';

    // Set CSV header
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $csvFileName . '"');

    // Open file handle for writing
    $file = fopen('php://output', 'w');

    // Write CSV column headers
    $columnHeaders = array("Dise code", "District", "Block", "Village", "School", "Serial Number", "Comp Number", "TFT Serial", "WEB Serial", "HEADPHONE Serial", "SWITCH Serial", "Lab", "Registration Date");
    fputcsv($file, $columnHeaders);

    // Fetch and write each row of data to the CSV file
    while ($row = mysqli_fetch_assoc($result)) {
        // $row['regDate'] = date('m/d/Y', strtotime($row['regDate']));
        fputcsv($file, $row);
    }

    // Close file handle
    fclose($file);
} else {
    echo "No data found";
}

// Close database connection
mysqli_close($connect);
?>