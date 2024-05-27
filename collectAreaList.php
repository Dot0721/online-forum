<html>

<title> All messages </title>

<?php
include "db.php";
$userid = $_GET['userid'];
?>

<style>
	div {
		text-align: center;
		position: relative;
		top: 120px;
	}
	.logout {
        width: 100px;
        height: 50px;
        color: white;
		font-size: 16px;
        background: black;
        border-radius: 5px;
        position: absolute;
        top: 40px;
        right: 60px;
    }
	.account {
		width: 100px;
        height: 50px;
		font-size: 16px;
		background: none;
		border: none;
        position: absolute;
        top: 40px;
        right: 180px;
	}
	.createarea {
		width: 110px;
        height: 50px;
		font-size: 16px;
		background: none;
		border: none;
        position: absolute;
        top: 40px;
        right: 300px;
	}
	.bubbles {
		width: 100px;
        height: 50px;
		font-size: 16px;
		background: none;
		border: none;
        position: absolute;
        top: 40px;
        left: 20px;
	}
</style>
<body>

<?php
if (!$userid) {
	echo '<a href="index.php">Log in</a>';
}
else {
	//echo "<a href='board.php?name=" . $name . "'>Write some messages</a>";
	$sql ="select * from register_user where userid=$userid";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_assoc($result);
	echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
	if($row['permission_level']==3){
		echo "<a href='createArea.php?userid=" . $userid . "'> <button class='createarea'> <b> Create Area </b> </button> </a>";
	}
	echo '<a href="index.php"> <button class="logout"> <b> Log out </b> </button> </a>';
}
?>

<?php
	if($userid){
		echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
	}
?>

<div>
	<?php
	$sql = "SELECT * 
	FROM post_area pa
	JOIN collect_area ca ON pa.areaid = ca.aid
	WHERE ca.uid = $userid";
	$result = mysqli_query($db, $sql);
	//從資料庫中撈留言紀錄並顯示出來
	while ($row = mysqli_fetch_assoc($result)) {
		$areaname=$row['areaname'];
		$areaid=$row['areaid'];
		//echo "<br>Subject：" . $row['subject'];
			echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'> $areaname </a>";
			echo "<a href='collectArea.php?areaid=$areaid&userid=$userid'> <img src='star.png' alt='Button' style='width:20px;height:20px;border:0;'> </a>";
			echo "<br>";
			echo "<hr>";
		}
		/*
		echo "<br>";
		echo '<div class="bottom left position-abs content">';
		echo "There are " . mysqli_num_rows($result) . " messages.";
		*/
	?>
</div>
</body>

</html>