<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="HomePage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>HomePage</title>
    </head>

    <body>
        <header>
            <img src="image/tapImage.PNG" alt="Majlas's Logo" width="200">
        </header>
        <main>
            <div style="height: 100em;">
                <div>
                    <img src="image/HomePage.jpeg" alt="" style=" width: 30%; margin-left: -1em; margin-top: -2em;">
                </div>
                <div style="margin-left: 28em; margin-top: -30em;">
                    <p class="Majlas" style="color: rgb(255, 255, 255); margin-left: 0.1em;">MAJLAS</p>
                    <p class="Majlas" style="color: #7F3425; margin-top: -1.6em;">MAJLAS</p><br>
                    <p id="pMajlas">every space becomes a<br> masterpiece!</p>
                    <button id="Loginbtn">Login</button><br><br>
                    <a href="SignUp.php" class="Sign">New user? Sign up.</a>
                </div>
                <div class="story" style="margin-top: 6em;">
                    <p id="Story">MAJLAS Story!</p><br>
                    <p id="PStory">Majlas embarked on a journey of innovation,<br>shaping the digital realm with their
                        visionary <br>ideas.</p><br>
                </div>

                <div>
                    <img src="image/Inspired.png" alt="" id="InspiredPic">
                    <p id="Inspired">Get Inspired!</p>

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
                        <li><a href="tel:+0543080394"><img src="image/phone.png" alt="Phone call"> <span
                                    class="phone-number">0543080394</span></a></li>
                        <li><a href="mailto:Majlas@info.com"><img src="image/email.png" alt="Email Message"> <span
                                    class="email-address">Majlas@info.com</span></a></li>
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
            document.getElementById("Loginbtn").addEventListener("click", function () {
                window.location.href = "login.php";
            });
        </script>

    </body>
</html>
