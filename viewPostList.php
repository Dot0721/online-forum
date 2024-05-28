<html>

<title> All Posts </title>

<?php
	include 'style.html';
	$userid = $_GET['userid'];
	$areaid=$_GET['areaid'];
?>

<style>
	.login {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: absolute;
        top: 40px;
        right: 60px;
        cursor: pointer;
    }
	.log-out {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: absolute;
        top: 5%;
        right: 5%;
        cursor: pointer;
    }
	.last-page {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: absolute;
        top: 5%;
        right: 15%;
        cursor: pointer;
    }
	.write-post {
        width: 100px;
        height: 50px;
        color: black;
        font-size: 16;
        background: none;
		border-radius: 5px;
        position: absolute;
        top: 5%;
        right: 25%;
        cursor: pointer;
    }
</style>

<body>
    <?php
		if (!$userid) {
			echo "<a href='viewAreaList.php?userid=0'> <button class='last-page'> <b> Last page </b> </button> </a>";
			echo '<a href="index.php"> <button class="login"> <b> Login </b> </button> </a>';
		}
		else {
			echo "<a href='board.php?userid=" . $userid . "&areaid=". $areaid ."'> <button class='write-post'> <b> Write Post </b> </button> </a>";
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='last-page'> <b> Last page </b> </button> </a>";
			echo '<a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>';
		}
	?>
	<div class="top-left home">
		<?php
			if($userid){
				echo "<a href='userinfo.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=0'>User</a>";
			}
		?>
	 </div>
	<div class="PostList post full-height">
	<?php
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