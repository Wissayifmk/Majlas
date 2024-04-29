<?php
require 'checkSecurity.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Designer Homepage</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="DesignerHomePage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
$(document).ready(function() {
  // Attach event listener to delete buttons
  $('.delete-btn').click(function(e) {
    e.preventDefault();
    var projectID = $(this).data('project-id');
    
    // Send AJAX request to PHP page
    $.ajax({
      url: 'ProjectDelete.php',
      method: 'GET',
      data: { id: projectID },
      success: function(response) {
        response = JSON.parse(response);
        if (response.success) {
          // Delete row from HTML table
          $(e.target).closest('tr').remove();
        } else {
          // Display error message or take appropriate action
          alert('Failed to delete project.');
        }
      },
      error: function() {
        // Display error message or take appropriate action
        alert('An error occurred.');
      }
    });
  });
});

$(document).ready(function() {
  // Attach event listener to delete buttons
  $('.Decline').click(function(e) {
    e.preventDefault();
    var request_id = $(this).data('request-id');
    
    // Send AJAX request to PHP page
    $.ajax({
      url: 'DeclinedDesignConsultation.php',
      method: 'GET',
      data: { id: request_id },
      success: function(response) {
        response = JSON.parse(response);
        if (response.success) {
          $(e.target).closest('tr').remove();
        } else {
          alert('Failed to Decline project.');
        }
      },
      error: function() {
        alert('An error occurred.');
      }
    });
  });
});

    </script>
    </head>

    <?php
    $host = "localhost";
    $user = "root";
    $pass = "root";
    $database = "majlas";
    $connection = mysqli_connect($host, $user, $pass, $database);
    $error = mysqli_error($connection);
    if ($error != null) {
        $output = "<p>can not connect to databsase</p>" . $error;
        exit($output);
    } else {
        $query1 = "SELECT * FROM Designer WHERE id = $DesignerID";
        $result1 = mysqli_query($connection, $query1);
    }
    ?>

    <body>  
        <header>
            <img src="image/tapImage.PNG" alt="Majlas's Logo" width="200">
            <button type="button"  onclick="window.location.href = 'SignOut.php'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
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

            echo '<div class="designer-info">';
            echo '<h1>Welcome ' . $firstName . '</h1>';
            echo '<p>';
            echo '<h3>Designer information:</h3>';
            echo '<span>First name:</span> ' . $firstName . '<br>';
            echo '<span>Last name:</span> ' . $lastName . '<br>';
            echo '<span>Email address:</span> <a href="mailto:' . $emailAddress . '">' . $emailAddress . '</a><br>';
            echo '<span>Brand Name:</span> ' . $brandName . '<br>';
            echo '<span>Category: </span>';

            $query4 = "SELECT designCategoryID FROM DesignerSpeciality WHERE designerID=$DesignerID";
            $result4 = mysqli_query($connection, $query4);
            if ($result4) {
                $hasRows = false;
                while ($row2 = mysqli_fetch_assoc($result4)) {
                    $catid = $row2['designCategoryID'];
                    $query5 = "SELECT category FROM DesignCategory WHERE id=$catid";
                    $result5 = mysqli_query($connection, $query5);
                    while ($row3 = mysqli_fetch_assoc($result5)) {
                        if ($hasRows) {
                            echo ', ';
                        }
                        echo $row3['category'];
                        $hasRows = true;
                    }
                }

                echo '</p>';
                echo '</div>';

                // Display the logo image
                echo '<span class="imgHover">';
                echo '<img src="image/' . $logoImgFileName . '" alt="designer logo" id="image0" width="80%">';
                echo '</span>';
            } else {
                echo 'Error fetching designer specialties: ' . mysqli_error($connection);
            }
        } else {
            echo 'No designer found.';
        }
        ?>
    </div>
</section>   
            <div class="desHeader">
                <h3 class="header1">Design Portfolio</h3>
                <div class="add">
                    <?php echo '<a id="Add" href="ProjectAddition.php">Add New Project</a>'; ?>

                </div>
            </div>
            <table id="table1">
                <tr>
                    <th>Project Name</th>
                    <th>Image</th>
                    <th>Design Category</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                $query2 = "SELECT * FROM DesignPortoflioProject WHERE designerID = $DesignerID";
                $result2 = mysqli_query($connection, $query2);
                if ($result2 && mysqli_num_rows($result2) > 0) {

                    while ($row = mysqli_fetch_assoc($result2)) {
                        $projectID = $row['id'];
                        $projectName = $row['projectName'];
                        $imageFileName = $row['projectImgFileName'];
                        $description = $row['description'];
                        $designCategory = $row['designCategoryID'];
                        $sqlcat = "SELECT category FROM designcategory WHERE id=" . $designCategory;
                        $resultcat = mysqli_query($connection, $sqlcat);
                        $rowcat = mysqli_fetch_assoc($resultcat);

                        echo '<tr>';
                        echo '<td>' . $projectName . '</td>';
                        echo '<td><img class="imgs" src="image/' . $imageFileName
                        . '" alt="project image" id="image' . $projectID . '"></td>';
                        echo '<td>' . $rowcat['category'] . '</td>';
                        echo '<td>' . $description . '</td>';

                        echo '<td><a href="ProjectUpdate.php?id=' . $projectID . '">Edit</a></td>'; 
                        echo '<td class="B2"><a class="delete-btn" href="ProjectDelete.php" data-project-id="' . $projectID . '">Delete</a></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>

            <section id="consultation-requests">
                <h2 class="header1">Design Consultation Requests</h2>
                <table id="table2">
                    <tr>
                        <th>Client</th>
                        <th>Room</th>
                        <th>Dimensions</th>
                        <th>Design Category </th>
                        <th>Color Preferences</th>
                        <th>Date</th>
                    </tr>
                    <?php
                        $query6 = "SELECT dcr.id, c.firstName, c.lastName, rt.type, dcr.roomWidth, dcr.roomLength, dc.category, dcr.colorPreferences, dcr.date
           FROM DesignConsultationRequest dcr
           INNER JOIN Client c ON dcr.clientID = c.id
           INNER JOIN RoomType rt ON dcr.roomTypeID = rt.id
           INNER JOIN DesignCategory dc ON dcr.designCategoryID = dc.id
           WHERE dcr.statusID = (SELECT id FROM RequestStatus WHERE status = 'pending consultation')
           AND dcr.designerID = $DesignerID";
                      
                        $resultt = mysqli_query($connection, $query6);
                        
                        if ($resultt->num_rows > 0) {
                        
                        while ($rows = mysqli_fetch_assoc($resultt)) {
                            
                            echo '<tr>';
                            echo '<td>'. $rows["firstName"].' '.$rows["lastName"]. '</td>';
                            echo '<td>' . $rows["type"] . '</td>';
                            echo '<td>' . $rows["roomWidth"] . 'x' . $rows["roomLength"] . '</td>';
                            echo '<td>' . $rows["category"] . '</td>';
                            echo '<td>' . $rows["colorPreferences"] . '</td>';
                            echo '<td>' . $rows["date"] . '</td>';
                            echo '<td><a href="DesignConsultation.php?request_id='.$rows['id'].'">Provide Consultation</a></td>';
                            echo '<td><a class="Decline" href="DeclinedDesignConsultation.php" data-request-id="' . $rows["id"] . '">Decline Consultation</a></td>';
                            echo '</tr>';
                        }
                        } 
                        
                       
                             else {
    // If no requests found
    echo "<tr><td colspan='7'>No design consultation requests found.</td></tr>";
}
                        ?>             
                      
                       
                    
                    
                </table>
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