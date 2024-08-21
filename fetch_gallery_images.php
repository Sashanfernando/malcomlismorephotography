<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['category'])) {
    $category = $_POST['category'];
    
 
    $stmt = $conn->prepare("SELECT filename  FROM gallery_images WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $images = array();
    
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }

    echo json_encode($images);
    
    $stmt->close();
}

$conn->close();
?>