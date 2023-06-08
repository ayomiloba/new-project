<?php
session_start();
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();

    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action == 1){
        $clockedout = $sql -> clockOut($id);
        if($clockedout){
            header('location:../dashboard.php');
        }else{
            header('location:../index.php?e=clock_out_failed');
        }
    }else{
        $clockedin = $sql -> clockIn($id);
        if($clockedin){
            header('location:../dashboard.php');
        }else{
            header('location:../index.php?e=clock_in_failed');
        }
    }
    
    

?>