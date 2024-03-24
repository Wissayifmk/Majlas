<?php
session_start();
if(isset( $_SESSION['id']) && isset($_SESSION['type'])){
    if($_SESSION['type'] == "client"){
        $ClientID = $_SESSION['id']; 
        $Type = $_SESSION['type'];
    }
    else{
        $DesignerID = $_SESSION['id']; 
        $Type = $_SESSION['type'];
    }
}
else{
    echo '<script>window.location.href = "index.php";</script>';
}
?>