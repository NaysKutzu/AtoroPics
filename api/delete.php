<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if (isset($_GET['owner_key']) && isset($_GET['imgid'])) {
    // Include database connection

    $owner_key = mysqli_real_escape_string($conn, $_GET['owner_key']);
    $imgid = mysqli_real_escape_string($conn, $_GET['imgid']);

    // Check if the owner_key exists in the database
    $query = "SELECT * FROM users WHERE api_key='$owner_key'";
    $results = mysqli_query($conn, $query);
    if (mysqli_num_rows($results) == 1) {
        $query2 = "SELECT name FROM imgs WHERE owner_key='$owner_key' AND name='$imgid' ";
        $results2 = mysqli_query($conn, $query2);
        if (mysqli_num_rows($results2) == 1) {
                        // Get the file extension
            $ext = pathinfo($_GET['imgid'], PATHINFO_EXTENSION);

            // Define the allowed file types
            $allowed = array("");

            // Check if the file type is allowed
            if (in_array($ext, $allowed)) {
                $name = $_GET['imgid'];
                $delete_folder = '../public/storage/uploads/';
                unlink("../public/storage/json/".$name.'.json');
                unlink("../public/storage/uploads/".$name.'.png');
                $apikey = $_GET['owner_key'];
                $conn->query("DELETE FROM imgs WHERE name = '$name' AND owner_key = '$apikey'");
                echo json_encode(array('status' => 'success', 'message' => 'Image deleted successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Invalid image id'));
            }
        }else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid image id'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid API key'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
}
?>
