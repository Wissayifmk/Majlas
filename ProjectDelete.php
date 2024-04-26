<?php
$host = "localhost";
$user = "root";
$pass = "root";
$database = "majlas";
$connection = mysqli_connect($host, $user, $pass, $database);
$error = mysqli_error($connection);

if ($error != null) {
    $output = "<p>can not connect to database</p>" . $error;
    exit($output);
} else {
    if (isset($_GET['id'])) {
        $projectID = $_GET['id'];
        $deleteQuery = "DELETE FROM DesignPortoflioProject WHERE id = $projectID";
        $deleteResult = mysqli_query($connection, $deleteQuery);
        if ($deleteResult) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false]);
        }
    }
}

mysqli_close($connection);