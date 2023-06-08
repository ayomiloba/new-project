<?php
    $logged_user = $sql -> getConsultant($u);
    $usertype = $logged_user['type'];
?>
<div class="sidebar" data-color="red" data-image="assets/img/sidebar-6.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                    H.I.S
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
        <?php
            if($usertype == 4 || $usertype == 6){
                $m_a = '';
            }else{
                $m_a = 'style=" display: none;"';
            }
        ?>
                <li <?php echo $m_a?>>
                    <a href="consultants.php">
                        <i class="pe-7s-user"></i>
                        <p>Personnels</p>
                    </a>
                </li>
        <?php
            if($usertype == 6){
                $a = '';
            }else{
                $a = 'style=" display: none;"';
            }
        ?>
                <li <?php echo $a?>>
                    <a href="table.html">
                        <i class="pe-7s-note2"></i>
                        <p>Admin</p>
                    </a>
                </li>
       
            </ul>
    	</div>
    </div>