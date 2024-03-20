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
             if (isset($_GET['id']))
             {
            $projectID = $_GET['id'];
            $deleteQuery = "DELETE FROM DesignPortoflioProject WHERE id = $projectID";
            $deleteResult = mysqli_query($connection, $deleteQuery);
             if ($deleteResult) 
             {
             header("Location: DesignerHome.php"); //DesignerHomePage
             exit();
             } else {
                     echo 'Error deleting the project from the database.';
                    }
             }
         }


         mysqli_close($connection);
