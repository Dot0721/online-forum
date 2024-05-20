<title>All messages</title>
<?php
include 'style.html';
$postid=$_GET['postid'];
$userid=$_GET['userid'];
$areaid=$_GET['areaid'];
?>
<body>
	     <div class="flex-center position-ref full-height">
	<div class="top-right home">
                <?php
	echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'>Last page</a>";
	echo '<a href="index.php">Log out</a>';
?>
     </div>
	 <div class="top-left home">
		<?php
			if($userid){
				echo "<a href='userinfo.php?userid=" . $userid . "&areaid=$areaid&postid=".$postid."'>User</a>";
			}
		?>
	 </div>


</div>
<div class="note full-height">
<?php
session_start();
include "db.php";
$sql = "select * from post where postid = $postid";
$result = mysqli_query($db, $sql);
$_SESSION['userid'] = $userid = $_GET['userid'];
//從資料庫中撈留言紀錄並顯示出來
while ($row = mysqli_fetch_assoc($result)) {
	$postname=$row['postname'];
	$article=$row['article'];
	$uid=$row['uid'];
	$mysql="select * from register_user where userid = $uid";
	$find = mysqli_query($db, $mysql);
	$findname = mysqli_fetch_assoc($find);
	$username=$findname['name'];
	echo "<br>poster Name：" . $username;
	echo "<br>Subject：" . $postname;
	echo "<br>Content：" . nl2br($article) . "<br>"; //若登入者名稱和留言者名稱一致，顯示出編輯和刪除的連結
    if ($userid == $uid) {  //若登入者名稱和留言者名稱一致，顯示出編輯和刪除的連結
		echo ' <a href=" edit.php?userid=' . $userid . '&postid=' . $postid. '&areaid='.$areaid.'">
		Edit message content</a>&nbsp|&nbsp<a href="delete.php?userid=' . $userid . '&postid=' . $postid. '&areaid='.$areaid.'">Delete the message</a><br>';
	}
	echo "<hr>";
}
?>
<div class="">
	<?php
		//echo "test";
	?>
</div>
</div>
</body>
</html>