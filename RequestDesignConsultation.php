<?php
require 'checkSecurity.php';
?>

<!DOCTYPE html>
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
    $Did = $_GET['designerID'];
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="x-icon" href="image/tapImage.PNG">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="RequestDesignConsultation.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Request design consultation</title>
    </head>

    <body>
        <header>
            <img src="image/tapImage.PNG" alt="Majlas's Logo" width="200">
            <button type="button" onclick="window.location.href = 'SignOut.php'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
            </button> 
        </header>
        <div class="breadcrumb">
            <?php echo'<a href="ClientHomePage.php?id='.$_SESSION['id'].'">Client Homepage</a>'?>
            <span> / </span>
            <?php echo'<a href="RequestDesignConsultation.php?designerID='.$_GET['designerID'].'">Request design consultation</a>'?> 
        </div>
        <main>
            <br>
            <div class="formBody">
                <h1>Request design consultation</h1>
                <br><div class="AllForm">
                    <?php
                    echo '<form action="addRequestDesignConsultation.php?clientID='.$ClientID.'" method="POST">';
                    ?>                    
                    <fieldset>
                        <legend>Request design consultation form</legend>       
                        <br>
                        <label>Room Type: 
                            <select name="roomType" id="roomType" required >
                                <option value="Bedroom">Bedroom</option>
                                <option value="Kitchen">Kitchen</option>
                                <option value="LivingRoom">Living Room</option>
                            </select>
                        </label>
                        <br>
                        <?php
                        echo '<input type="hidden" name="desId" value="' . $_GET['designerID'] . '">';
                        ?>
                        <p>Room dimensions:</p>
                        <label>
                            Width:
                            <input type="text" name="width" class="input" placeholder='in meters' required>
                        </label>
                        <br>
                        <label>
                            height:
                            <input type="text" name="height" class="input" placeholder='in meters' required>
                        </label>
                        <br>
                        <label>
                            Design category: 
                            <select name="DesignCategory" id="DesignCategory" required>
                                <option value="Modern">Modern</option>
                                <option value="Mid-century modern">Mid-century modern</option>
                                <option value="Coastal">Coastal</option>
                                <option value="Minimalist">Minimalist</option>
                                <option value="Country">Country</option>
                            </select>
                        </label>
                        <br>
                        <label>
                            Color preferences: <input type="text" name="Color" class="input" placeholder="Enter your color preferences" id="COLOR" required>
                        </label>
                        <br><br>
                        <button class="btn" type="submit" >
                            <span class="btn__visible">Send</span>
                            <span class="btn__invisible">Thank you :)</span>
                        </button>

                    </fieldset>
                    </form>

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
