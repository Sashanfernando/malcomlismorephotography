<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$contact_no = isset($_POST['contact_no']) ? $_POST['contact_no'] : '';
$type_of_job = isset($_POST['type_of_job']) ? $_POST['type_of_job'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$time = isset($_POST['time']) ? $_POST['time'] : '';
$package = isset($_POST['package']) ? $_POST['package'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';


if (empty($id) || empty($name) || empty($contact_no) || empty($type_of_job) || empty($date)) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
    exit;
}


$sql = "INSERT INTO enquiries (id, name, contact_no, type_of_job, date, time, package, email, location)
        VALUES ('$id', '$name', '$contact_no', '$type_of_job', '$date', '$time', '$package', '$email', '$location')";


if ($conn->query($sql) === TRUE) {
    echo json_encode(['status' => 'success', 'message' => 'New record created successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}


$conn->close();
?>


