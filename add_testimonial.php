<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "photography_website";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $testimonial = $_POST['testimonial'];
    $profilePicturePath = null;

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            $uploadFileDir = __DIR__ . 'uploaded_images/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0777, true);  
            }

            $newFileName = uniqid() . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profilePicturePath = $newFileName;  
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Error moving the file to the upload directory.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
        }
    }

    if ($profilePicturePath) {
        $stmt = $conn->prepare("INSERT INTO testimonials (id, name, profile_picture, testimonial) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id, $name, $profilePicturePath, $testimonial);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Testimonial submitted successfully!';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        if (empty($response)) {
            $response['status'] = 'error';
            $response['message'] = 'Profile picture upload failed.';
        }
    }

    $conn->close();
}

echo json_encode($response);

?>

