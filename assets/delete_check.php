<?php
    <?php
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();

    $pat = $_GET['pat_id'];
    $id = $_GET['id'];
    
    $deleted = $sql -> deleteCheck($id);

    if($deleted){
        header('location:../patient.php?id='.$pat);
    }else{
    header('location:../patient.php?e=check_not_deleted&id='.$pat);
    }
?>
?>