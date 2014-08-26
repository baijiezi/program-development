<?php

// 获取平台前20条
// 将分数写进去，返回前20条？
// $arrow_acts = array('get', 'put');

$act = isset($_GET['act'])? $_GET['act'] : 'get';

$mysql_server_name 	= 'localhost';
$mysql_username 	= 'juguang';
$mysql_password 	= 'jgled88';
$mysql_database 	= 'juguang';

$con = mysqli_connect($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);

if($act == 'new_user') {
	$sql = 'update xn_gems_users_count set users_count = users_count + 1';
	$result = mysqli_query($con, $sql);
	if($result) {
		$sql = 'SELECT users_count FROM xn_gems_users_count WHERE id = 1';
		$countResult = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($countResult);
		unset($row[0]);
		echo json_encode($row);
	}
	mysqli_close($con);
	exit();
}

if($act == 'put') {
	$username 	= $_GET['username'];
	$user_id 	= $_GET['user_id'];
	$gems 		= $_GET['gems'];
	$level 		= $_GET['level'];
	$score 		= $_GET['score'];
	$platform 	= $_GET['platform'];
	$created 	= time();

	$sql = "SELECT * FROM xn_gems WHERE username = '$username' AND user_id = '$user_id' AND platform = '$platform'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	if($row){
		$sql = "UPDATE xn_gems SET gems = $gems, level = $level, score = '$score'  WHERE username = '$username' AND user_id = '$user_id' AND platform = '$platform'";
	}else{
		$sql = "INSERT INTO xn_gems (username, user_id, gems, level, score, platform, created) VALUES ('$username', '$user_id', $gems, $level, '$score', '$platform', $created)";
	}
	$result = mysqli_query($con, $sql);

	// var_dump($sql);
}

$ret = array();
$platform 	= isset($_GET['platform']) ? $_GET['platform'] : '91';
$limit 		= isset($_GET['limit']) ? $_GET['limit'] : 20;

$sql = "SELECT * FROM xn_gems WHERE platform = '$platform' order by score DESC limit $limit";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)) {
	$record = array();
	$record['username'] 	= $row['username'];
	$record['user_id'] 		= $row['user_id'];
	$record['gems'] 		= $row['gems'];
	$record['level'] 		= $row['level'];
	$record['score'] 		= $row['score'];
	$record['platform'] 	= $row['platform'];
	array_push($ret, $record);
}
echo json_encode($ret);

mysqli_close($con);

?>