<?php
header('Content-Type: application/json');

// Initialize response array
$response = [
    'success' => false,
    'message' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $host = 'localhost';
    $db = 'photography_website';
    $user = 'root';
    $pass = '';

    // Create database connection
    $conn = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($conn->connect_error) {
        $response['message'] = 'Connection failed: ' . $conn->connect_error;
        echo json_encode($response);
        exit();
    }

    // Sanitize and collect form data
    $id = $conn->real_escape_string($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Handle profile picture upload
    $profile_picture_path = '';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = $_FILES['profile_picture'];
        $profile_picture_name = $profile_picture['name'];
        $profile_picture_tmp_name = $profile_picture['tmp_name'];
        $profile_picture_size = $profile_picture['size'];

        $profile_picture_ext = strtolower(pathinfo($profile_picture_name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($profile_picture_ext, $allowed)) {
            if ($profile_picture_size < 10000000) { // Limit to 1MB
                $profile_picture_new_name = uniqid('', true) . "." . $profile_picture_ext;
                $profile_picture_destination = 'uploads/' . $profile_picture_new_name;

                if (move_uploaded_file($profile_picture_tmp_name, $profile_picture_destination)) {
                    $profile_picture_path = $profile_picture_destination;
                } else {
                    $response['message'] = 'Error uploading your profile picture.';
                    echo json_encode($response);
                    exit();
                }
            } else {
                $response['message'] = 'Your profile picture is too large.';
                echo json_encode($response);
                exit();
            }
        } else {
            $response['message'] = 'Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.';
            echo json_encode($response);
            exit();
        }
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (id, name, address, gender, birthday, contact, email, profile_picture, username, password)
            VALUES ('$id', '$name', '$address', '$gender', '$birthday', '$contact', '$email', '$profile_picture_path', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = 'Signup successful!';
    } else {
        $response['message'] = 'Signup failed: ' . $conn->error;
    }

    // Close the database connection
    $conn->close();

    // Return JSON response
    echo json_encode($response);
    exit();
}
?>
