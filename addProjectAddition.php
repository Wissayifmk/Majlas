<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['type'])){
    $designerID = $_SESSION['id']; 
    $Type = $_SESSION['type'];
    
    
}
           $connection = mysqli_connect("localhost", "root", "root", "majlas");
        if (mysqli_connect_errno()) {
        // Check connection
        die("Connection Error" . mysqli_connect_error());
        }
  
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $projectName = $_POST['project-name'];
    $projectImage = $_POST['project-image'];
    $designCategory = $_POST['design-category'];
    $projectDescription = $_POST['project-description'];
        

        
$sql = "INSERT INTO designportoflioproject (designerID, projectName, projectImgFileName, description, designCategoryID) VALUES ('$designerID', '$projectName', '$projectImage', '$projectDescription', '$designCategory')";
$result = mysqli_query($connection, $sql);

if ($result) {
    header('Location: DesignerHomePage.php?id='.$designerID);
    exit();
} else {
    echo 'Error: ' . mysqli_error($connection);
}
 }
