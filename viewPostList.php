<html>

<title> All Posts </title>

<?php
	include 'style.html';
	$userid = $_GET['userid'];
	$areaid=$_GET['areaid'];
?>

<style>
	.bubbles {
        width: 100px;
        height: 50px;
        font-size: 20;
        color: black;
        background: none;
		border: none;
        position: fixed;
        top: 40px;
        left: 40px;
        cursor: pointer;
    }
	.login {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 40px;
        cursor: pointer;
    }
	.log-out {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 40px;
        cursor: pointer;
    }
	.account {
		width: 100px;
        height: 50px;
		font-size: 16px;
		background: none;
		border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 160px;
		cursor: pointer;
	}
	.write-post {
        width: 100px;
        height: 50px;
        color: black;
        font-size: 16;
        background: none;
		border: none;
        position: fixed;
        top: 40px;
        right: 280px;
        cursor: pointer;
    }
</style>

<body>
    <?php
		if (!$userid) {
			echo "<a href='viewAreaList.php?userid=0'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="login"> <b> Login </b> </button> </a>';
		}
		else {
			echo "<a href='board.php?userid=" . $userid . "&areaid=". $areaid ."'> <button class='write-post'> <b> Write Post </b> </button> </a>";
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>';
		}
	?>
	<?php
		if($userid) {
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
		}
	?>
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