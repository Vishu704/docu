<?php

require('config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
}

$user = $_SESSION['username'];
$u_query = mysqli_query($conn,"SELECT * FROM registered_users WHERE username = '$user'");
$row = mysqli_fetch_array($u_query);
$id = $row['id'];
// echo "$id";

if(isset($_POST['submit']))
{
    $service = serialize($_POST['service']);
    
    $query = "INSERT INTO docu_form(company_name, date, order_id, clientname, email, contact, address, card, expiration, currency, amount, plans,service,user_name,comments,user_id) VALUES ('$_POST[company_name]','$_POST[date]','$_POST[order_id]','$_POST[clientname]','$_POST[email]','$_POST[contact]','$_POST[address]','$_POST[card]','$_POST[expiration]','$_POST[currency]','$_POST[amount]','$_POST[plans]','$service','$_SESSION[username]','$_POST[comments]','$id')";

        if(mysqli_query($conn,$query)){

            echo"
            <script>
                // alert('Creation successfully');
                window.location.href='docu-list';
            </script> ";
        }
        else
        {
            echo"server down";
        }
}
?>