<?php
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();
    $id = $_GET['id'];
    $room = $_GET['room'];

    $room_vacated = $sql -> vacateRoom($room);
    if($room_vacated){
        $discharged = $sql -> discharge($id, $room);
        if($discharged){
            header('location:../dashboard.php');
        }else{
           header('location:../dashboard.php?e=pat_not_discharged');
        }
    }else{
        header('location:../dashboard.php?e=room_not_vacated');
    }
?>