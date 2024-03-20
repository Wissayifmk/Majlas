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
         } else 
       {
       // $query = "UPDATE DesignConsultationRequest SET statusID = (SELECT id FROM RequestStatus WHERE status = 'consultation declined') WHERE id = $requestID";
         $result = mysqli_query($connection, $query);
         if ($result) 
         {
             header("Location: designer_homepage.php");
             exit();
             
         }
        } 
        mysqli_close($connection);
