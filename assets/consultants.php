<?php
session_start();
if(!isset($_SESSION['u'])){
    header('location:index.php');
}
	require 'control/SQL_Operations.php';
	$sql = new SQL_Operations();
    $oncall_cons = $sql -> getOnCallConsultantCount();
    $all_cons = $sql -> getAllConsultantCount();
    $consultants = $sql -> getConsultants();
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
                    <a class="navbar-brand" href="#">Personnels and Attendants</a>
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
                            <h4 class="title">Personnels/Attendants</h4>
                        </div>
                        <div  class="content table-responsive table-full-width">
                            <table id="patients" class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Phone</th>
                                    <th>On Call/On Duty</th>
                                    <th>Designation</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($consultants as $c){
                                    ?>
                                    <tr>
                                        <td><?php echo $c['id']?></td>
                                        <td><?php echo $c['firstname']?></td>
                                        <td><?php echo $c['lastname']?></td>
                                        <td><?php echo $c['phone']?></td>
                                        <td><?php
                                                if($c['on_call']==1){
                                                    echo "Yes";
                                                }else{
                                                    echo "No";
                                                }
                                                    
                                            ?>
                                        </td>
                                        <td><?php echo $c['designation']?></td>
                                        <td>
                                        <a href="con_checks.php?id=<?php echo $c['id']?>" class="btn btn-info btn-xs btn-fill">View Consultations/Checks</a>
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
