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

$tbl = $row['tbl_RoomTemp'];
$stmt = $temp_set->runQuery("SELECT timestamp_value, current_temps, accCount FROM $tbl WHERE id=1 order by timestamp_value desc limit 1");
$stmt->execute();
$tbl_TempSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
$acc_Count = $tbl_TempSet[0][accCount];

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
$numSensors = 0;
for ($x = 0; $x < 10; $x++) {
	if ($numSensors < $tbl_TempSet[$x][numSensor]){
		$numSensors = $tbl_TempSet[$x][numSensor];
	}
}

$interOFFtimer = $tbl_TempSet[0][interOFFtimer];

$heatingON_OFF = $tbl_TempSet[0][heatingON_OFF];

/*
$returned_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($returned_results as $key=>$result) {
     //echo "<pre>"; var_dump($result); echo "</pre>";
     var_dump($result);
}
*/


?>

<SCRIPT LANGUAGE="JavaScript">
/*
        var ws;
        var wsUri = "ws:";
        var loc = window.location;
        console.log(loc);
        if (loc.protocol === "https:") { wsUri = "wss:"; }
        // This needs to point to the web socket in the Node-RED flow
        // ... in this case it's ws/simple
        //wsUri += "//" + loc.host + loc.pathname.replace("simple","ws/simple");
		wsUri += "//iot2better.iptime.org:443/ws/simple";


        function wsConnect() {
            console.log("connect",wsUri);
            ws = new WebSocket(wsUri);
            //var line = "";    // either uncomment this for a building list of messages
            ws.onmessage = function(msg) {
                var line = "";  // or uncomment this to overwrite the existing message
                // parse the incoming message as a JSON object
                var data = msg.data;
                //console.log(data);
                // build the output from the topic and payload parts of the object
                line += "<p>"+data+"</p>";
                // replace the messages div with the new "line"
                //document.getElementById('messages').innerHTML = line;
                //ws.send(JSON.stringify({data:data}));
            }
            ws.onopen = function() {
                // update the status div with the connection status
                document.getElementById('status').innerHTML = "connected";
                //ws.send("Open for data");
                console.log("connected");
            }
            ws.onclose = function() {
                // update the status div with the connection status
                document.getElementById('status').innerHTML = "not connected";
                // in case of lost connection tries to reconnect every 3 secs
                setTimeout(wsConnect,3000);
            }
        }

		var Label_t;
		function getName(_Label_t) {
			Label_t = _Label_t;
            if (ws) { ws.send(Label_t); }
		}


        function doit(m) {
            if (ws) { ws.send(m); }
        }
*/



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
  <title>Io2Life | TempSetting</title>
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
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="plugins/bootstrap-slider/slider.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--<body class="hold-transition skin-blue sidebar-mini" onload="wsConnect();" onunload="ws.disconnect();">-->
<body class="hold-transition skin-blue sidebar-mini" >

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Io2</b>Life</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
		  <a href="#" class="sidebar-toggle col-xs-3" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		  </a>
      <!-- Navbar Right Menu -->
      <!--<div class="navbar-custom-menu">-->
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

        <li class="active treeview">
          <a href="tempsettings.php">
            <i class="fa fa-edit"></i> <span>온도 설정</span>
          </a>
        </li>
        <li class="treeview">
          <a href="roomlabel.php">
            <i class="fa fa-table"></i> <span>방 이름설정</span>
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
			<?php for ($x = 0; $x < ($numSensors-1); $x++) { ?>

				<li class=""><a href="each_room.php?roomParam=<?php echo $x+1; ?>">
					<i class="fa fa-circle-o"></i> <?php echo '(방'; echo $x+1; echo ') '; echo $tbl_TempSet[$x][roomName]; ?> 그래프</a></li>

			<?php } ?>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>실시간 온도</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<?php for ($x = 0; $x < ($numSensors-1); $x++) { ?>

				<li class=""><a href="realtime.php?roomParam=<?php echo $x+1; ?>">
					<i class="fa fa-circle-o"></i> <?php echo $tbl_TempSet[$x][roomName]; ?>의 실시간 온도</a></li>

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
        각방 온도 설정
        <small>기기 번호  <?php echo $row['mac']; ?></small>
      </h1>
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
	<form id="save" action = "usersetting_4.php" method = "POST" name="save">
	<div class="row">
		<div class="col-sm-6">
			<p>

				<div class="box-header with-border">
					<label class="checkbox-inline">
					  <h4><input id="heatingON_OFF_slide" name="heatingON_OFF_slide" type="checkbox" value=""
							<?php
							//echo $heatingON_OFF;
							if( $heatingON_OFF == 1 ){
								echo "checked";
							}else{
								echo "";
							}
							?>
							data-toggle="toggle" data-width="100" data-onstyle="danger" data-offstyle="info">  <b>--> 시스템 상태 입니다...</b></h4>
							<div id="console-event"></div>

					</label>
				</div>

				<div class="box-header with-border">
					<h3 class="box-title"><b><?php echo " 현재 계량값 : "; echo $acc_Count; echo " m³"; ?></b></h3><br></br>
					<?php echo "<h4> 새로운 계량값을 입력 하세요... "; echo "단위는 m³ 입니다."; echo "</h4>"; ?>
				</div>
			  <input id="acc_Count" name="acc_Count" type="text" value="<?php echo $acc_Count;?>" class="form-control" placeholder="Enter ...">
			<p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<p>
			<p>
			<h3><span class="label label-Default" id="ex6CurrentSliderValLabel">현재 순환 주기 : <span id="ex6SliderVal"><?php echo $interOFFtimer; ?></span> min</span></h3>
			<br>
			<input id="inter_temp_slide" name="inter_temp_slide" type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="61" data-slider-step="1" data-slider-value="<?php echo $interOFFtimer;?>" data-slider-orientation="horizontal" data-slider-selection="before" data-slider-tooltip="show" data-slider-id="red">
			<br>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				  <div class="btn-group" role="group">
					<button id="save"
					name ="save" type=submit class="btn btn-default"><i class="fa fa-floppy-o"></i>  설정 저장</button>
				  </div>
			</div>
		</div>
	</div>

<?php $Label_t="{"; ?>
<?php for ($x = 0; $x < ($numSensors-1); $x++) { ?>
    <!-- Main content -->
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			  <!-- general form elements -->
			  <div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"><b><?php echo $tbl_TempSet[$x][roomName]; ?></b></h3><br></br>
					<?php echo "Room-"; echo $x+1; echo " 현재 온도는 : "; echo $tbl_TempSet[$x][C_temp]; echo "°C   "
					; echo "..... 마지막 측정 시각 :  "; echo $tbl_TempSet[$x][timestamp_value];?>
					<?php echo "<h4> 설정된 온도 : "; echo $tbl_TempSet[$x][L_temp]; echo "°C"; echo "</h4>"; ?>
				</div>
				<!-- /.box-header -->

				<!-- form start -->
				<!--<form role="form">-->
					<div class="box-body">
<!--
						<div class="input-group">
							<span class="input-group-addon"><?php echo "Room -";echo $x+1; echo " name" ?> </span>
							<input type="text" class="form-control" placeholder="거실">
						</div>
						<br>
-->
						<div class="input-group input-group-md">
							<input id = <?php echo "eachTemp";echo $x;?>
									name = <?php echo "eachTemp";echo $x;?>
									type = "text";" class="form-control border-input"
									value = "<?php echo $tbl_TempSet[$x][L_temp];?>">
								<span class="input-group-btn">
									<!--<button type="submit" id="save" name ="save" class="btn btn-info btn-flat">기본 설정</button>-->
									<button TYPE="button" name="d_btn" ONCLICK="basic(<?php echo "eachTemp";echo $x;?>);" class="btn btn-info btn-flat"><i class="fa  fa-fire"></i> 기본 온도 설정 ( 28 °C )</button>
								</span>
						</div>

						<!-- /.box-body -->
						<div class="box-footer">
						</div>
						<div class="pull-left">
							<div class="form-group">
								<div class="btn-group btn-group-justified" role="group" aria-label="...">
								  <div class="btn-group" role="group">
									<button TYPE="button" name="m_btn" ONCLICK="minus(<?php echo "eachTemp";echo $x;?>);" class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-down"></i> 온도내림</button>
								  </div>
								  <div class="btn-group" role="group">
									<button TYPE="button" name="p_btn" ONCLICK="plus(<?php echo "eachTemp";echo $x;?>);" class="btn btn-danger btn-md"><i class="fa  fa-arrow-circle-up"></i> 온도올림</button>
								  </div>
								  <div class="btn-group" role="group">
									<button TYPE="button" name="zero_btn" ONCLICK="zero(<?php echo "eachTemp";echo $x;?>);" class="btn btn btn-default btn-md"><i class="fa fa-arrow-circle-right"></i> 0 °C 설정</button>
								  </div>
								</div>
							</div>



							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										  <div class="btn-group" role="group">
											<button id="save"
											name ="save" type=submit class="btn btn-default"><i class="fa fa-floppy-o"></i>  설정 저장</button>
										  </div>
									</div>
								</div>
							</div>

<!--
<button type="button" onclick='doit("click");'>Click to send message</button>
<hr/>
onclick='doit(
											"{"+eachTemp0.value+","
											+eachTemp1.value+","
											+eachTemp2.value+","
											+eachTemp6.value+"}"
											);'
<div id="status">unknown</div>
-->
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
<!--<script src="dist/js/pages/dashboard2.js"></script>-->

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Bootstrap slider -->
<script src="plugins/bootstrap-slider/bootstrap-slider.js"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
  $(function() {
    $('#heatingON_OFF_slide').change(function() {
      $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    })
  })
</script>


<script>
$("#inter_temp_slide").on("slide", function(slideEvt) {
	$("#ex6SliderVal").text(slideEvt.value);

});
$("#inter_temp_slide").on("slideStart", function(slideEvt) {
	$("#ex6SliderVal").text(slideEvt.value);

});



  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').slider();

    /* ION SLIDER */
    $("#range_1").ionRangeSlider({
      min: 0,
      max: 5000,
      from: 1000,
      to: 4000,
      type: 'double',
      step: 1,
      prefix: "$",
      prettify: false,
      hasGrid: true,
	  tooltip: 'always'
    });
    $("#range_2").ionRangeSlider();

    $("#range_5").ionRangeSlider({
      min: 0,
      max: 10,
      type: 'single',
      step: 0.1,
      postfix: " mm",
      prettify: false,
      hasGrid: true
    });
    $("#range_6").ionRangeSlider({
      min: -50,
      max: 50,
      from: 0,
      type: 'single',
      step: 1,
      postfix: "°",
      prettify: false,
      hasGrid: true
    });

    $("#range_4").ionRangeSlider({
      type: "single",
      step: 100,
      postfix: " light years",
      from: 55000,
      hideMinMax: true,
      hideFromTo: false
    });
    $("#range_3").ionRangeSlider({
      type: "double",
      postfix: " miles",
      step: 10000,
      from: 25000000,
      to: 35000000,
      onChange: function (obj) {
        var t = "";
        for (var prop in obj) {
          t += prop + ": " + obj[prop] + "\r\n";
        }
        $("#result").html(t);
      },
      onLoad: function (obj) {
        //
      }
    });
  });
</script>
</body>
</html>
