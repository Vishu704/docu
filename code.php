<?php

require('config.php');
session_start();

if(isset($_POST['login']))
{
    $query = "SELECT * FROM registered_users WHERE email='$_POST[email_username]' OR username='$_POST[email_username]' ";
    $result = mysqli_query($conn,$query);

    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $result_fetch = mysqli_fetch_assoc($result);
            if(password_verify($_POST['password'],$result_fetch['password']))
            {
                #If Password matched
                $_SESSION['logged_in']=true;
                $_SESSION['username']=$result_fetch['username'];
                header("location:index.php");

            }
            else
            {
                #If Password incorrect
                echo"
                <script>
                alert('Password incorrect');
                window.location.href='login.php';
                </script>";

            }
        }
        else
        {
            echo"
            <script>
            alert('Email Or Username incorrect');
            window.location.href='index.php';
            </script>";
        }
    }
    else
    {
        echo"
        <script>
        alert('can not run query');
        window.location.href='index.php';
        </script>";
    }
}

?>