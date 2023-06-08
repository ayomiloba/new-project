<?php
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();
    $id = $_GET['id'];
    $room = $_POST['room'];

    $room_vacant = $sql -> checkRoom($room);
    if($room_vacant){
        $roomAssigned = $sql -> addToRoom($room);
        if($roomAssigned){
            $admitted = $sql -> admit($id, $room);
            if($admitted){
                header('location:../dashboard.php');
            }else{
            header('location:../dashboard.php?e=pat_not_admitted');
            }
        }else{
            header('location:../dashboard.php?e=unable_to_assign');
        }
    }else{
        header('location:../dashboard.php?e=room_not_vacant');
    }
?>