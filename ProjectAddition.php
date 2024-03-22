    <?php 
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['type'])){
    $designerID = $_SESSION['id']; 
    $Type = $_SESSION['type'];
}
     
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $projectName = $_POST['project-name'];
    $projectImage = $_POST['project-image']['name'];
    $designCategory = $_POST['design-category'];
    $projectDescription = $_POST['project-description'];
        

    // Create a new mysqli connection
        $connection = mysqli_connect("localhost", "root", "root", "majlas");
        if (mysqli_connect_errno()) {
        // Check connection
        die("Connection Error" . mysqli_connect_error());
        }
        $sql = "INSERT INTO designportoflioproject (designerID, projectName, projectImgFileName, description, designCategoryID) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "isss", $designerID, $projectName, $projectImage, $projectDescription);
        
        if (mysqli_stmt_execute($stmt)) {
            header('Location: DesignerHomePage.php?id=' . $designerID);
            exit();
        } else {
            echo "Error: " . mysqli_error($connection);
        }
 }
       ?>
    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="addPage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Add Project</title>
            <style>
            label{

                display: block;
                margin-top: 1em;
            }
        </style>
    </head>

    <body>
        <header>
            <img src="image/tapImage.PNG" alt="Majlas's Logo" width="200">
            <button type="button"  onclick="window.location.href = 'SignOut.php'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
            </button> 
        </header>
    <main>
    
        <div class="breadcrumb" >
            <a href="DesignerHomePage.html">Designer Homepage</a>
            <span> / </span>
            <a href="ProjectAddition.html">Add Project</a>  
        </div>
       
        <div class="container">
            
            <form id="project-form" action="" method="post" >
                <fieldset>
                    <legend>Add Project</legend>
                <div class="form-group">
                    <label for="project-name">Project Name:</label>
                    <input type="text" id="project-name" name="project-name" placeholder="Enter Project Name" required>
                </div>
                <div class="form-group">
                    <label for="project-image">Project Image:</label>
                    <input type="file" id="project-image" name="project-image" required>
                </div>
                <div class="form-group">
                    <label for="design-category">Design Category:</label>
                    <select id="design-category" name="design-category" required>
                        <?php 
                            $sql2="SELECT * FROM designcategory";
                            $result2= mysqli_query($connection, $sql2);
                            while ($row2= mysqli_fetch_assoc($result2)){
                                echo '<option value="'.$row2['id'].'">'.$row2['category'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="project-description">Project Description:</label>
                    <textarea id="project-description" name="project-description" rows="4" placeholder="Enter Project Description" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" id="sub" name="submit" >Add Project</button>
                </div>'o]][-pppppp[[[[[[[[[[[[[[[[[\
            </fieldset>
[-=------------------\]v 