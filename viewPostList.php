<html>

<title> All Posts </title>

<?php
	// include 'style.html';
	$userid = $_GET['userid'];
	$areaid=$_GET['areaid'];
?>

<style>
	h1 {
		text-align: center;
		font-size: 50;
		font-family: 'Nunito', sans-serif;
		position: relative;
		top: 100px;
	}
	hr {
		width: 80%;
	}
	.dir {
		text-align: center;
		font-size: 18;
		font-family: 'Nunito', sans-serif;
		color: grey;
		position: relative;
		top: 90px;
	}
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
		padding: 1em 0;
		text-align: center;
		width: 80%;
		text-decoration: none;
		color: black;
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
		echo "<div class='postlist'> <hr>";
		while ($row = mysqli_fetch_assoc($result)) {
			$postname=$row['postname'];
			$postid=$row['postid'];
			//echo "<br>Subject：" . $row['subject'];
			echo "<a href='viewPostDetail.php?postid=$postid&userid=$userid&areaid=$areaid' class='post'>$postname</a>";
			echo "<hr>";
		}
		echo "</div> </div>";
		/*
		echo "<br>";
		echo '<div class="bottom left position-abs content">';
		echo "There are " . mysqli_num_rows($result) . " messages.";
		*/
	?>
</div>
</body>

</html>