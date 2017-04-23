<?php
session_start();
require_once 'class.user.php';
$temp_set = new USER();

if(!$temp_set->is_logged_in())
{
	$temp_set->redirect('index.php');
}
$tbl='tbl_users';
$stmt = $temp_set->runQuery("SELECT * FROM $tbl WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $row['tbl_TempSet'];
//echo $row['mac'];

/*
$tbl = $row['tbl_TempSet'];
$stmt = $temp_set->runQuery("SELECT * FROM $tbl");
$stmt->execute();

$tbl_TempSet = array();
while ($_TempSet = $stmt->fetch(PDO::FETCH_ASSOC)){
	$tbl_TempSet['roomName'][] = $_TempSet['roomName'];
	//echo $_TempSet['roomName'];	
}
*/
$tbl = $row['tbl_TempSet'];
$stmt = $temp_set->runQuery("SELECT * FROM $tbl");
$stmt->execute();
$tbl_TempSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
$numSensors = $tbl_TempSet[0][numSensor];
/*
$returned_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($returned_results as $key=>$result) {
     //echo "<pre>"; var_dump($result); echo "</pre>";
     var_dump($result);
}
*/
?>
<SCRIPT LANGUAGE="JavaScript">
  <!--
  function plus(obj)
  {
	  //alert(obj.value);

    if (parseInt(obj.value) < 1000)
    {
		var a=obj.value;
		console.log(a);
		var b=0.5;
		console.log(b);
		var T=Number('1e'+1);
		console.log(T);

		var z = (Math.round(a * T) + Math.round(b * T)) / T;
	//	var z = (Math.round(num1 * cz1) - Math.round(num2 * cz2)) / cz;
		obj.value=z;
		console.log(z);
		//alert(obj.value);
    }
  }

  function minus(obj)
  {
	  	//alert(obj.value);
    if (parseInt(obj.value) < 1000)
    {
		var a=obj.value;
		console.log(a);
		var b=0.5;
		console.log(b);
		var T=Number('1e'+1);
		console.log(T);

		var z = (Math.round(a * T) - Math.round(b * T)) / T;
		obj.value=z;
		console.log(z);
		//alert(obj.value);
    }
  }

function zero(obj)
  {
	  	//alert(obj.value);
    if (parseInt(obj.value) < 1000)
    {
		obj.value=0;
		console.log(z);
		//alert(obj.value);
    }
  }

function basic(obj)
  {
	  	//alert(obj.value);
    if (parseInt(obj.value) < 1000)
    {
		obj.value=28;
		console.log(z);
		//alert(obj.value);
    }
  }
 
  function frm_submit()
  {
    var frm = document.goFrm;
    frm.a_btn_val.value = frm.a_btn.value;
	//    frm.submit();
  }
  //-->
</SCRIPT>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Io2Life | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="A_bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!--<span class="hidden-xs"><?php echo $row['userEmail']; ?></span>-->
              <span><?php echo $row['userEmail']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->

              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  <?php echo $row['userEmail']; ?>
                  <small>기기 번호 : <?php echo $row['mac']; ?></small>
                  <small>회원가입 since <?php echo $row['timestamp_value']; ?></small>
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
      <!--</div>-->
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
            <i class="fa fa-dashboard"></i> <span>전체 정보</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i> 
            <span>온도 그래프</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) { ?>

				<li class=""><a href="each_room.php?roomParam=<?php echo $x+1; ?>">
					<i class="fa fa-circle-o"></i> <?php echo '(방'; echo $x+1; echo ') '; echo $tbl_TempSet[$x][roomName]; ?> 그래프</a></li>
			
			<?php } ?>
          </ul>
        </li>

        <li class="treeview">
          <a href="tempsettings.php">
            <i class="fa fa-edit"></i> <span>온도 설정</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="roomlabel.php">
            <i class="fa fa-table"></i> <span>방 이름설정</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>실시간 온도</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) { ?>

				<li class=""><a href="realtime.php?roomParam=<?php echo $x+1; ?>">
					<i class="fa fa-circle-o"></i> 실시간 <?php echo $tbl_TempSet[$x][roomName]; echo $x+1; ?> 온도</a></li>
			
			<?php } ?>


          </ul>
        </li>
        <li class="header">CONTROL STATUS Info.</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>난방중 상태</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>대기 상태</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        각방 이름설정
        <small>기기 번호  <?php echo $row['mac']; ?></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
	<form id="save_rName" action = "usersetting_4.php" method = "POST" name="save_rName">
<?php for ($x = 0; $x < ($numSensors-1); $x++) { ?>
    <!-- Main content -->
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-success">
				<div class="box-header with-border">
					<h3 class="box-title"><b><?php echo $tbl_TempSet[$x][roomName]; ?></b></h3><br></br>
					<?php echo "Room-"; echo $x+1; echo " 현재 온도는 : "; echo $tbl_TempSet[$x][C_temp]; echo "°C   "
					; echo "..... 마지막 측정 시각 :  "; echo $tbl_TempSet[$x][timestamp_value];?>
					<?php echo "<h5> 현재 설정된 온도 : "; echo $tbl_TempSet[$x][L_temp]; echo "°C"; echo "</h5>"; ?>
				</div>
				<!-- /.box-header -->
				
				<!-- form start -->
				<!--<form role="form">-->
					<div class="box-body">

						<div class="input-group">
							<span class="input-group-addon" ><?php echo "Room - ";echo $x+1; echo " Name" ?> </span>
							<input type="text" class="form-control" placeholder="거실" value = "<?php echo $tbl_TempSet[$x][roomName];?>" disabled>
							<input id = <?php echo "rName";echo $x;?> 
									name = <?php echo "rName";echo $x;?>
									type = "text";" class="form-control" 
									placeholder="거실" 
									value = "<?php echo $tbl_TempSet[$x][roomName];?>">
						</div>
						<br>

						<!-- /.box-body -->
						<div class="box-footer">
						</div>
						<div class="pull-left">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										  <div class="btn-group" role="group">
											<button id="save_rName" name ="save_rName" type=submit class="btn btn-default"><i class="fa fa-floppy-o"></i>  설정 저장</button>
										  </div>
									</div>
								</div>
							</div>
						</div>
<!--							
						<div class="pull-left">
							<button id="save" name ="save" type=submit class="btn btn-default margin-bottom btn-lg"><i class="fa fa-floppy-o"></i> 설정 저장</button>
						</div>
-->
					</div>
				<!--</form>-->
			  </div>
			  <!-- /.box -->
			</div>
		</div>
<?php } ?>

		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-warning">
				<div class="box-header with-border">
					<h3 class="box-title"><b><?php echo $tbl_TempSet[$numSensors-1][roomName]; ?></b></h3><br></br>
					<?php echo "공급온수 -"; echo $numSensors; echo " 현재 온도는 : "; echo $tbl_TempSet[$numSensors-1][C_temp]; echo "°C   "
					; echo "..... 마지막 측정 시각 :  "; echo $tbl_TempSet[$numSensors-1][timestamp_value];?>
				</div>
				<!-- /.box-header -->
				
				<!-- form start -->
				<!--<form role="form">-->
					<div class="box-body">

						<div class="input-group">
							<span class="input-group-addon" ><?php echo "들어오는 물 "; echo " 이름 ?" ?> </span>
							<input type="text" class="form-control" placeholder="거실" value = "<?php echo $tbl_TempSet[$numSensors-1][roomName];?>" disabled>
							<input id = <?php echo "rName";echo $numSensors-1;?> 
									name = <?php echo "rName";echo $numSensors-1;?>
									type = "text";" class="form-control" 
									placeholder="거실" 
									value = "<?php echo $tbl_TempSet[$numSensors-1][roomName];?>">
						</div>
						<br>

						<!-- /.box-body -->
						<div class="box-footer">
						</div>
						<div class="pull-left">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										  <div class="btn-group" role="group">
											<button id="save_rName" name ="save_rName" type=submit class="btn btn-default"><i class="fa fa-floppy-o"></i>  설정 저장</button>
										  </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!--</form>-->
			  </div>
			  <!-- /.box -->
			</div>
		</div>
		
		

	</form>
		
  
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
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
