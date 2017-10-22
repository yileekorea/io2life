<?php
// DB 설정
session_start();
require_once 'class.user.php';
$user_setting = new USER();

if(!$user_setting->is_logged_in())
{
	$user_setting->redirect('index.php');
}
$tbl='tbl_users';
$stmt = $user_setting->runQuery("SELECT * FROM $tbl WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$mac = $row['mac'];

$tbl = $row['tbl_TempSet'];
$stmt = $user_setting->runQuery("SELECT * FROM $tbl");
$stmt->execute();
$tbl_TempSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<!--<html lang="ko">-->
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Settings | io2Life</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">



		<script type="text/javascript">
		var ws;
        var wsUri = "ws:";
        var loc = window.location;
				var mac = "<?php echo($mac); ?>";
		//alert('<?=$mac?>');
		//alert(mac);
        console.log(loc);
        if (loc.protocol === "https:") { wsUri = "wss:"; }
        // This needs to point to the web socket in the Node-RED flow
        // ... in this case it's ws/simple
        //wsUri += "//" + loc.host + loc.pathname.replace("simple","ws/simple");
		//wsUri += "//iot2better.iptime.org:4443/ws/" + mac;
		wsUri += "//io2better.net:4443/ws/io2life";


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
		function historyBack() {
			history.back();
		}

        function doit(m) {
            if (ws) { ws.send(m); }
        }

		var Label_t;
		function getName(_Label_t) {
			Label_t = _Label_t;
            if (ws) { ws.send(JSON.stringify(Label_t)); }
			//historyBack();
		}

		</script>

    </head>


    <body onload="wsConnect();" onunload="ws.disconnect();">
<?php
//echo $tbl_TempSet[0][roomName];
if(isset($_POST['save']))
{
	$inter_temp_slide = $_POST['inter_temp_slide'];
	$acc_Count_value = $_POST['acc_Count'];
	if(isset($_POST['heatingON_OFF_slide'])){
		$heatingON_OFF_slide = 1;
	}
	else{
		$heatingON_OFF_slide = 0;
	}
	$Ltemp_array = array();
	$Label_t="{\"mac\":\"";
	$Label_t = $Label_t.$mac;
	$Label_t = $Label_t."\",";
	$Label_t = $Label_t."\"nS\":";
	$Label_t = $Label_t.$tbl_TempSet[0][numSensor];
	$Label_t = $Label_t.",";
	$Label_t = $Label_t."\"i_Timer\":";
	$Label_t = $Label_t.$inter_temp_slide;
	$Label_t = $Label_t.",";
	$Label_t = $Label_t."\"acc_Count\":";
	$Label_t = $Label_t.$acc_Count_value;
	$Label_t = $Label_t.",";
	$Label_t = $Label_t."\"hOF\":";
	$Label_t = $Label_t.$heatingON_OFF_slide;
	$Label_t = $Label_t.",";


	for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) {
	// DB에 데이터 입력
		$LtempLabel="eachTemp";
		//$LtempLabel=(String)$tbl_TempSet[$x][roomName];
		$LtempLabel = $LtempLabel.(String)$x;
		//echo $LtempLabel;

		$Ltemp_array[$x] = (float)$_POST[$LtempLabel];
		//echo $Ltemp_array[$x];

		//$stmt = $user_setting->runQuery("UPDATE $tbl SET L_temp = '$Ltemp_array[$x]', H_temp = '$Ltemp_array[$x]' where id=($x+1) ");
		//$stmt->execute();

		$ws_LtempLabel[$x] = "\"L_Temp".(String)($x+1)."\":".$Ltemp_array[$x];
		$Label_t = $Label_t.$ws_LtempLabel[$x];
		if ($x < ($tbl_TempSet[$x][numSensor]-2))
			$Label_t = $Label_t.",";
		else
			$Label_t = $Label_t."}";
//echo "<script>alert('$ws_LtempLabel[$x]');</script>";

	}
//echo "<script>alert('$Label_t');</script>";

// 처리가 완료되면 성공 메시지 보여주고 이동할 페이지로 이동
//echo "<script>alert(\"Temperature settings SAVED!\");</script>";
//echo ("<script language=javascript> getName( $Label_t );</script>");


//$user_setting->redirect('tempsettings.php');
}


else if(isset($_POST['save_rName']))
{
	for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]); $x++) {
	// DB에 데이터 입력
		$LtempLabel="rName";
		$LtempLabel = $LtempLabel.(String)$x;
		//echo $LtempLabel;

		$Ltemp_array[$x] = $_POST[$LtempLabel];
		//echo $Ltemp_array[$x];

		$stmt = $user_setting->runQuery("UPDATE $tbl SET roomName = '$Ltemp_array[$x]' where id=($x+1) ");
		$stmt->execute();

	}
//echo "<script>alert(\"All Room Name are SAVED!\");</script>";
//$user_setting->redirect('tempsettings.php');
//historyBack();
}


?>
        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">
                <div class="container">

                    <div class="row">

                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>장치 설정 | <b>io2Life</b></h3>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
                            		<p>장치에 설정을 적용하려면 아래 버튼을 누르세요...</p>
									<h2 id="header">Click</h2>

									<?php if(isset($_POST['save'])) { ?>
										<button TYPE="button"
										ONCLICK='getName(<?php echo $Label_t; ?>);
											<?php
											for ($x = 0; $x < ($tbl_TempSet[0][numSensor]-1); $x++) {
												// DB에 데이터 입력
												$LtempLabel="eachTemp";
												//$LtempLabel=(String)$tbl_TempSet[$x][roomName];
												$LtempLabel = $LtempLabel.(String)$x;
												//echo $LtempLabel;

												$Ltemp_array[$x] = (float)$_POST[$LtempLabel];
												//echo $Ltemp_array[$x];

												//$stmt = $user_setting->runQuery("UPDATE $tbl SET L_temp = '$Ltemp_array[$x]', H_temp = '$Ltemp_array[$x]', interOFFtimer = '$inter_temp_slide', heatingON_OFF = '$heatingON_OFF_slide' where id=($x+1) ");
												$stmt = $user_setting->runQuery("UPDATE $tbl SET L_temp = '$Ltemp_array[$x]', H_temp = '$Ltemp_array[$x]', interOFFtimer = '$inter_temp_slide' where id=($x+1) ");

												$stmt->execute();
											} ?>
											historyBack();' class="btn">적용하고 이전으로...</button>
									<?php } else { ?>
										<button TYPE="button" ONCLICK='historyBack();' class="btn">적용되었습니다. 이전 페이지로!</button>
									<?php } ?>
									<br></br>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <!--<script src="assets/js/scripts.js"></script>-->

        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
