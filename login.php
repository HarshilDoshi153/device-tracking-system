<?php
ini_set('session.gc_maxlifetime', 5);
session_start();
if(!isset($_SESSION['MainDash56'])) {
    $_SESSION['MainDash56'] = 'admin';
    header("Location: index.php"); // replace with the URL of your dashboard page
    exit;
}
$connect = mysqli_connect("localhost", "root", "", "main");
$data = json_decode(file_get_contents("php://input"), true);
$username = mysqli_real_escape_string($connect, $data['username']);
$password = mysqli_real_escape_string($connect, $data['password']);
$stmt = $connect->prepare("SELECT * FROM Admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
// Comparison Logic
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Handle Matches and Mismatches
    if ($password == $row['Password']) {
        // Passwords match, do something (e.g., allow access)
        $output = "Authentication successful!";
    } else {
        // Passwords do not match, inform the user
        $output = "Invalid password. Please try again.";
    }
} else {
    // User not found in the database, inform the user
    $output = "User not found. Please check the username.";
}
echo json_encode($output);
?>