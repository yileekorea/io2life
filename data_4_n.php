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

//mysql> describe tRoomTemp_5CCF7F23D7F8;
//+-----------------+------------------+------+-----+---------+-------+
//| Field           | Type             | Null | Key | Default | Extra |
//+-----------------+------------------+------+-----+---------+-------+
//| id              | int(10) unsigned | NO   |     | NULL    |       |
//| timestamp_value | datetime         | YES  |     | NULL    |       |
//| current_temps   | float            | YES  |     | NULL    |       |
//| sensor_name     | varchar(16)      | YES  |     | NULL    |       |
//| current_status  | float            | YES  |     | NULL    |       |
//+-----------------+------------------+------+-----+---------+-------+
//echo "<script>alert(\"tbl_RoomTemp.....1\");</script>";
$tbl = $row['tbl_RoomTemp'];



$row_a = array();
$row_a[0]['num_sensors'] = $tbl_TempSet[0]['numSensor'];

//for ($x = 0; $x < ($tbl_TempSet[$x]['numSensor']); $x++) {
for ($x = 0; $x < ($tbl_TempSet[0]['numSensor']); $x++) {
	if (isset($_GET["dateParam"])) {
		$stmt = $data_4_n->runQuery("SELECT timestamp_value, current_temps FROM $tbl WHERE id=$x+1 AND timestamp_value LIKE '".$_GET["dateParam"]."%'");
		//$stmt = $data_4_n->runQuery("SELECT timestamp_value, current_temps FROM $tbl WHERE id=$x+1 AND timestamp_value LIKE '".date('Y-m-d')."%'");
	} else {
		//$stmt = $data_4_n->runQuery("SELECT timestamp_value, current_temps FROM $tbl WHERE id=$x+1 AND timestamp_value LIKE '".date('Y-m-d')."%'");
		$stmt = $data_4_n->runQuery("SELECT timestamp_value, current_temps FROM $tbl WHERE id=$x+1 AND timestamp_value > (now() - interval 1 day)");
	}
	$stmt->execute();

	$row_a[$x]['name'] = $tbl_TempSet[$x]['roomName'];
	while ($tbl_RoomTemp = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$strTime = strtotime($tbl_RoomTemp['timestamp_value']);
		$strTime = $strTime *1000;
		//$strTime = $strTime -(8.5*3600);
		$row_a[$x]['data'][] = array($strTime, $tbl_RoomTemp['current_temps']);
	}
//	$tbl_RoomTemp = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
	
echo(json_encode($row_a, JSON_NUMERIC_CHECK));
//print json_encode($row_a, JSON_NUMERIC_CHECK);

?>


