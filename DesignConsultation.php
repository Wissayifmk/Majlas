<?php
require 'checkSecurity.php';
?>
<?php
error_reporting(E_ALL);

ini_set('log_errors', '1');

ini_set('display_errors', '1');

$conn = mysqli_connect('localhost', 'root', 'root', 'majlas');
$error = mysqli_connect_error();
if ($error != null) {
    $output = '<p> Unable to connect to database</p>' . $error;
    exit($output);
} else {
    $id = $_GET['requestID'];
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="DesignConsultation.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Design Consultation</title>
    </head>

    <body>

        <header>
            <img src="image/tapImage.PNG" alt="Majlas's Logo" width="200">
            <button type="button" onclick="window.location.href = 'index.html'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
            </button> 
        </header>
        <div class="breadcrumb">
            <a href="DesignerHomePage.html">Designer Homepage</a>
            <span> / </span>
            <a href="DesignConsultation.html">Design Consultation</a>  
        </div>
        <main>
            <br>
            <h1>Design Consultation</h1>
            <div class="allPage">
                <div id="RequestInformation">
                    <h2>Request Information</h2>
                    <div id="RequestInformationData">
                        <?php
                        //get the request info
                        $sql = "SELECT * From designconsultationrequest WHERE id=$id";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        
                        //getting the full name from the client table using the client id from the request table
                        $sqlname = "SELECT firstName,lastName FROM client WHERE id=" . $row['clientID'];
                        $resultname = mysqli_query($conn, $sqlname);
                        $rowname = mysqli_fetch_assoc($resultname);
                        echo'<p>Client:' . $resultname['firstName'] . ' ' . $resultname['lastName'] . '<br>';
                        
                        //getting the room type from the room type table using the room type id from the request table
                        $sqltype = "SELECT type FROM roomtype WHERE id=" . $row['roomTyprID'];
                        $resulttype = mysqli_query($conn, $sqltype);
                        $rowtype = mysqli_fetch_assoc($resulttype);
                        echo ' Room: ' . $rowtype['type'] . '<br> ';
                        
                        //getting the Dimensions from the request table
                        echo'Dimensions:' . $row['roomLength'] . 'x' . $row['roomWidth'] . 'm<br>';
                        
                        //getting the category from the category table using the category id from the request table
                        $sqlcat = "SELECT category FROM designcategory WHERE id=" . $row['designCategoryID'];
                        $resultcat = mysqli_query($conn, $sqlicat);
                        $rowcat = ysqli_fetch_assoc($resultcat);
                        echo'Design Category:' . $row['category'] . '<br>';
                        
                        //getting the color and the date from the request table
                        echo'Color Preferences:' . $row['colorPreferences'] . '<br>';
                        echo 'Date' . $row['date'] . '</p>';
                        ?>
                    </div>
                </div>
                <form action="addDesignConsultation.php" method="post">
                    <label>Consultation:<br>
                        <textarea name="Consultation" cols="38" rows="7" placeholder="Write your consultation here" required></textarea>
                    </label><br>
                    <?php
                    echo '<input type = "hidden" name = "id" value = "' . $id . '">';
                    ?>
                    <label>Upload Image:<br>
                        <input type="file" name="ConsultationImage" id="file" required></label>
                    <br>
                    <br>
                    <button class="btn" type="submit" >
                        <span class="btn__visible">Send</span>
                        <span class="btn__invisible">Thank you :)</span>
                    </button>

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

                <div class = "col2">
                    <h3>Contact us</h3>
                    <ul>
                        <li><a href = "tel:+0543080394"><img src = "image/phone.png" alt = "Phone call"> <span class = "phone-number">0543080394</span></a></li>
                        <li><a href = "mailto:Majlas@info.com"><img src = "image/email.png" alt = "Email Message"> <span class = "email-address">Majlas@info.com</span></a></li>
                    </ul>
                    <span>&copy;
                        All rights reserved 2023-2024</span>
                </div>

                <div class = "col3"> <!--for the left most column*/-->
                    <h3>Address</h3>
                    <p>Saudi Arabia, Riyadh, King Saud University, Information Technology department IT329</p>
                    <p>Privacy - Term</p>

                </div>
            </div>

        </footer>

    </body>
</html>