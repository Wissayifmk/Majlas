<?php
require 'checkSecurity.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="clientHome.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Client Home Page</title>
</head>

<body>
    <header>
        <img src="image/tapImage.PNG" alt="Majlas's Logo" width="200">
        <button type="button" onclick="window.location.href = 'SignOut.php'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
        </button>         
    </header>
    <main>
        <section class="part1">
            <div class="headerContent">
                <?php 
                $connection= mysqli_connect('localhost', 'root','root','majlas');
                if(mysqli_connect_error()){
                    echo '<p>failed</p>';
                    die(mysqli_connect_error());
                }
                $sql="SELECT * FROM Client WHERE id='$ClientID'"; //CHANGE IT TO $clientID
                $result= mysqli_query($connection, $sql);
                $row= mysqli_fetch_assoc($result);
                echo '<h2>Welcome <span>'.$row['firstName'].'</span></h2> ';
                
                ?>
                <div class="clientInfo">
                    <h3>Client's Information:</h3>
                    <p>
                        <?php
                            echo '<span>First name:</span>'.$row['firstName'].' <br>';
                            echo '<span>Last name:</span>'.$row['lastName'].'<br>';
                            echo '<span>Email address:</span> <a href="mailto:'.$row['emailAddress'].'">'.$row['emailAddress'].'</a>';
                        ?>
                    </p>            
                </div>

            </div>
            <span class="imgHover">
                <img src="image/smoke.png" alt="">
            </span>
        </section>
        <div class="header1">
        </div>


        <div class="tableContainer">
        <div class="designer">
            <div class="desHeader">
                <h3>Interior Designers</h3>
                <div class="filter">
<!--                    <p>Select Category:</p>-->
                    <label for="cat">Select Category:</label> <!--can i use it out of form scope?-->
                    <div class="dropdown">
  <!--                       <button class="dropbtn btn">Category  
                          <i class="fa fa-caret-down"></i>
                        </button>-->
                        
 <!--                      <div class="dropdown-content">-->
                            <?php echo '<form action="ClientHomepage.php?id=' . $_SESSION['id'] . '" method="POST">' ?>
                                <select name="cat" id="cat">
                                    <?php 
                                        $sql="SELECT * FROM designcategory";
                                        $result= mysqli_query($connection, $sql);
                                        while ($row= mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
                                        }
                                    ?>
                                </select>

                         
                      </div> 
                    <button type="submit" class="btn">Filter</button>
                    </form>

                </div>
            </div>

            <table class="table1">
                <tr>
                    <th>Designer</th>
                    <th>Specialty</th>
                </tr>
                <?php 
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $catID = $_POST['cat'];
                        $sql = "SELECT * FROM DesignerSpeciality WHERE designCategoryID='$catID'";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $sql2 = "SELECT * FROM Designer WHERE id='".$row['designerID']."'";
                            $result2 = mysqli_query($connection, $sql2);
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo '<tr><td class="image"><a href="DesignPortfolio.php?id='.$row2['id'].'"><img src="image/'.$row2['logoImgFileName'].'" alt="'.$row2['firstName'].'\'s Logo"></a><br> <a href="DesignPortfolio.php?id='.$row2['id'].'" class="desName">'.$row2['firstName'].' '.$row2['lastName'].'</a></td>';
                                $sql3 = "SELECT * FROM DesignerSpeciality WHERE designerID='".$row['designerID']."'";
                                $result3 = mysqli_query($connection, $sql3);
                                echo '<td>';
                                $lastRow = false;
                                
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $sql4 = "SELECT category FROM designcategory WHERE id='".$row3['designCategoryID']."'";
                                    $result4 = mysqli_query($connection, $sql4);
                                    while ($row4 = mysqli_fetch_assoc($result4)) {
                                    if ($lastRow) {
                                        echo ', ';
                                    }
                                    echo $row4['category'];
                                    $lastRow = true;
                                  
                                    }
////                                    if ($row4 = mysqli_fetch_assoc($result4)) {
//                                        echo $row4['category'].', ';
//                                    }
                                }
                                echo '</td>';
                                echo '<td><a href="RequestDesignConsultation.php?designerID='.$row['designerID'].'">Request Design Consultation</a></td></tr>';
                            }
                        }   
                    }
                    
                    else if ($_SERVER['REQUEST_METHOD'] == "GET") {
                        $sql = "SELECT * FROM Designer";
                        $result = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr><td class="image"><a href="DesignPortfolio.php?id='.$row['id'].'"><img src="image/'.$row['logoImgFileName'].'" alt="'.$row['firstName'].'\'s Logo"></a><br> <a href="DesignPortfolio.php?id='.$row['id'].'" class="desName">'.$row['firstName'].' '.$row['lastName'].'</a></td>';
                            $sql2 = "SELECT * FROM designerspeciality WHERE designerID='" . $row['id'] . "'";
                            $result2 = mysqli_query($connection, $sql2);
                            echo '<td>';
                            $hasRows = false;
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $sql3 = "SELECT category FROM designcategory WHERE id='" . $row2['designCategoryID'] . "'";
                                $result3 = mysqli_query($connection, $sql3);
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    if ($hasRows) {
                                        echo ', ';
                                    }
                                    echo $row3['category'];
                                    $hasRows = true;
                                }
                            }
        
                            echo '</td>';
                            echo '<td><a href="RequestDesignConsultation.php?designerID='.$row['id'].'">Request Design Consultation</a></td></tr>';
                        }
                    }
                    
                ?>

            </table>
        </div>
        </div>
        <div class="imagSeprater">
            <img src="image/unnamed.jpg" alt="decor sample">
        </div>
        <div class="tableContainer">
        <div class="conRequest">
            <h3>Previous Design Consultation Request</h3>
            <table>
                
                <tr>
                    <th>Designer</th>
                    <th>Room</th>
                    <th>Dimensions</th>
                    <th>Design Category</th>
                    <th>Color Preferences</th>
                    <th>Request Date</th>
                    <th>Design Consultation</th>
                </tr>
                <?php
                    $sql="SELECT * FROM DesignConsultationRequest WHERE clientID='$ClientID'"; //CHANGE IT TO $clientID
                    $result= mysqli_query($connection, $sql);
//                    $row= mysqli_fetch_assoc($result);
                    while ($row= mysqli_fetch_assoc($result)){
                        $sql2="SELECT * FROM Designer WHERE id='".$row['designerID']."'";
                        $result2= mysqli_query($connection, $sql2);
                        $row2= mysqli_fetch_assoc($result2);
                        echo '<tr><td><img src="image/'.$row2['logoImgFileName'].'"alt= "'.$row2['firstName'].'\'s logo"><br><p>'.$row2['firstName'].' '.$row2['lastName'].'</p></td>';
                        $sql3="SELECT type FROM RoomType WHERE id='".$row['roomTypeID']."'";
                        $result3= mysqli_query($connection, $sql3);
                        $row3= mysqli_fetch_assoc($result3);
                        echo '<td>'.$row3['type'].'</td>';
                        echo '<td>'.$row['roomLength'].'x'.$row['roomWidth'].'</td>';
                        $sql4="SELECT category FROM DesignCategory WHERE id='".$row['designCategoryID']."'";
                        $result4= mysqli_query($connection, $sql4);
                        $row4= mysqli_fetch_assoc($result4);
                        echo '<td>'.$row4['category'].'</td>';
                        echo '<td>'.$row['colorPreferences'].'</td>';
                        echo '<td>'.$row['date'].'</td>';
                        $sql5="SELECT * FROM requeststatus WHERE id='".$row['statusID']."'";
                        $result5= mysqli_query($connection, $sql5);
                        $row5= mysqli_fetch_assoc($result5);
                        if($row5['status']=="consultation provided"){
                            $sql6="SELECT * FROM designconsultation WHERE requestID='".$row['id']."'";
                            $result6= mysqli_query($connection, $sql6);
                            $row6= mysqli_fetch_assoc($result6);
                            echo '<td><p>'.$row6['consultation'].'</p><br><img src="image/'.$row6['consultationImgFileName'].'" alt="designer\'s consulation" class="conImg"></td>';
                        }
                        else
                            echo '<td>'.$row5['status'].'</td>'; 
                        echo '</tr>';
                        
                    }
                ?>
            </table>
        </div>
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