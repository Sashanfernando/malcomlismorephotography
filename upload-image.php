<?php

$targetDir = __DIR__ . "uploads/";

if (!is_dir($targetDir)) {
    if (!mkdir($targetDir, 0755, true)) {
        die("Failed to create directory: " . $targetDir);
    }
}

$category = $_POST['category'];
$fileName = basename($_FILES["file-upload"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

$message = ""; // Initialize an empty message variable

if (isset($_POST["submit"]) && !empty($_FILES["file-upload"]["name"])) {
    $allowTypes = array('jpg','png','jpeg','gif');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES["file-upload"]["tmp_name"], $targetFilePath)) {
            $conn = new mysqli("localhost", "root", "", "photography_website");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $insert = $conn->query("INSERT into gallery_images (filename, category) VALUES ('".$fileName."', '".$category."')");
            if ($insert) {
                $message = "The file ".$fileName. " has been uploaded successfully.";
            } else {
                $message = "File upload failed, please try again.";
            } 
            $conn->close();
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    } else {
        $message = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
    }
} else {
    $message = "Please select a file to upload.";
}
?>

<script>
    var message = "<?php echo $message; ?>"; // Set JavaScript variable with PHP message
    if (message) {
        alert(message); // Display the message in an alert
        window.location.href = "html/admin-dashboard.html"; // Redirect back to the admin dashboard page
    }
</script>





