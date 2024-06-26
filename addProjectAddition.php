<?php

require 'checkSecurity.php';
?>
<?php

$connection = mysqli_connect("localhost", "root", "root", "majlas");
if (mysqli_connect_errno()) {
    // Check connection
    die("Connection Error" . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $projectName = $_POST['project-name'];
    if (!empty($_FILES['project-image'])) {
            $brandLogoName = $_FILES['project-image']['name'];
            $brandLogoTmp = $_FILES['project-image']['tmp_name'];

            if (!empty($brandLogoName)) {
                // Specify the directory to store the uploaded brand logos
                $brandLogoPath = "/Applications/MAMP/htdocs/Majlas/image/" . $brandLogoName;

                // Move the uploaded file to the specified directory
                move_uploaded_file($brandLogoTmp, $brandLogoPath);
        }
        }
    $designCategory = $_POST['design-category'];
    $projectDescription = $_POST['project-description'];

    $sql = "INSERT INTO designportoflioproject (designerID, projectName, projectImgFileName, description, designCategoryID) VALUES (?, ?, ?, ?, ?)";
    if ($statementt = mysqli_prepare($connection, $sql)) {
        mysqli_stmt_bind_param($statementt, "isssi", $DesignerID, $projectName, $projectImage, $projectDescription, $designCategory);
    }
    $result = mysqli_stmt_execute($statementt);

    if ($result) {
        header('Location: DesignerHomePage.php?id=' . $DesignerID);
    } else {
        echo 'Error: ' . mysqli_error($connection);
    }
}
?>
