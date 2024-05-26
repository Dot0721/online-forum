
<title>All messages</title>
<?php
include "db.php";
include 'style.html';
$userid = $_GET['userid'];
?>
<body>
	<div class="flex-center position-ref full-height">
	<div class="top-right home">
                <?php
if (!$userid) {
	echo '<a href="index.php">Log in</a>';
} else {
	//echo "<a href='board.php?name=" . $name . "'>Write some messages</a>";
	$sql ="select * from register_user where userid=$userid";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_assoc($result);
	echo "<a href='viewAreaList.php?userid=". $userid . "'>view </a>";
	if($row['permission_level']==3){
		echo "<a href='createArea.php?userid=" . $userid . "'>Create Area</a>";
	}
	echo '<a href="index.php">Log out</a>';
}?>
     </div>
	 <div class="top-left home">
		<?php
			if($userid){
				echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'>User</a>";
			}
		?>
	 </div>
</div>
	<div class="PostList post full-height">
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
    echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'>$areaname</a>";
	echo " <a href='collectArea.php?areaid=$areaid&userid=$userid'><img src='star.png' alt='Button' style='width:20px;height:20px;border:0;'></a>";
    echo "<br>";
	echo "<hr>";
}/*
echo "<br>";
echo '<div class="bottom left position-abs content">';
echo "There are " . mysqli_num_rows($result) . " messages.";*/
?>
</div>
</body>

</html>