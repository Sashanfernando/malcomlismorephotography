<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $stmt = $conn->prepare("DELETE FROM testimonials WHERE id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo "Testimonial deleted successfully!";
    } else {
        echo "Error deleting testimonial: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();


header("Location: manage-testimonials.php");
exit();
?>
