<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT id, name, contact_no, type_of_job, package, email, date, time, location FROM enquiries";
$result = $conn->query($sql);

$enquiries = array();
if ($result->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {
        $enquiries[] = $row;
    }
} else {
    echo "No records found.";
}


var_dump($enquiries);


header('Content-Type: application/json');
echo json_encode($enquiries);


$conn->close();
?>
