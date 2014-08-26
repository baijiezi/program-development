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

if(isset($_POST['what_to_say'])) {
	// $what_to_say = $_POST['what_to_say'];
	
	// $sql = "SELECT * FROM xn_gems WHERE username = '$username' AND user_id = '$user_id' AND platform = '$platform'";
	// $result = mysqli_query($con, $sql);
	// $row = mysqli_fetch_array($result);

	// if($row){
	// 	$sql = "UPDATE xn_gems SET gems = $gems, level = $level, score = '$score'  WHERE username = '$username' AND user_id = '$user_id' AND platform = '$platform'";
	// }else{
	// 	$sql = "INSERT INTO xn_gems (username, user_id, gems, level, score, platform, created) VALUES ('$username', '$user_id', $gems, $level, '$score', '$platform', $created)";
	// }
	// $result = mysqli_query($con, $sql);

	// var_dump($sql);
	echo 'HELLO!';
}

mysqli_close($con);

?>