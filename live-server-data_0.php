<?php
// DB 설정
session_start();
require_once 'class.user.php';
$data_4_n = new USER();

if(!$data_4_n->is_logged_in())
{
	$data_4_n->redirect('index.php');
}

//mysql> describe tbl_users;
//+--------------+---------------+------+-----+---------+----------------+
//| Field        | Type          | Null | Key | Default | Extra          |
//+--------------+---------------+------+-----+---------+----------------+
//| userID       | int(11)       | NO   | PRI | NULL    | auto_increment |
//| mac          | varchar(20)   | NO   |     | NULL    |                |
//| userName     | varchar(100)  | NO   |     | NULL    |                |
//| userEmail    | varchar(100)  | NO   | UNI | NULL    |                |
//| userPass     | varchar(100)  | NO   |     | NULL    |                |
//| userStatus   | enum('Y','N') | NO   |     | N       |                |
//| tokenCode    | varchar(100)  | NO   |     | NULL    |                |
//| tbl_TempSet  | varchar(100)  | YES  |     | NULL    |                |
//| tbl_RoomTemp | varchar(100)  | YES  |     | NULL    |                |
//+--------------+---------------+------+-----+---------+----------------+
$tbl='tbl_users';
$stmt = $data_4_n->runQuery("SELECT * FROM $tbl WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//mysql> describe tTempSet_5CCF7F23D7F8;
//+-----------------+------------------+------+-----+---------+-------+
//| Field           | Type             | Null | Key | Default | Extra |
//+-----------------+------------------+------+-----+---------+-------+
//| id              | int(10) unsigned | NO   |     | NULL    |       |
//| roomName        | varchar(16)      | YES  |     | NULL    |       |
//| L_temp          | float            | YES  |     | NULL    |       |
//| C_temp          | float            | YES  |     | NULL    |       |
//| H_temp          | float            | NO   |     | NULL    |       |
//| roomStatus      | enum('Y','N')    | NO   |     | N       |       |
//| timestamp_value | datetime         | NO   |     | NULL    |       |
//+-----------------+------------------+------+-----+---------+-------+
$tbl = $row['tbl_TempSet'];
$stmt = $data_4_n->runQuery("SELECT * FROM $tbl");
$stmt->execute();
$tbl_TempSet = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET["roomParam"])) {
	$room_x = $_GET["roomParam"];

	
	$x = time() * 1000;
	$x += ((3600000*9));	// + (3600000/2));
	$y = $tbl_TempSet[$room_x-1]['C_temp'];

	// Create a PHP array and echo it as JSON
	$ret = array($x, $y);

	echo(json_encode($ret, JSON_NUMERIC_CHECK));
	//echo "<script>alert(\"CSV files are READY!\");</script>";
}

/*
$result = mysql_query("SELECT * FROM temperature");
$RName = array();
while ($ra = mysql_fetch_array($result)) {
	$RName['id'][] = $ra[id];
	$RName['Rname'][] = $ra[name];
	$RName['L_temp'][] = $ra[L_temp];
	$RName['C_temp'][] = $ra[C_temp];
	$RName['H_temp'][] = $ra[H_temp];
	$RName['Rstatus'][] = $ra[room_status];
	$RName['timestamp_value'][] = $ra[timestamp_value];
}

// The x value is the current JavaScript time, which is the Unix time multiplied 
// by 1000.
$x = time() * 1000;
$x = $x + (3600000/2);
$y = $RName['C_temp'][0];

// Create a PHP array and echo it as JSON
$ret = array($x, $y);
//echo json_encode($ret);
echo(json_encode($ret, JSON_NUMERIC_CHECK));

//$result = array();
//array_push($result, $row_a);
mysql_close($con);
*/
?>