<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$tbl='tbl_users';
$stmt = $user_home->runQuery("SELECT * FROM $tbl WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
//echo $row['tbl_TempSet'];
//echo $row['mac'];

/*
$tbl = $row['tbl_TempSet'];
$stmt = $user_home->runQuery("SELECT * FROM $tbl");
$stmt->execute();

$tbl_TempSet = array();
while ($_TempSet = $stmt->fetch(PDO::FETCH_ASSOC)){
	$tbl_TempSet['roomName'][] = $_TempSet['roomName'];
	//echo $_TempSet['roomName'];	
}
*/
$tbl = $row['tbl_TempSet'];
$stmt = $user_home->runQuery("SELECT * FROM $tbl");
$stmt->execute();
$tbl_TempSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Io2</b>LIFE</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
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
          <a href="#">
            <i class="fa fa-edit"></i> <span>Temp. settings</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
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
        Set Temperature
        <small>Version 2.0</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
	<form id="" action = "usersetting_3.php" method = "POST" name="">
<?php for ($x = 0; $x < (5); $x++) { ?>

		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-primary">
		
				<div class="box-header with-border">


				<div class="form-group">
					<label><?php echo $tbl_TempSet[$x][roomName]; ?></label><p></p>
					<?php echo "Room"; echo $x+1; echo "Water Temps is : "; echo $tbl_TempSet[$x][C_temp]; echo "°C"; echo " ---> Measurement Time @ "; echo $tbl_TempSet[$x][timestamp_value];?>
					<?php echo "<h5> Current Temp Settings : "; echo $tbl_TempSet[$x][L_temp]; echo "°C"; echo "</h5>"; ?>
					<input id = <?php echo $tbl_TempSet[$x][roomName];echo $x;?> 
						name = <?php echo $tbl_TempSet[$x][roomName];echo $x;?>
						type = "text";" class="form-control border-input" 
						value = "<?php echo $tbl_TempSet[$x][L_temp];?>">
				</div>
				

		
		</div>

			  
			  
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<div class="btn-group btn-group-justified" role="group" aria-label="...">
					  <div class="btn-group" role="group">
						<button TYPE="button" name="m_btn" ONCLICK="minus(<?php echo $tbl_TempSet[$x][roomName];echo $x;?>);" class="btn btn-primary btn-lg">온도내림</button>
					  </div>
					  <div class="btn-group" role="group">
						<button TYPE="button" name="p_btn" ONCLICK="plus(<?php echo $tbl_TempSet[$x][roomName];echo $x;?>);" class="btn btn-danger btn-lg">온도올림</button>	
					  </div>
					  <div class="btn-group" role="group">
						<button TYPE="button" name="zero_btn" ONCLICK="zero(<?php echo $tbl_TempSet[$x][roomName];echo $x;?>);" class="btn btn-primary btn-lg">0도설정</button>
					  </div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					  <div class="btn-group" role="group">
						<button id="save" name ="save" type=submit class="btn btn-info">설정 저장</button>
					  </div>
				</div>
			</div>
		</div>
		
				</div>
			</div>
		</div>
		
<?php } ?>
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
<script src="bootstrap/js/bootstrap.min.js"></script>
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
