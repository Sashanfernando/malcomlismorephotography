<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['id'])) {
    $id = $_POST['id'];

   
    $sql = "DELETE FROM enquiries WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Enquiry deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}


$conn->close();


header("Location: manage-enquiries.php");
exit;
?>
