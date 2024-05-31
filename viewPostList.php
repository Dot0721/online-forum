<html>

<title> All Posts </title>

<?php
	include 'style.html';
	$userid = $_GET['userid'];
	$areaid=$_GET['areaid'];
?>

<style>
	hr {
		width: 80%;
	}
	.write-post {
        width: 8em;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
		border-radius: 5px;
        cursor: pointer;
    }
	.postlist {
		display: flex;
		position: relative;
		top: 100px;
		width: 80vw;
		font-family: 'Nunito', sans-serif;
		letter-spacing: .125rem;
		flex-direction: column;
		align-items: center;
	}
	.post {
		width: 80%;
		padding: 1em 0;
		text-align: center;
		text-decoration: none;
		color: black;
	}
</style>

<body>
    <?php
		if (!$userid) {
			echo "<a href='viewAreaList.php?userid=0'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Login </b> </button> </a>';
			echo "<a href='viewAreaList.php?userid=0'> <button class='visitor-last-page'> <b> Last Page </b> </button> </a>";
		}
		else {
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='last-page'> <b> Last Page </b> </button> </a>";
		}
	?>
	<?php
		if($userid) {
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
		}
		include "db.php";
		$sql = "select * from post_area where areaid=$areaid";
		$result = mysqli_query($db, $sql);
		$areaName = mysqli_fetch_assoc($result)['areaname'];
		echo "<div>";
		echo "<h1> Welcome to #$areaName </h1>";
		echo "<p class='dir'> Choose a post to view content! </p>";
		$sql = "select * from post where aid=$areaid";
		$result = mysqli_query($db, $sql);
		$_SESSION['userid'] = $userid = $_GET['userid'];
		//從資料庫中撈留言紀錄並顯示出來
		echo "<div style=display:flex;justify-content:center;>";
		echo "<div class='postlist'>";
		if ($userid) {
			echo "<a href='board.php?userid=" . $userid . "&areaid=". $areaid ."'> <button class='write-post'> <b> + New Post </b> </button> </a>";
		}
		echo "<hr>";
		while ($row = mysqli_fetch_assoc($result)) {
			$postname=$row['postname'];
			$postid=$row['postid'];
			//echo "<br>Subject：" . $row['subject'];
			echo "<a href='viewPostDetail.php?postid=$postid&userid=$userid&areaid=$areaid' class='post'> <b> $postname </b> </a>";
			echo "<hr>";
		}
		echo "</div> </div>";
	?>
</div>
<br>
</body>

</html>