<?php
require 'checkSecurity.php';

$connection = mysqli_connect('localhost', 'root', 'root', 'majlas');
$error = mysqli_connect_error();
if ($error != null) {
    $output = '<p> Unable to connect to database</p>' . $error;
    exit($output);
} else {
    $projectID=$_POST['projectID'];
    $sql="SELECT * FROM designportoflioproject WHERE id=$projectID";
    $result= mysqli_query($connection, $sql);
    $row= mysqli_fetch_assoc($result);
    if($row!=null){
    // Retrieve form data
    if (isset($_POST['project-name'])){
        $projectName = $_POST['project-name'];
    }
    else
        $projectName=$row['projectName'];
    if (isset($_POST['project-image'])){
        $projectImage = $_POST['project-image'];
    }
    else
        $projectImage=$row['projectImgFileName'];
    if (isset($_POST['design-category'])){
        $designCategory = $_POST['design-category'];
    }
    else
        $designCategory=$row['designCategoryID'];
    if (isset($_POST['project-description'])){
        $projectDescription = $_POST['project-description'];
    }
    else
        $projectDescription=$row['description'];
    
    
    
    $query = "UPDATE designportoflioproject SET projectName = '$projectName', projectImgFileName='$projectImage', description='$projectDescription', designCategoryID=$designCategory WHERE id = $projectID";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $header = header("Location: DesignerHomePage.php?id=" . $_SESSION['id']);
        exit();
    }
    }
    else
        echo '<p>no result</p>';
}
