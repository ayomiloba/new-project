<?php
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();

    $pat = $_GET['pat_id'];
    $con = $_GET['con_id'];
    $complaint = $_POST['complaint'];
    $allegies = $_POST['allergies'];
    $current_meds = $_POST['current_meds'];
    $temps = $_POST['temps'];
    $heart_rate = $_POST['heart_rate'];
    $blood_pressure = $_POST['blood_pressure'];
    $resp_rate = $_POST['resp_rate'];
    $oxy_sat = $_POST['oxy_sat'];
    $comment = $_POST['comment'];


  

    $added = $sql -> createCheck($con,$pat,$complaint,$allegies,$current_meds,$temps,$heart_rate,$blood_pressure,$resp_rate, 	$oxy_sat,$comment);

    if($added){
        header('location:../patient.php?id='.$pat);
    }else{
    header('location:../patient.php?e=check_not_added&id='.$pat);
    }
?>