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


        <script type="text/javascript"> 
            
            $(document).ready(function() {
				$("#txtDate").datepicker({
					showOn: 'button',
					buttonText: 'Show Date',
					buttonImageOnly: true,
buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
					dateFormat: 'dd/mm/yy',
					constrainInput: true
				});
				
				$(".ui-datepicker-trigger").mouseover(function() {
					$(this).css('cursor', 'pointer');
				});
            
            });
            
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
      <span class="logo-lg"><b>Io2</b>LIFE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <div class="navbar-custom-menu">
		  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		  </a>
	  </div>
	  
      <!-- Navbar Right Menu -->
      <!--<div class="navbar-custom-menu">-->
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
			  <?php echo $row['userEmail']; ?> <i class="caret"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
			  <!--
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
				  <?php echo $row['userEmail']; ?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
			  -->
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-center">
                  <a href="logout.php" class="btn btn-danger btn-block btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      <!--</div>-->

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
        <li class="active treeview">
          <a href="home.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i> 
            <span>Each room chart</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
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
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
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
        Dashboard
        <small>Version 2.0</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
		<div class="row">

<?php for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) { ?>

			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
				<?php 
				
				$R_I_O_BG = 0;
				$RroomStatusIO = $tbl_TempSet[$x][roomStatus];
				//echo $RstatusIO;
				if( $RroomStatusIO == 'Y' ){
					$R_I_O_BG = "small-box bg-aqua";        
				}else{
					$R_I_O_BG = "small-box bg-red";
				}
				?>
				<div class="<?php echo $R_I_O_BG ?>" >
				<div class="inner">
				  <h4><?php echo $tbl_TempSet[$x][roomName]; ?></h4>
				  <h3><?php echo $tbl_TempSet[$x][C_temp]; ?><small><font color=white> °C</font></small></h3>
					  <?php echo $tbl_TempSet[$x][timestamp_value]; ?>
				</div>
				
				<div class="icon">
				  <i class="fa fa-fire"></i>			  
				</div>
				
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i>
					<br>
								  <span class="info-box-text">설정된 온도</span>

					<span class="info-box-number"><?php echo $tbl_TempSet[$x][L_temp]; ?><small>°C</small></span>
				</a>
			  </div>
			</div>

<?php } ?>

			<div class="col-lg-3 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h4>실시간 공급 온도</h4>
				  <h3><?php echo $tbl_TempSet[$tbl_TempSet[0][numSensor]-1][C_temp]; ?><small><font color=white> °C</font></small></h3>
					  <?php echo $tbl_TempSet[$tbl_TempSet[0][numSensor]-1][timestamp_value]; ?>
				</div>
				<div class="icon">
				  <i class="fa fa-angle-double-left"></i>
				</div>
				
				<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i>
					<br>
								  <span class="info-box-text">통상 공급 온도</span>

					<span class="info-box-number">40 ~ 45<small>°C</small></span>
				</a>
			  </div>
			</div>
			<!-- ./col -->
			<!-- fix for small devices only -->
			<div class="clearfix visible-sm-block"></div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
		<!-- Graph boxes -->	  
		<!-- Graph boxes -->	  
		<!-- Graph boxes -->	  
		<!-- Graph boxes -->



		<div class="row">
			<div class="col-md-12">

			  <div class="box">
				<!-- Graph box header start -->
				<div class="box-header with-border">
					<h3 class="box-title">일간 온도 변화 그래프</h3>
                            <div class="header">
								<p><b>Date:</b> <input type="text" placeholder="<?php echo date("Y-m-d");?>" id="in_datepicker" /></p>
                            </div>
<!--
						<div class="form-group">
							<label>Date:</label>
							<div class="input-group date">
							  <div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							  </div>
								<input type="text" class="form-control" id="in_datepicker" data-date-format="yyyy-mm-dd">
							</div>
						  </div>
-->
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
							<div id="container_ir" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</div>
					</div>
					<!-- /.col -->
				  </div>
				  <!-- /.row -->
				</div>
				<!-- ./box-body -->
				<div class="box-footer">
				  <div class="row">
					<div class="col-sm-3 col-xs-6">
					  <div class="description-block border-right">
						<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
						<h5 class="description-header">$35,210.43</h5>
						<span class="description-text">TOTAL REVENUE</span>
					  </div>
					  <!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-3 col-xs-6">
					  <div class="description-block border-right">
						<span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
						<h5 class="description-header">$10,390.90</h5>
						<span class="description-text">TOTAL COST</span>
					  </div>
					  <!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-3 col-xs-6">
					  <div class="description-block border-right">
						<span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
						<h5 class="description-header">$24,813.53</h5>
						<span class="description-text">TOTAL PROFIT</span>
					  </div>
					  <!-- /.description-block -->
					</div>
					<!-- /.col -->
					<div class="col-sm-3 col-xs-6">
					  <div class="description-block">
						<span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
						<h5 class="description-header">1200</h5>
						<span class="description-text">GOAL COMPLETIONS</span>
					  </div>
					  <!-- /.description-block -->
					</div>
				  </div>
				  <!-- /.row -->
				</div>
				<!-- /.box-footer -->
			  </div>
			  <!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
      <!-- /.row -->

		  <!-- Main row -->
		<div class="row">
			<!-- /.col -->
			<div class="col-md-12">
			  <!-- Info Boxes Style 2 -->
			  <!-- /.info-box -->

			  <div class="box box-default">
				<!-- /.box-header -->
				<!-- /.box-body -->
				<div class="box-footer no-padding">
				  <ul class="nav nav-pills nav-stacked">
					<li><a href="#">United States of America
					  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
					<li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
					</li>
					<li><a href="#">China
					  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
				  </ul>
				</div>
				<!-- /.footer -->
			  </div>
			  <!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
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
<!--<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>-->
<!-- Bootstrap 3.3.6 -->
<script src="A_bootstrap/js/bootstrap.min.js"></script>
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

<script src="./assets/js/demo.js"></script>



<!--<script src="./plugins/datepicker/bootstrap-datepicker.js"></script>-->



<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
