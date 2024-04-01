<?php
require 'checkSecurity.php';

$connection = mysqli_connect('localhost', 'root', 'root', 'majlas');
$error = mysqli_connect_error();
if ($error != null) {
    $output = '<p> Unable to connect to database</p>' . $error;
    exit($output);
} else {
    // Retrieve form data
    $projectName = $_POST['project-name'];
    $projectImage = $_POST['project-image'];
    $designCategory = $_POST['design-category'];
    $projectDescription = $_POST['project-description'];
    $projectID=$_POST['projectID'];
    
    
    $query = "UPDATE designportoflioproject SET projectName = '$projectName', projectImgFileName='$projectImage', description='$projectDescription', designCategoryID=$designCategory WHERE id = $projectID";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $header = header("Location: DesignerHomePage.php?id=" . $_SESSION['id']);
        exit();
    }
}
