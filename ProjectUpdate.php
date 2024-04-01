<?php
require 'checkSecurity.php';
$connection = mysqli_connect('localhost', 'root', 'root', 'majlas');
$error = mysqli_connect_error();
if ($error != null) {
    $output = '<p> Unable to connect to database</p>' . $error;
    exit($output);
} else 
    $projectID = $_GET['id'];

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
        <title>Update Project</title>
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
            <button type="button" onclick="window.location.href = 'index.html'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
            </button> 
        </header>
    <main>
   
<div class="breadcrumb">
           <?php    echo '<a href="DesignerHomePage.php?id='.$_SESSION['id'].'">Designer Homepage</a>'; ?>
            <span> / </span>
            <?php    echo '<a href="ProjectUpdate.php?id='.$projectID.'">Update Project</a>'; ?>
        </div>
        <div class="container">
            <?php 
                $sql="SELECT * FROM designportoflioproject WHERE id='$projectID'";
                $result= mysqli_query($connection, $sql);
                $row= mysqli_fetch_assoc($result);
                                           
            ?>
            <form id="project-form" method="post" action="addProjectUpdate.php" >
                <fieldset>
                    <legend>Update Project</legend>
                <div class="form-group">
                    <label for="project-name">Project Name: </label>
                    <input type="text" id="project-name" name="project-name" value="<?php echo $row['projectName']; ?>" required>
                </div>
                <div class="form-group">
                  
<label for="project-image">Project Image:</label>
                    <img src="image/<?php echo $row['projectImgFileName']; ?>" alt="project-image"/>
                    <input type="file" id="project-image" name="project-image" required>
                    
                </div>
                <div class="form-group">
                    <label for="design-category">Design Category:</label>
                    <select id="design-category" name="design-category" required>
<?php 
    $sql2 = "SELECT * FROM designerspeciality WHERE designerID='" . $_SESSION['id'] . "'";
    $result2 = mysqli_query($connection, $sql2);
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $sql3="SELECT * FROM designcategory WHERE id='".$row2['designCategoryID']."'";
        $result3 = mysqli_query($connection, $sql3);
        $row3 = mysqli_fetch_assoc($result3);
        echo '<option value="'.$row3['id'].'">'.$row3['category'].'</option>';
    }
?>                    
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="project-description">Project Description:</label>
                    <textarea id="project-description" name="project-description" cols="50" rows="4" required><?php echo $row['description']; ?></textarea>
                    <?php echo '<input type = "hidden" name = "projectID" value = "'. $projectID . '">';?>
                </div>
                <div class="form-group">
                    <button type="submit" id="sub">Update Project</button>
                </div>
            </fieldset>

            </form>
        </div>




    </main>

    

    <footer>
    <div class="footcontainer">
        <div class="col1"> <!--for the right most column*/-->
            <h3>Majlas's Story</h3>
            <p>Majlas embarked on a journey of innovation, shaping the digital realm with their visionary ideas.</p>
        </div>

        <var></var>
        
        <div class="col2">
            <h3>Contact us</h3>
            <ul>
                <li><a href="tel:+0543080394"><img src="image/phone.png" alt="Phone call"> <span class="phone-number">0543080394</span></a></li>
                <li><a href="mailto:Majlas@info.com"><img src="image/email.png" alt="Email Message"> <span class="email-address">Majlas@info.com</span></a></li>
            </ul>
            <span>&copy; All rights reserved 2023-2024</span>
        </div>

        <div class="col3"> <!--for the left most column*/-->
            <h3>Address</h3>
            <p>Saudi Arabia, Riyadh, King Saud University, Information Technology department IT329</p>
            <p>Privacy - Term</p>

        </div>
    </div>
    
</footer>
    
    
</body>
</html>