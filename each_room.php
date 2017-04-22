<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$tbl = $row['tbl_TempSet'];
$stmt = $user_home->runQuery("SELECT * FROM $tbl");
$stmt->execute();
$tbl_TempSet = $stmt->fetchAll(PDO::FETCH_ASSOC);

$room_x = $_GET["roomParam"];
//$roomParamG="aeach_room_";
//$roomParamG = $roomParamG.(String)$room_x;
//echo $roomParamG;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Io2Life | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  

		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>        

        <script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/1.1.0/dygraph-combined.js"></script>

        <script type="text/javascript"> 
            
			
        </script>

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="A_bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="./plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->

  <!-- jvectormap 
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  -->
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-md"><b>Io2</b>LIFE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle col-xs-3" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
	  
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
              <!--<span class="hidden-xs"><?php echo $row['userEmail']; ?></span>-->
              <span>로그인 : <?php echo $row['userEmail']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->

              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php echo $row['userEmail']; ?>
                  <small>Member since <?php echo $row['timestamp_value']; ?></small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
				<div class="box-body">
					<a href="logout.php" class="btn bg-maroon btn-block btn-flat margin"> 나가기... </a>
				</div>
              </li>
            </ul>
          </li>

          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN SERVICES</li>
        <li class="treeview">
          <a href="home.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i> 
            <span>Each room chart</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) { ?>

				<li class=""><a href="each_room.php?roomParam=<?php echo $x+1; ?>">
					<i class="fa fa-circle-o"></i> Room <?php echo $x+1; ?> Chart</a></li>
			
			<?php } ?>
          </ul>
        </li>

        <li class="treeview">
          <a href="tempsettings.php">
            <i class="fa fa-edit"></i> <span>Temp. settings</span>
          </a>
        </li>
        <li class="treeview">
          <a href="roomlabel.php">
            <i class="fa fa-table"></i> <span>Room labels</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Realtime charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) { ?>

				<li class=""><a href="realtime.php?roomParam=<?php echo $x+1; ?>">
					<i class="fa fa-circle-o"></i> Realtime Room <?php echo $x+1; ?> Chart</a></li>
			
			<?php } ?>


          </ul>
        </li>
        <li class="header">CONTROL STATUS Info.</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Heating</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Valve Closed</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        개별 온도
        <small>Version 2.0</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->

		<!-- Graph boxes -->	  
		<!-- Graph boxes -->	  
		<!-- Graph boxes -->	  
		<!-- Graph boxes -->



		<div class="row">
			<div class="col-md-12">

			  <div class="box box-primary">
				<!-- Graph box header start -->
				<div class="box-header with-border">
					<h2 class="box-title"><b>방 - <?php echo $room_x ?> : <?php echo $tbl_TempSet[$room_x-1][roomName];; ?>의 온도 그래프</h2></b>
                            <div class="header">
								<!--<p><b>Date:</b> <input type="text" placeholder="오늘 <?php echo date("Y-m-d");?>" id="in_datepicker" /></p>-->

								<!--<input id="datepicker"/>-->
								<b>Date:</b>
								<div class="col-xs-12">
									<div class="input-group">
										<input type="text" class="form-control date-input" id="date-fld" placeholder="오늘 <?php echo date("Y-m-d");?>" />
										<label class="input-group-btn" for="date-fld">
											<span class="btn btn-default">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</label>
										<!--<input type="text" class="form-control col-xs-3 date-input" id="date-fld" />-->
									</div>
								</div>
                            </div>
								<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				  <div class="row">
					<div class="col-md-12">
						<!-- /.chart-responsive -->
						<div class="content">
							<div id="aeach_room" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</div>
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</div>
				<!-- ./box-body -->
				<!-- /.box-footer -->
			  </div>
			  <!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
      <!-- /.row -->

		  <!-- Main row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2015-2017 <a href="http://io2life.com">Iot to human life</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar --><!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>

  <script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
  crossorigin="anonymous"></script>
<!-- Bootstrap 3.3.6 -->
<script src="A_bootstrap/js/bootstrap.min.js"></script>	

<!-- bootstrap datepicker -->
<script src="./plugins/datepicker/bootstrap-datepicker.js"></script>

<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline 
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
-->
<!-- jvectormap 
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
-->
<!-- SlimScroll 1.3.0 
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
-->
<!-- ChartJS 1.0.1 -->
<!--<script src="plugins/chartjs/Chart.min.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard2.js"></script>-->
<script src="https://code.highcharts.com/stock/highstock.js"></script>

<!--<script src="./assets/js/demo.js"></script>-->
<script src="assets/js/demo_each_room.js"></script>



<!--<script src="./plugins/datepicker/bootstrap-datepicker.js"></script>-->



<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
