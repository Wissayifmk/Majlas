
<?php
session_start();

// Create a new mysqli connection
$connection = mysqli_connect("localhost", "root", "root", "majlas");
if (mysqli_connect_errno()) {
    // Check connection
    die("Connection Error" . mysqli_connect_error());
} else  {
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
        $email = $_POST['Email'];
        $password = $_POST['password'];
        $usertype = $_POST['Type'];

        // Prepare the SQL statement based on the user type
        if ($usertype == 'client') {
            $table = 'client';
        } else if ($usertype == 'interior') {
            $table = 'designer';
        }

        $sql = "SELECT id, password FROM $table WHERE emailAddress = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
            mysqli_stmt_bind_result($stmt, $id, $hashedPassword);
            mysqli_stmt_fetch($stmt);

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Set the session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['user_type'] = $usertype;

                // Redirect to the appropriate homepage based on the user type
                if ($usertype == 'client') {
                    header('Location: ClientHomepage.php');
                    exit();
                } else if ($usertype == 'interior') {
                    header('Location: DesignerHomePage.php');
                    exit();
                }
            }
        }

        // Authentication failed, redirect back to the login page with an error message
        header('Location: Login.html?error=' . urlencode('Invalid email or password'));
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login page</title>
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
</head>

<body>
    <header>
       <a href="index.html" class="logo" accesskey="h"><img src="image/tapImage.PNG" alt="Majlas's Logo" width="200"></a>
            <button type="button" onclick="window.location.href = 'index.html'" class="log-out">
                <img src="image/Log-Out.png" alt="log-out">
            </button> 
    </header>
    <main>
        
         <div class="breadcrumb">
            <a href="index.html">Homepage</a>
            <span> / </span>
            <a href="Login.html">Login Page</a>  
        </div>
        <div class="form">
            <form id="login-form" method="post">
         <div>
                  
            <br>
        <p id="a">Login</p>
        <br>
      
        <label id="label1">Email:</label><input type="text" name="Email" placeholder="Email address"><br><br>
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
                <p id="b">New user? <a href="SignUp.html">Sign-up</a></p>

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