
<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['type'])) {
    $ClientID = $_SESSION['id'];
    $Type = $_SESSION['type'];
}


error_reporting(E_ALL);

ini_set('log_errors', '1');

ini_set('display_errors', '1');

$conn = mysqli_connect('localhost', 'root', 'root', 'majlas');
$error = mysqli_connect_error();
if ($error != null) {
    $output = '<p> Unable to connect to database</p>' . $error;
    exit($output);
} else {
    
    if (isset($_POST['desId'])) { //////////////////////////////////////////////////////////////////////////////////
        //defining Variable
        $date = date("Y-m-d");
        $type = $_POST['roomType'];
        $width = $_POST['width'];
        $height = $_POST['height'];
        $DesignCategory = $_POST['DesignCategory'];
        $Color = $_POST['Color'];
        $Did= $_POST['desId'];
        //getting the id for the status
        $status = 'pending consultation';
        $sql = "SELECT id FROM requeststatus WHERE status='$status'";
        $result = mysqli_query($conn, $sql);
        $rowstatus = mysqli_fetch_assoc($result);
        //getting the id for the room type
        $sql2 = "SELECT id FROM roomtype WHERE type='$type'";
        $result2 = mysqli_query($conn, $sql2);
        $rowtype = mysqli_fetch_assoc($result2);
        $roomType=$rowtype['id'];
        //getting the id for the design category
        $sqlcat = "SELECT id FROM designcategory WHERE category='$DesignCategory'";
        $result3 = mysqli_query($conn, $sqlcat);
        $rowcat = mysqli_fetch_assoc($result3);
        $cat=$rowcat['id'];
        
        //insert the data to the database
        $sqlIn = "INSERT INTO designconsultationrequest (clientID,designerID,roomTypeID,designCategoryID,roomWidth,roomLength,colorPreferences,date, statusID) VALUES ('$ClientID' ,'$Did','$roomType','$cat','$width','$height','$Color','$date'," . $rowstatus['id'] . ")";
        $resultIn = mysqli_query($conn, $sqlIn);
        if($resultIn){
            header('Location:ClientHomepage.php?id='.$ClientID);
        }
        
    }
}
