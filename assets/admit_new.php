<?php
    require '../control/SQL_Operations.php';
    $sql = new SQL_Operations();
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dob = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
    $nok = $_POST['nok'];
    $nok_phone = $_POST['nok_phone'];
    $gender = $_POST['gender'];

    

        $created = $sql -> createPatient($firstname, $lastname, $gender, $dob, $phone, $address, $nok, $nok_phone);
        if($created){
            header('location:../dashboard.php');
        }else{
           header('location:../dashboard.php?e=pat_not_created');
        }
?>