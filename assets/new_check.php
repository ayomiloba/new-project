<?php
session_start();
if(!isset($_SESSION['u'])){
    header('location:index.php');
}
	require 'control/SQL_Operations.php';
	$sql = new SQL_Operations();
    $con_id = $_GET['cons'];
    $pat_id = $_GET['id'];
    $pat = $sql -> getPatient($pat_id);
    $cons = $sql -> getConsultant($con_id);
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
                    <a class="navbar-brand" href="#">New Check</a>
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
                                <h4 class="title">Consultation Details</h4>
                            </div>
                            <div class="content">
                                <form action="handlers/check.php?pat_id=<?php echo $pat_id ?>&con_id=<?php echo $con_id ?>" method="POST">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Personnel/Attendant</label>
                                                
                                                <input name="con" id="pform" type="text" class="form-control" disabled value="<?php echo $cons['lastname']." ".$cons['firstname']?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Patient</label>
                                                <input name="pat" id="pform" type="text" class="form-control" disabled value="<?php echo $pat['lastname']." ".$pat['firstname']?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Complaint</label>
                                                <textarea rows="5" name ="complaint" class="form-control" placeholder="Complaint" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Allergies</label>
                                                <textarea rows="5" name ="allergies" class="form-control" placeholder="Allergies" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Current Medications</label>
                                                <textarea rows="5" name ="current_meds" class="form-control" placeholder="Current Medications" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Temperature</label>
                                                <select name="temps" id="pform" class="form-control form-select" placeholder="Temperature">
                                                    <option value="0-20 Degrees C">0-20 Degrees C</option>
                                                    <option value="21-40 Degrees C">21-40 Degrees C</option>
                                                    <option value="41-60 Degrees C">41-60 Degrees C</option>
                                                    <option value="61-80 Degrees C">61-80 Degrees C</option>
                                                    <option value="81-100 Degrees C">81-100 Degrees C</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Heart Rate</label>
                                                <textarea rows="1" name ="heart_rate" class="form-control" placeholder="Heart Rate" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Blood Pressure</label>
                                                <textarea rows="1" name ="blood_pressure" class="form-control" placeholder="Blood Pressure" ></textarea>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Respiratory Rate</label>
                                                <textarea rows="3" name ="resp_rate" class="form-control" placeholder="Respiratory Rate" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Oxygen Saturation</label>
                                                <textarea rows="2" name ="oxy_sat" class="form-control" placeholder="Oxygen Saturation" ></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Comments</label>
                                                <textarea rows="5" name ="comment" class="form-control" placeholder="Comments" ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success  pull-right">Record <i class="pe-7s-add-user"></button> 
                                    <a href="dashboard.php" class="btn btn-danger  pull-right">Cancel <i class="pe-7s-back"></i></a>
                                    <div class="clearfix"></div>
                                </form>
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
