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
                    if ($result1 && mysqli_num_rows($result1) > 0) {//check when log in 
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
                        echo '<span>Category:</span>';
                        $query4 = "SELECT designCategoryID FROM DesignerSpeciality WHERE designerID=$DesignerID";
                        $result4 = mysqli_query($connection, $query4);
                        if ($result4) {
                            while ($row2 = mysqli_fetch_assoc($result4)) {
                                $catid = $row2['designCategoryID'];
                                $query5 = "SELECT category FROM DesignCategory WHERE id=$catid";
                                $result5 = mysqli_query($connection, $query5);
                                if ($result5) {
                                    $row3 = mysqli_fetch_assoc($result5);
                                    echo $row3['category'] . " ";
                                } else {
                                    echo 'Error fetching design category: ' . mysqli_error($connection);
                                }
                            }
                            echo '</p>';
                            echo '</div>';
                        } else {
                            echo 'Error fetching designer specialties: ' . mysqli_error($connection);
                        }
                    } else {
                        echo 'No designer found.';
                    }
                    ?>
                </div>
                <span class="imgHover">
                    <?php echo '<img src="image/' . $logoImgFileName . '" alt="designer logo" id="image0" width=80%>'; ?> 
                </span>
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

                        echo '<tr>';
                        echo '<td>' . $projectName . '</td>';
                        echo '<td><img src="image/' . $imageFileName
                        . '" alt="project image" id="image' . $projectID . '" width=50%></td>';
                        echo '<td>' . $designCategory . '</td>';
                        echo '<td>' . $description . '</td>';

                        echo '<td><a href="ProjectUpdate.php?id=' . $projectID . '">Edit</a></td>'; //name of the page + work or not
                        echo '<td><a href="ProjectDelete.php?id=' . $projectID . '">Delete</a></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>

            <section id="consultation-requests">
                <h2 class="header1">Design Consultation Requests</h2>
                <table>
                    <tr>
                        <th>Client</th>
                        <th>Room</th>
                        <th>Dimensions</th>
                        <th>Design Category </th>
                        <th>Color Preferences</th>
                        <th>Date</th>
                    </tr>
                    <?php
                    
                    $query3 = "SELECT id, clientID, roomTypeID, designCategoryID, roomWidth, roomLength, colorPreferences, date
           FROM DesignConsultationRequest
           WHERE statusID = (SELECT id FROM RequestStatus WHERE status = 'pending consultation')
           AND designerID = <designerID>";
                    $result3 = mysqli_query($connection, $query3);


                    $queryClient = "SELECT id, firstName, lastName
                FROM Client";
                    $resultClient = mysqli_query($connection, $queryClient);


                    $queryRoomType = "SELECT id, type
                  FROM RoomType";
                    $resultRoomType = mysqli_query($connection, $queryRoomType);


                    $queryDesignCategory = "SELECT id, category
                        FROM DesignCategory";
                    $resultDesignCategory = mysqli_query($connection, $queryDesignCategory);


                    while ($row = mysqli_fetch_assoc($result3)) {
                        echo '<tr>';
                        $clientID = $row["clientID"];
                        $roomTypeID = $row["roomTypeID"];
                        $designCategoryID = $row["designCategoryID"];

                        
                        mysqli_data_seek($resultClient, 0);
                        while ($clientRow = mysqli_fetch_assoc($resultClient)) {
                            if ($clientRow["id"] == $clientID) {
                                echo '<td>' . $clientRow["firstName"] . ' ' . $clientRow["lastName"] . '</td>';
                                break;
                            }
                        }

                        
                        mysqli_data_seek($resultRoomType, 0);
                        while ($roomTypeRow = mysqli_fetch_assoc($resultRoomType)) {
                            if ($roomTypeRow["id"] == $roomTypeID) {
                                echo '<td>' . $roomTypeRow["type"] . '</td>';
                                break;
                            }
                        }

                        echo '<td>' . $row["roomWidth"] . 'x' . $row["roomLength"] . '</td>';

                        
                        mysqli_data_seek($resultDesignCategory, 0);
                        while ($designCategoryRow = mysqli_fetch_assoc($resultDesignCategory)) {
                            if ($designCategoryRow["id"] == $designCategoryID) {
                                echo '<td>' . $designCategoryRow["category"] . '</td>';
                                break;
                            }
                        }

                        echo '<td>' . $row["colorPreferences"] . '</td>';
                        echo '<td>' . $row["date"] . '</td>';
                        echo '<td><a href="DesignConsultation.php?id=' . $row['id'] . '">Provide Consultation</a></td>';
                        echo '<td><a href="DeclineConsultation.php?id=' . $row['id'] . '">Decline Consultation</a></td>';
                        echo '</tr>';
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