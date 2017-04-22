<?php
require_once 'class.user.php';
$user = new USER();

if(empty($_GET['id']) && empty($_GET['code']))
{
	$user->redirect('index.php');
}

if(isset($_GET['id']) && isset($_GET['code']))
{
	$id = base64_decode($_GET['id']);
	$code = $_GET['code'];
	
	$statusY = "Y";
	$statusN = "N";
	
	$stmt = $user->runQuery("SELECT mac,userID,userStatus FROM tbl_users WHERE userID=:uID AND tokenCode=:code LIMIT 1");
	$stmt->execute(array(":uID"=>$id,":code"=>$code));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$tbl_TempSet = "tTempSet_" . $row['mac'];
	//echo $tbl_TempSet;
	$tbl_RTemp = "tRoomTemp_" . $row['mac'];
	//echo $tbl_RTemp;
	
	if($stmt->rowCount() > 0)
	{
		if($row['userStatus']==$statusN)
		{

			$stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status, tbl_TempSet=:tTemp, tbl_RoomTemp=:tRTemp, timestamp_value=now() WHERE userID=:uID");
			//$stmt = $user->runQuery("UPDATE tbl_users SET userStatus=:status, timestamp_value=now() WHERE userID=:uID");
			$stmt->bindparam(":status",$statusY);
			$stmt->bindparam(":uID",$id);
			$stmt->bindparam(":tTemp",$tbl_TempSet);
			$stmt->bindparam(":tRTemp",$tbl_RTemp);
			$stmt->execute();

			$stmt = $user->runQuery("CREATE TABLE IF NOT EXISTS `$tbl_TempSet` (
									  `id` INT UNSIGNED NOT NULL,
									  `numSensor` INT UNSIGNED NOT NULL,
									  `roomName` VARCHAR(16) NOT NULL DEFAULT 'RoomName',
									  `L_temp` float(4) DEFAULT NULL,
									  `C_temp` float(4) DEFAULT NULL,
									  `H_temp` float(4) DEFAULT NULL,
									  `roomStatus` float(4) DEFAULT NULL,
									  `timestamp_value` datetime DEFAULT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;
									");
			$stmt->execute();

			for ($x = 1; $x < (11); $x++) {
			$stmt = $user->runQuery("INSERT INTO `$tbl_TempSet` (
									  `id`, `numSensor`, `roomName`,`L_temp`,`C_temp`,`H_temp`,`roomStatus`,`timestamp_value`) 
										VALUE ($x, 0, 'RoomName', 25, 25, 25, 0, now());
									");
			$stmt->execute();
			}	
	
			$stmt = $user->runQuery("CREATE TABLE IF NOT EXISTS `$tbl_RTemp` (
									  `id` INT UNSIGNED NOT NULL,
									  `timestamp_value` datetime DEFAULT NULL,
									  `current_temps` float(4) DEFAULT NULL,
									  `sensor_name` VARCHAR(40) DEFAULT NULL,
									  `current_status` float(4) DEFAULT NULL
									) ENGINE=InnoDB DEFAULT CHARSET=latin1;
									");
			$stmt->execute();

			$msg = "
		           <div class='alert alert-success'>
				   <button class='close' data-dismiss='alert'>&times;</button>
				   <h2><strong>축하합니다 !</strong><br>  등록하신 계정은 이제 사용가능합니다! <a href='index.php'>여기서 로그인...</a><h2>
			       </div>
			       ";	
		}
		else
		{
			$msg = "
		           <div class='alert alert-error'>
				   <button class='close' data-dismiss='alert'>&times;</button>
				   <h2><strong>다시 확인해 주세요 !</strong><br>  계정이 이미 사용 가능한 상태 입니다! <a href='index.php'>여기서 로그인...</a></h2>

			       </div>
			       ";
		}
	}
	else
	{
		$msg = "
		       <div class='alert alert-error'>
			   <button class='close' data-dismiss='alert'>&times;</button>
			   <h2><strong>sorry !</strong><br>  관련된 계정 정보를 찾을 수 없습니다 : <a href='signup.php'>여기서 새로 등록...</a></h2>
			   </div>
			   ";
	}

}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Confirm Registration</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">

		<?php if(isset($msg)) { echo $msg; } ?>
		
    </div> <!-- /container -->

    <script src="vendors/jquery-1.9.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>