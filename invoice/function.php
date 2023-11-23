<?php 

require('../config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:../login.php');
}


if(isset($_GET['deleteids'])){
    $ids = $_GET['deleteids'];
    $sqls= "DELETE FROM order_invoice WHERE id=$ids";
    $results = mysqli_query($conn,$sqls);
    if($results){
        echo 'Deleted Successfully';
        header('location:/invoice/invoice.php');
    }
    else{
        echo 'error';
    }
}


?>