<?php
session_start();
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();

    $u = $_POST['username'];
    $p = $_POST['password'];
    
    $con = $sql -> login($u, $p);
    // echo $con;
    if($con != 'no user'){
        $_SESSION['u'] = $con;
        header('location:../dashboard.php');
    }else{
    header('location:../index.php?e=user_not_found');
    }

?>