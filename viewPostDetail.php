<title>All messages</title>
<?php
include 'style.html';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postid = $_POST['postid'];
    $text = $_POST['text'];
    $userid=$_POST['userid'];
    $areaid=$_POST['areaid'];
}
else{
    $postid=$_GET['postid'];
    $userid=$_GET['userid'];
    $areaid=$_GET['areaid'];
}
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
		echo "Message";
		$sql="select name,text from message as m,register_user as u,post as p where m.uid=u.userid and m.pid=p.postid";
		$result = mysqli_query($db,$sql);
		while($row=mysqli_fetch_assoc($result)){
			$text=$row['text'];
			$name=$row['name'];
			echo "<br>".$name;
			echo ":".$text;
		}
		//echo "test";
	?>
	<div class="">
	<form name="form1" action="viewPostDetail.php" method="post">
				<input type="hidden" name="postid" value="<?=$postid?>">
                <input type="hidden" name="userid" value="<?=$userid?>">
                <input type="hidden" name="areaid" value="<?=$areaid?>">
			<p><input type="text" name="text"></p>
			<p><input type="submit" name="submit" value="SEND">
			<style>
                    input {
                        padding:5px 15px;
                        background:#FFCCCC;
                        border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px;
                        font-family: 'Nunito', sans-serif;
                        font-size: 19px;
                        }
                </style>
	</form>
	</div>
	<?php
//送出留言後會執行下面這段程式碼
if (isset($_POST['submit'])) {
	echo '<div class="success">Added successfully ！</div>';
	$postid = $_POST['postid'];
    $text = $_POST['text'];
    $userid=$_POST['userid'];
    $areaid=$_POST['areaid'];
	$sql = "INSERT message(uid,pid,text) VALUES ('$userid', '$postid','$text')";
	if (!mysqli_query($db, $sql)) {
		die(mysqli_error($db));
	} else {
		echo "
                <script>
                setTimeout(function(){window.location.href='viewPostDetail.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=".$postid."';},500);
                </script>";

	}
} 
?>
</div>
</div>
</body>
</html>