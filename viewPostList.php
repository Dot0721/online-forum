<title>All messages</title>
<?php
include 'style.html';
$userid = $_GET['userid'];
$areaid=$_GET['areaid'];
?>
<body>
	<div class="flex-center position-ref full-height">
	<div class="top-right home">
                <?php
if (!$userid) {
	echo "<a href='viewAreaList.php?userid=0'>Last page </a>";
	echo '<a href="index.php">Log in</a>';
	
} else {
	echo "<a href='board.php?userid=" . $userid . "&areaid=". $areaid ."'>Write some messages</a>";
	echo "<a href='viewAreaList.php?userid=". $userid . "'>Last page </a>";
	echo '<a href="index.php">Log out</a>';
}?>
     </div>
	 <div class="top-left home">
		<?php
			if($userid){
				echo "<a href='userinfo.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=0'>User</a>";
			}
		?>
	 </div>


</div>
	<div class="PostList post full-height">
<?php
session_start();
include "db.php";
$sql = "select * from post where aid=$areaid";
$result = mysqli_query($db, $sql);
$_SESSION['userid'] = $userid = $_GET['userid'];
//從資料庫中撈留言紀錄並顯示出來
while ($row = mysqli_fetch_assoc($result)) {
    $postname=$row['postname'];
    $postid=$row['postid'];
	//echo "<br>Subject：" . $row['subject'];
    echo "<a href='viewPostDetail.php?postid=$postid&userid=$userid&areaid=$areaid'>$postname</a>";
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