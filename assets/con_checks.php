<?php
session_start();
if(!isset($_SESSION['u'])){
    header('location:index.php');
}
	require 'control/SQL_Operations.php';
	$sql = new SQL_Operations();
    $id = $_GET['id'];
    $p = $sql -> getConsultant($id);
    $u = $_SESSION['u'];
    $checks = $sql -> getChecksByConsultant($id);
    
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
                    <a class="navbar-brand" href="#">Consultant/Attendant Dashboard</a>
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
                            Designation<b>: <?php echo $p['designation']?></b><p>
                            On Call/On Duty<b>: <?php
                                                if($p['on_call']==1){
                                                    echo "Yes";
                                                }else{
                                                    echo "No";
                                                }
                                                    
                                            ?></b><p>
                            
                    
                                
                            </div>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="col-md-12">
                    <div class="card" style="padding: 1em;" >
                        <div class="header">
                            <h4 class="title">Previous Checks/Consultations</h4>
                        </div>
                        <div  class="content table-responsive table-full-width">
                            <table id="patients" class="table table-hover table-striped">
                                <thead>
                                    <th>Patient</th>
                                    <th>Date and Time</th>
                                    <th>Complaint</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($checks as $c){
                                        $patient = $sql -> getPatient($c['pat']);
                                    ?>
                                    <tr>
                                        <td><?php echo $patient['lastname']." ".$patient['firstname']?></td>
                                        <td><?php echo $c['date_time']?></td>
                                        <td><?php echo $c['complaint']?></td>
                                        <td><?php echo $c['comment']?></td>
                                        <td>
                                        <a href="view_check.php?id=<?php echo $c['id']?>" class="btn btn-info btn-xs btn-fill">View Details</a>
                                        <a href="handlers/delete_check.php?id=<?php echo $p['id']?>&pat_id=<?php echo $id?>" class="btn btn-dnager btn-xs btn-fill">Delete Record</a>
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
