<?php
header('Content-Type: application/json');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}


$sql = "SELECT id, name, profile_picture, testimonial FROM testimonials";
$result = $conn->query($sql);


$testimonials = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        if ($row['profile_picture']) {
            $row['profile_picture'] = '../../uploaded_images/' . $row['profile_picture'];
        } else {
            $row['profile_picture'] = 'default_profile_picture.jpg';  
        }
        
        $testimonials[] = $row;
    }
} else {
    echo json_encode(["error" => "No testimonials found."]);
    exit;
}

echo json_encode($testimonials);
$conn->close();
?>


