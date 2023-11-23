<?php 

require('config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
}

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql= "DELETE FROM docu_form WHERE id=$id";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo 'Deleted Successfully';
        header('location:index.php');
    }
    else{
        echo 'error';
    }
}


?>