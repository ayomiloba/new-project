<?php
session_start();
if(!isset($_SESSION['u'])){
    header('location:index.php');
}
	require 'control/SQL_Operations.php';
	$sql = new SQL_Operations();
	$pat_count = $sql -> getPatientCount();
    $oncall_cons = $sql -> getOnCallConsultantCount();
    $all_cons = $sql -> getAllConsultantCount();
    $v_room_count = $sql -> getVacantRoomCount();
    $room_count = $sql -> getRoomCount();
    $patients = $sql -> getPatients();
    $u = $_SESSION['u'];

?>
<!doctype html>
<html lang="en">
<head>
	<?php require "head.html";?>

</head>
<body>

<div class="wrapper">
    <?php
        include 'sidebar.php';
    ?>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
								<p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                    </ul>

                    <?php require 'logout.php'?>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Patients on Admission</h4>
                                <!--<p class="category">Last Campaign Performance</p>-->
                            </div>
                            <div class="content">
                               <b style="font-size: 40pt;"><?php echo $pat_count?></b>
                               <div class="footer">
                                <div class="legend">
                                   <a href="new_patient.php"  class="btn btn-primary">Admit New Patient <i class="pe-7s-add-user"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Available Rooms</h4>
                                <!--<p class="category">Last Campaign Performance</p>-->
                            </div>
                            <div class="content">
                               <b style="font-size: 40pt;"><span style="color: green;"><?php echo $v_room_count?></span>/<?php echo $room_count?></b>
                                <div class="footer">
                                    <div class="legend">
                                       <button class="btn btn-primary">View Details <i class="pe-7s-angle-right-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">

                            <div class="header">
                                <h4 class="title">Personnels/Attendants (On Duty/Total)</h4> 
                            
                            </div>
                            <div class="content">
                               <b style="font-size: 40pt;"><span style="color: green;"><?php echo $oncall_cons?></span>/<?php echo $all_cons?></b>
                                <div class="footer">
                                    <div class="legend">
                                       <button class="btn btn-primary">View Details <i class="pe-7s-angle-right-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                </div>



                <div class="col-md-12">
                    <div class="card" style="padding: 1em;" >
                        <div class="header">
                            <h4 class="title">Patients</h4>
                            <p class="category">Patients in admission</p>
                        </div>
                        <div  class="content table-responsive table-full-width">
                            <table id="patients" class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Room</th>
                                    <th>Ward</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($patients as $p){
                                    ?>
                                    <tr>
                                        <td><?php echo $p['id']?></td>
                                        <td><?php echo $p['firstname']?></td>
                                        <td><?php echo $p['lastname']?></td>
                                        <td><?php
                                                if($p['room']==34){
                                                    echo "Unassigned";
                                                }else{
                                                    echo "Room ".$p['room'];
                                                }
                                                    
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $room = $sql -> getRoom($p['room']);
                                                $ward = $sql -> getWard($room['ward']);
                                                echo $ward['ward'];
                                            ?>
                                        </td>
                                        <td>
                                        <a href="patient.php?id=<?php echo $p['id']?>" class="btn btn-info btn-xs btn-fill">View Records</a>

                                        <?php if($p['discharged']==1){ ?>

                                        <a href="admit.php?id=<?php echo $p['id']?>" class="btn btn-primary btn-xs btn-fill"  <?php echo $disable?>>Admit</a>

                                        <?php }else{ ?>
                                         <a  href="new_check.php?id=<?php echo $p['id']?>&cons=<?php echo $u?>" class="btn btn-default btn-xs btn-fill" <?php echo $disable?>>Check Patient</a>

                                        <a  href="handlers/discharge.php?id=<?php echo $p['id']?>&room=<?php echo $p['room']?>" class="btn btn-success btn-xs btn-fill"  <?php echo $disable?>>Discharge</a>

                                        <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                
            </div>
        </footer>

    </div>
</div>


</body>
<?php require "footer.html";?>
    

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to H.I.S Software"

            },{
                type: 'info',
                timer: 4000
            });

    	});

        $(document).ready(function () {
            $('#patients').DataTable({
                "scrollY": "50vh",
                "scrollCollapse": true,
                "paging": true,
                "pagingType": "full",
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            }  
            );
            $('.dataTables_length').addClass('bs-select');
            
        });
	</script>

</html>
