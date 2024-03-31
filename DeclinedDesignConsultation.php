<?php
$host = "localhost";
$user = "root";
$pass = "root";
$database = "majlas";
$connection = mysqli_connect($host, $user, $pass, $database);
$error = mysqli_error($connection);

if ($error != null) {
    $output = "<p>Cannot connect to the database</p>" . $error;
    exit($output);
} else {
    // Retrieve the request ID from the URL
    $requestID = $_GET['id'];

    // Update the status of the consultation request
    $query = "UPDATE designconsultationrequest SET statusID = (SELECT id FROM requeststatus WHERE status = 'consultation declined') WHERE id = $requestID";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $header = header("Location: DesignerHomePage.php");
        exit();
    }
}

mysqli_close($connection);