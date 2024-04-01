
<?php



    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] =='POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $usertype = $_POST['Type'];
        
        // Create a new mysqli connection
      $connection = mysqli_connect("localhost", "root", "root", "majlas");
       if (mysqli_connect_errno()) {
       // Check connection
        die("Connection Error" . mysqli_connect_error());
}

        // Prepare the SQL statement based on the user type
        if ($usertype == 'client') {
        $sql = "SELECT * FROM client WHERE emailAddress = '$email'";
        $result = mysqli_query($connection, $sql);
        
        if($result && mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['type'] = $usertype;
                header('Location: ClientHomepage.php?id='.$row['id']);
                exit();
            }
            else {
//                header('Location: index.php?message=Invalid password or email');
//                echo '<script>'
//                . 'alert("Invalid password or email");'
//                . 'window.location.href = "index.php";'
//                . '</script>';
//                exit();
                echo '<script>
                alert("Invalid password or email");
                window.location.href = "login.php";
                </script>';
                exit;
            }
        }else {
//                header('Location: Login.php?message=user not found');
//            echo '<script>'
//            . 'alert("user not found");'
//            . 'window.location.href = "index.php";'
//            . '</script>';
//            exit();
            echo '<script>
                alert("user not found");
                window.location.href = "login.php";
                </script>';
                exit;
            }
        } else {$sql = "SELECT * FROM designer WHERE emailAddress = '$email'";
        $result = mysqli_query($connection, $sql);
        if($result && mysqli_num_rows($result)>0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['type'] = $usertype;
                header('Location: DesignerHomePage.php?id='.$row['id']);
                exit();
            }
            else {
                echo '<script>
                alert("Invalid password or email");
                window.location.href = "login.php";
                </script>';
                exit;
//                 echo '<script>'
//                . 'alert("Invalid password or email");'
//                . 'window.location.href = "index.php";'
//                . '</script>';
            }
        }else {
//                echo '<script>'
//            . 'alert("user not found");'
//            . 'window.location.href = "index.php";'
//            . '</script>';
//            exit();
            echo '<script>
                alert("user not found");
                window.location.href = "login.php";
                </script>';
                exit;
            }
            
        }
        }
        
        
       

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <link rel="stylesheet" href="login2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body>
    <header>
       <a href="index.php" class="logo" accesskey="h"><img src="image/tapImage.PNG" alt="Majlas's Logo" width="200"></a>
            
    </header>
    <main>
        
         <div class="breadcrumb">
            <a href="index.php">Homepage</a>
            <span> / </span>
            <a href="Login.php">Login Page</a>  
        </div>
        <div class="form">
            <form id="login-form" method="post">
         <div>
                  
            <br>
        <p id="a">Login</p>
        <br>
      
        <label id="label1">Email:</label><input type="text" name="email" placeholder="Email address"><br><br>
        <label id="label2">Password:</lable> <input type="password" id="pass1" name="password" placeholder="password"><br>
            <br>
            <br>
              <label>
                        <input type="radio" id="user-type" name="Type" value="interior">
                        <span>Interior Designer</span>
                    </label>
                    <label>
                        <input type="radio" id="user-type" name="Type" value="client">
                        <span>Cleint</span>
                    </label>
                </div>
                <button type="submit" class="button type1">Login</button>
                <p id="b">New user? <a href="SignUp.php">Sign-up</a></p>

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
   
    <script>
   
    </script>

</body>
</html>