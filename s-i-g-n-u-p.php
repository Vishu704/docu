<?php 

require('config.php');
session_start();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">  
</head>
  <body>


    <div  class="d-flex justify-content-center align-items-center p-3 vh-100">
        <div class="login-container">

            <div class="login-logo p-3">
                <img src="images/logo.svg" alt="">
            </div>

            <div class="login-form">
                <h3 class="title text-center mb-4 pb-2 ps-0">User Signin</h3>

                <form method="POST" action="codes.php">
                    <div class="mb-3">
                    <input type="text" class="form-control" id="user"  name="fullname" placeholder="Full Name">
                    </div>
                    <div class="mb-3">
                    <input type="text" class="form-control" id="user"  name="username" placeholder="User Name">
                    </div>
                    <div class="mb-3">
                    <input type="email" class="form-control" id="user"  name="email" placeholder="E-mail">
                    </div>
                    <div class="mb-3">
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn login-submit-btn" name="register" >Submit</button>
                </form>

            </div>

        </div>
    </div>

   <footer  class="footer-line">
    <p>Design & Delvelop  
        <span>
            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 1.31405C12.4381 -3.24794 23.5344 4.73503 8 15C-7.53442 4.73604 3.56188 -3.24794 8 1.31405Z" fill="black"/>
            </svg>
        </span> by Team  <span class="blutrain">Blutrain</span>  </p>
   </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>