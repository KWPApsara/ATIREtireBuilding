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

if (isset($_GET['tireCode'])) {
    $tireCode = $_GET['tireCode'];

    $sql = "SELECT brand, tireWeight, pressNumber FROM tires WHERE tireCode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tireCode);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No details found for the provided tire code."]);
    }

    $stmt->close();
}

$conn->close();
?>


