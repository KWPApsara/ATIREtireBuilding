<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shift_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT tireCode FROM tires ORDER BY tireCode ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $tireCodes = [];
    while ($row = $result->fetch_assoc()) {
        $tireCodes[] = htmlspecialchars(trim($row['tireCode']));
    }
    echo json_encode([
        "status" => "success",
        "tireCodes" => $tireCodes
    ]);
} else {
    echo json_encode([
        "status" => "no_data",
        "message" => "No tire codes found."
    ]);
}

$conn->close();
?>

