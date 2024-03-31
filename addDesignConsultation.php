<?php
error_reporting(E_ALL);

ini_set('log_errors', '1');

ini_set('display_errors', '1');

require 'checkSecurity.php';

$conn = mysqli_connect('localhost', 'root', 'root', 'majlas');
$error = mysqli_connect_error();
if ($error != null) {
    $output = '<p> Unable to connect to database</p>' . $error;
    exit($output);
} else {
    $id = $_GET['request_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {      
    $stat = "consultation provided";
    $sql = "SELECT * FROM requeststatus WHERE status='$stat'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    //update the status id to consultation provided
    $sql2 = "UPDATE designconsultationrequest SET statusID =".$row['id']."WHERE id='$id'";
    $result2 = mysqli_query($conn, $sql2);

    //add new design consultation to the database 
    $consultation = $_POST['Consultation'];
    $img = $_POST['ConsultationImage'];
    $sql3 = "INSERT INTO designconsultation (requestID ,consultation ,consultationImgFileName) VALUES ('$id', '$consultation', '$img')";
    $result3 = mysqli_query($conn, $sql3);
    header('Location:DesignerHome.php?id='.$DesignerID);
}
}

