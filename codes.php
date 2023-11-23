<?php

require('config.php');
session_start();

if(isset($_POST['register']))
{
    $user_exist_query="SELECT * FROM registered_users WHERE username='$_POST[username]' OR email='$_POST[email]' ";
    $result = mysqli_query($conn,$user_exist_query);

    if($result)
    {
        #username or email already taken
        if(mysqli_num_rows($result)>0)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if($result_fetch['username']==$_POST['username'])
            {
                #username already taken
                echo"
                <script>
                alert('$result_fetch[username] - Username already exist');
                window.location.href='signup.php';
                </script>";
            }
            else
            {
                #email already taken
                echo"
                <script>
                alert('$result_fetch[email] - Email already exist');
                window.location.href='signup.php';
                </script>";
            }
        }
        else
        {
            $password = password_hash($_POST['password'],PASSWORD_BCRYPT);

            $query = "INSERT INTO registered_users(full_name, username, email, password) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";

            if(mysqli_query($conn,$query)){

                echo"
                <script>
                    alert('Registration successfully');
                    window.location.href='login.php';
                </script> ";
            }
            else
            {
                echo"server down";
            }
        }
    }
    else
    {
        echo"
        <script>
        alert('cannot run query');
        window.location.href='signup.php';
        </script> ";
    }
}




?>