<?php
    session_start();
       
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $projectName = $_POST['project-name'];
    $projectImage = $_POST['project-image']['name'];
    $designCategory = $_POST['design-category'];
    $projectDescription = $_POST['project-description'];
        }
        
     // Create a new mysqli connection
         $connection = mysqli_connect("localhost", "root", "root", "majlas");
    if (mysqli_connect_errno()) {
        // Check connection
        die("Connection Error" . mysqli_connect_error());
        }
            
        $sql = "INSERT INTO ddesignportoflioproject (project_name, project_image, design_category, project_description) VALUES (?, ?, ?, ?)";
        
        $stmt = mysqli_stmt_init($connection);
        
        if(mysqli_stmt_prepare($stmt, $sql)){
            die(mysqli_errno($connection));
        }
        mysqli_stmt_bind_param($stmt,"ssss",$projectName,$projectImage, $designCategory, $projectDescription);
        
       
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to designer's homepage
            header('Location: DesignerHomePage.html');
            exit();
        } else {
            // Handle database error
            echo "Error: " . $stmt->error;
        }
        
    ?>
    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
        <link rel="stylesheet" href="login.css">
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
            <button type="button" onclick="window.location.href = 'index.html'" class="log-out">
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
                        <option value="Web Design">Web Design</option>
                        <option value="Graphic Design">Graphic Design</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Industrial Design">Industrial Design</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="project-description">Project Description:</label>
                    <textarea id="project-description" name="project-description" rows="4" placeholder="Enter Project Description" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" id="sub" name="submit" >Add Project</button>
                </div>
            </fieldset>

            </form>




    </main>

<!--    <script>

       document.getElementById("project-form").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevents the form from submitting and page refreshing
  window.location.href="DesignerHomePage.html";
       });

    </script>-->
    

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