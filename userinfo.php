<title> User Infomation </title>
<?php
include 'style.html';
$userid=$_GET['userid'];
$areaid=$_GET['areaid'];
$postid=$_GET['postid'];
?>
<body>
	     <div class="flex-center position-ref full-height">
	<div class="top-right home">
                <?php
if (!$userid) {
	echo '<a href="index.php">Log in</a>';
} else {
	if($areaid){
		echo "<a href='viewPostList.php?areaid=" . $areaid . "&userid=".$userid."'>View</a>";
		echo '<a href="index.php">Log out</a>';
	}
	else if($postid){
		echo "<a href='viewPostDetail.php?postid=" . $postid . "&userid=".$userid."&areaid=" . $areaid . "'>View</a>";
		echo '<a href="index.php">Log out</a>';
	}
	else{
		echo "<a href='viewAreaList.php?userid=".$userid."'>View</a>";
		echo '<a href="index.php">Log out</a>';
	}
}?>
     </div>
</div>
<div class="note full-height">
<?php
session_start();
include "db.php";
$sql = "select * from register_user where userid = '$userid'";
$result = mysqli_query($db, $sql);
$_SESSION['userid'] = $userid = $_GET['userid'];
//從資料庫中撈留言紀錄並顯示出來
while ($row = mysqli_fetch_assoc($result)) {
        echo "<br>Name：" . $row['name'];
        echo "<br>Password：" . $row['password'];
		echo '<br><a href=" editUser.php?userid=' . $userid . '&areaid=' .$areaid.'&postid='.$postid.'">Edit User Infomation</a>';
}
?>
</div>
</body>