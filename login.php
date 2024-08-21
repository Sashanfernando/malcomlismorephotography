<?php

$host = 'localhost';
$db = 'photography_website';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


$username = $conn->real_escape_string($_POST['username']);
$password = $_POST['password'];


$adminUsername = 'Admin';
$adminPassword = 'Admin123';


if ($username === $adminUsername && $password === $adminPassword) {
    
    echo json_encode([
        'success' => true,
        'redirectUrl' => 'admin-dashboard.html'
    ]);
    exit;
}


$sql = "SELECT password FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
   
        echo json_encode([
            'success' => true,
            'redirectUrl' => 'create-enquiry.html'
        ]);
    } else {
       
        echo json_encode([
            'success' => false,
            'message' => 'Incorrect username or password. Please try again.'
        ]);
    }
} else {
  
    echo json_encode([
        'success' => false,
        'message' => 'Incorrect username or password. Please try again.'
    ]);
}


$conn->close();
?>

