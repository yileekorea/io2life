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

<html lang="ko">
<head>
<style type="text/css" >
#wrapper {
    width:500px;
    margin : 0 auto ;
}
</style>

<script type="text/javascript">
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
			historyBack();
		}



</script>

    <link href="assets/css/button.min.css" rel="stylesheet" />
</head>

<?php
//echo $tbl_TempSet[0][roomName];
if(isset($_POST['save']))
{
$Ltemp_array = array();
$Label_t="{\"mac\":\"";
$Label_t = $Label_t.$mac;
$Label_t = $Label_t."\",";
$Label_t = $Label_t."\"nS\":";
$Label_t = $Label_t.$tbl_TempSet[0][numSensor];
$Label_t = $Label_t.",";

	for ($x = 0; $x < ($tbl_TempSet[$x][numSensor]-1); $x++) {
	// DB에 데이터 입력
		$LtempLabel="eachTemp";
		//$LtempLabel=(String)$tbl_TempSet[$x][roomName];
		$LtempLabel = $LtempLabel.(String)$x;
		//echo $LtempLabel;

		$Ltemp_array[$x] = (float)$_POST[$LtempLabel];
		//echo $Ltemp_array[$x];

		$stmt = $user_setting->runQuery("UPDATE $tbl SET L_temp = '$Ltemp_array[$x]', H_temp = '$Ltemp_array[$x]' where id=($x+1) ");
		$stmt->execute();
		
		$ws_LtempLabel[$x] = "\"L_Temp".(String)($x+1)."\":".$Ltemp_array[$x];
		$Label_t = $Label_t.$ws_LtempLabel[$x];
		if ($x < ($tbl_TempSet[$x][numSensor]-2)) 
			$Label_t = $Label_t.",";
		else
			$Label_t = $Label_t."}";
//echo "<script>alert('$ws_LtempLabel[$x]');</script>";
	}
//echo "<script>alert('$Label_t');</script>";
//echo ("<script language=javascript> getName($Label_t);</script>");

// 처리가 완료되면 성공 메시지 보여주고 이동할 페이지로 이동
//echo "<script>alert(\"Temperature settings SAVED!\");</script>";

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
echo "<script>alert(\"All Room Name are SAVED!\");</script>";
//$user_setting->redirect('tempsettings.php');

}


?>

<body onload="wsConnect();" onunload="ws.disconnect();">

<br></br>
<br></br>

	<div id="wrapper" class="text-center">
		<!--<button TYPE="button" ONCLICK="historyBack();" class='button_historyback'>Go back to previous page!</button>-->
		<?php echo $mac; ?>
		<?php echo $Label_t; ?>

		<?php if(isset($_POST['save'])) { ?>
		<button TYPE="button" ONCLICK='getName(<?php echo $Label_t; ?>);' class='button_historyback'>Apply and back to previous page!</button>
		<?php } else { ?>
		<button TYPE="button" ONCLICK='historyBack();' class='button_historyback'>Back to previous page!</button>		
		<?php } ?>		
	</div>

</body>
</html>


