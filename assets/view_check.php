<?php
session_start();
if(!isset($_SESSION['u'])){
    header('location:index.php');
}
	require 'control/SQL_Operations.php';
	$sql = new SQL_Operations();
    $id = $_GET['id'];
    $c = $sql -> getCheck($id);
    $p = $sql -> getPatient($c['pat']);
    $u = $_SESSION['u'];
    $room = $sql -> getRoom($p['room']);
    $ward = $sql -> getWard($room['ward']);
    $consultant = $sql -> getConsultant($c['con']);
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
                    <a class="navbar-brand" href="#">Check/Consultation Details</a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php echo $p['lastname']." ".$p['firstname']?></h4>
                                <!--<p class="category">Last Campaign Performance</p>-->
                            </div>
                            <div class="content">
                            Phone<b>: <?php echo $p['phone']?></b><p>
                            Gender<b>: <?php echo $p['gender']?></b><p>
                            Date of Birth<b>: <?php echo $p['dob']?></b><p>
                            Address<b>: <?php echo $p['addr']?></b><p>
                            Next of Kin<b>: <?php echo $p['nok']?></b><p>
                            Next of Kin Phone<b>: <?php echo $p['nok_phone']?></b><p>
                    <?php 
                        $date = $sql -> formatDate($p['admitted']); 
                        $check_date = $sql -> formatDate($c['date_time']);
                        if($p['discharged']==1){
                            $label = 'Discharged';
                            if($curr_user['on_call']==1){
                                $check = 'style=" display: none;"';
                                $disch = '';
                            }else{
                                $check = 'style=" display: none;"';
                                $disch = 'style=" display: none;"';
                            }
                        }else{
                            $label = 'Admitted';
                            if($curr_user['on_call']==1){
                                $check = '';
                                $disch = 'style=" display: none;"';
                            }else{
                                $check = 'style=" display: none;"';
                                $disch = 'style=" display: none;"';
                            }
                        }
                    ?>
                            Admission Status<b>: <?php echo $label." ".$date ?></b><p>
                            Room<b>: <?php echo "Room ".$room['id']?></b><p>
                            Ward<b>: <?php echo $ward['ward']?></b>
                               
                               <div class="footer">
                                <div class="legend">
                                   <a href="new_check.php?id=<?php echo $p['id']?>&cons=<?php echo $u?>"  class="btn btn-primary" <?php echo $check?>>Check Patient <i class="pe-7s-add-user"></i></a> 
                                   <a  href="handlers/discharge.php?id=<?php echo $p['id']?>&room=<?php echo $p['room']?>" class="btn btn-success btn-fill" <?php echo $disch?>>Discharge</a>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"></h4>
                                <!--<p class="category">Last Campaign Performance</p>-->
                            </div>
                            <div class="content">
                                Personnel/Attendant<b>: <?php echo $consultant['lastname']." ".$consultant['firstname']?></b><p>
                                Date and Time<b>: <?php echo $check_date?></b><hr>
                                Complaint<b>: <?php echo $c['complaint']?></b><hr>
                                Allergies<b>: <?php echo $c['allegies']?></b><p>
                                Current Medications<b>: <?php echo $c['current_meds']?></b><p>
                                Temperature<b>: <?php echo $c['temps']?></b><p>
                                Heart Rate<b>: <?php echo $c['heart_rate']?></b><p>
                                Blood Pressure<b>: <?php echo $c['blood_pressure'] ?></b><p>
                                Respiratory Rate<b>: <?php echo $c['resp_rate']?></b><p>
                                Oxygen Saturation<b>: <?php echo $c['oxy_sat']?></b><hr>
                                Personnel/Attendant Comment<b>: <?php echo $c['comment']?></b><hr>
                               
                                
                            </div>
                            </div>
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
            	message: "Welcome to HMS Software"

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
