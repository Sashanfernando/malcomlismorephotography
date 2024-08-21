<?php
// Database connection details
$host = 'localhost';
$db = 'photography_website';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}


if (isset($_POST['user_id'])) {
    $user_id = $conn->real_escape_string($_POST['user_id']);

    
    $sql = "SELECT profile_picture FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profile_picture_path = '../uploads/' . $row['profile_picture'];

        
        $delete_sql = "DELETE FROM users WHERE id = '$user_id'";
        if ($conn->query($delete_sql) === TRUE) {
            
            if (file_exists($profile_picture_path)) {
                unlink($profile_picture_path);
            }

            
            header('Location: manage-accounts.php?message=Account deleted successfully');
        } else {
            echo 'Error deleting record: ' . $conn->error;
        }
    } else {
        echo 'User not found';
    }
} else {
    echo 'User ID not provided';
}

$conn->close();
?>
