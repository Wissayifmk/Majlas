<!DOCTYPE html>
<html>
    <head>
        <title>Designer Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="DesignerHome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <?php 
        $host="localhost";
        $user="root";
        $pass="root";
        $database="majlas";
        $connection= mysqli_connect($host,$user,$pass,$database);
        $error= mysqli_error($connection);
        if($error!=null)
         {
         $output="<p>can not connect to databsase</p>".$error;
         exit($output);
         } else {
           session_start();
           $designerID = $_SESSION['id'];
           $query1 = "SELECT * FROM Designer WHERE id = $designerID";
           $result1 = mysqli_query($connection, $query1);
           
         }
    ?>
    
    <body>  
        <header>
        <img src="image2/tapImage.PNG" alt="Majlas's Logo" width="200">
            <button type="button" onclick="window.location.href = 'index.html'" class="log-out">
                <img src="image2/Log-Out.png" alt="log-out">
            </button>    
        </header>
        <main>
            <section class="part0">
                <div class="headerContent">
                <?php 
                  if ($result1 && mysqli_num_rows($result1) > 0) {
                      $designer = mysqli_fetch_assoc($result1);
                      $firstName = $designer['firstName'];
                      $lastName = $designer['lastName'];
                      $emailAddress = $designer['emailAddress'];
                      $brandName = $designer['brandName'];
                      $logoImgFileName = $designer['logoImgFileName'];
                    }
                   echo '<div class="designer-info">';
                   echo '<h1>Welcome'.$firstName.'</h1>';
                   echo '<p>';
                   echo '<h3>Designer information:</h3>'; 
                   echo '<span>First name:</span> ' . $firstName . '<br>';
                   echo '<span>Last name:</span> ' . $lastName . '<br>';
                   echo '<span>Email address:</span> <a href="mailto:' . $emailAddress . '">' 
                           . $emailAddress . '</a><br>';
                   echo '<span>Brand Name:</span> ' . $brandName . '<br>';
                   
                   $sql="SELECT * FROM DesignCategory WHERE id = $designerID";
                   echo '<span>Category:</span> ' . $category . '<br>';
                   echo '</p>';
                   echo '</div>';
                ?>
                </div>
                <span class="imgHover">
                    <?php  echo '<img src="image/' . $logoImgFileName . '" alt="designer logo" id="image0">'; ?> <!<!--check it -->
                </span>
            </section>   
            <div class="desHeader">
                <h3 class="header1">Design Portfolio</h3>
                <div class="add">
                    <?php echo '<a id="Add" href="ProjectAddition.php">Add New Project</a>';?>
                    
                </div>
            </div>

            <?php 
            $query2 = "SELECT * FROM DesignPortoflioProject WHERE designerID = $designerID";
            $result2 = mysqli_query($connection, $query2);

                echo '<table id="table1">';
                echo '<tr>';
                echo '<th>Project Name</th>';
                echo '<th>Image</th>';
                echo '<th>Design Category</th>';
                echo '<th>Description</th>';
                echo '<th>Edit</th>';
                echo '<th>Delete</th>';
                echo '</tr>';
            if ($result2 && mysqli_num_rows($result2) > 0) {
  
               while ($row = mysqli_fetch_assoc($result2)) {
                    $projectID = $row['id'];
                    $projectName = $row['projectName'];
                    $imageFileName = $row['projectImgFileName'];
                    $description = $row['description'];
                    $designCategory = $row['designCategoryID'];

                   echo '<tr>';
                   echo '<td>' . $projectName . '</td>';
                   echo '<td><img src="image/' . $imageFileName 
                           . '" alt="project image" id="image' . $projectID . '"></td>';
                   echo '<td>' . $designCategory . '</td>';
                   echo '<td>' . $description . '</td>';
                   
                   echo '<td><a href="ProjectUpdate.php?id=' . $projectID . '">Edit</a></td>'; //name of the page
                   echo '<td><a href="ProjectDelete.php?id=' . $projectID . '">Delete</a></td>';
                   echo '</tr>';
                    }
                   echo '</table>';
            }
             ?>

            <section id="consultation-requests">
                <h2 class="header1">Design Consultation Requests</h2>
              <?php 
                 echo '<table>';
                  echo '<tr>';
                  echo '<th>Client</th>';
                  echo '<th>Room</th>';
                  echo '<th>Dimensions</th>';
                 echo '<th>Design Category </th>';
                 echo '<th>Color Preferences</th>';
                echo '<th>Date</th>';
                echo '</tr>';
                
                $query3 = "SELECT dcr.id, c.firstName AS clientFName, c.lastName AS clientLName, rt.type AS roomType, dc.category AS designCategory, dcr.roomWidth, dcr.roomLength, dcr.colorPreferences, dcr.date
           FROM DesignConsultationRequest dcr
           INNER JOIN Client c ON dcr.clientID = c.id
           INNER JOIN RoomType rt ON dcr.roomTypeID = rt.id
           INNER JOIN DesignCategory dc ON dcr.designCategoryID = dc.id
           WHERE dcr.statusID = (SELECT id FROM RequestStatus WHERE status = 'pending consultation')
           AND dcr.designerID = <designerID>";
                
                $result3 = mysqli_query($connection, $query3);
                        while ($row = mysqli_fetch_assoc($result3)) {
                            echo '<tr>';
                            echo '<td>' . $row["clientFName"].' '.$row["clientLName"]. '</td>';
                            echo '<td>' . $row["roomType"] . '</td>';
                            echo '<td>' . $row["roomWidth"] . 'x' . $row["roomLength"] . '</td>';
                            echo '<td>' . $row["designCategory"] . '</td>';
                            echo '<td>' . $row["colorPrefrences"] . '</td>';
                            echo '<td>' . $row["date"] . '</td>';
                            echo '<td><a href="DesignConsultation.php?id=' . $row['id'] . '">Provide Consultation</a></td>';
                            echo '<td><a href="DeclineConsultation.php?id=' . $row['id'] . '">Decline Consultation</a></td>';
                            echo '</tr>';
                            
                        }
             
              ?>
            </section>

        </main>

        <footer>
            <div class="footcontainer">
                <div class="col1"> 
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
                <div class="col3">
                    <h3>Address</h3>
                    <p>Saudi Arabia, Riyadh, King Saud University, Information Technology department IT329</p>
                    <p>Privacy - Term</p>

                </div>
            </div>

        </footer>
    </body>
</html>