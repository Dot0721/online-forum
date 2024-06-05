<html>

<title> All Posts </title>

<?php
	include 'style.html';
	$userid = $_GET['userid'];
	$areaid=$_GET['areaid'];
?>

<style>
	h1 {
		display: inline;
        font-size: 50;
        font-family: 'Nunito', sans-serif;
        text-align: center;
        position: relative;
        top: 80px;
    }
	hr {
		width: 80%;
	}
	.dir {
		display: inline-block;
        color: grey;
        font-size: 18;
        text-align: center;
        position: relative;
        top: 70px;
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
		top: 80px;
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
	}
	.blacktext {
		color: black;
	}
	.redtext {
		background-color: #fdd;
		color: red;
	}
</style>

<body>
    <?php
		if (!$userid) {
			echo "<a href='viewAreaList.php?userid=0'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<form action="findpost.php" method="get">
					<div class="search">
					<input type="hidden" name="userid" value="'.$userid.'">
					<input type="hidden" name="areaid" value="'.$areaid.'">
					<input type="text" name="search" placeholder="Enter keywords to search post" class="search-field">
					<button type="submit" class="search-button"> <b> Search </b> </button>
					</div>
					</form>';
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Login </b> </button> </a>';
			echo "<a href='viewAreaList.php?userid=0'> <button class='visitor-last-page'> <b> All Areas </b> </button> </a>";
		}
		else {
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<form action="findpost.php" method="get">
					<div class="search">
					<input type="hidden" name="userid" value="'.$userid.'">
					<input type="hidden" name="areaid" value="'.$areaid.'">
					<input type="text" name="search" placeholder="Enter keywords to search post" class="search-field">
					<button type="submit" class="search-button"> <b> Search </b> </button>
					</div>
					</form>';
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='last-page'> <b> All Areas </b> </button> </a>";
		}
	?>
	<?php
		include "db.php";
		$sql="select * from register_user where userid = ".($userid ? $userid : '""');
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		$permissionlvl = ($userid) ? $row['permission_level'] : 0;
		$sql = "select * from post_area where areaid=$areaid";
		$result = mysqli_query($db, $sql);
		$areaName = mysqli_fetch_assoc($result)['areaname'];
		echo "<div>";
		echo "<div style='text-align: center;'>";
		echo "<h1> Welcome to #$areaName </h1>";
		echo "<br>";
		$sql="select manageid from post_area where areaid=$areaid";
		$find = mysqli_query($db, $sql);
		$findmanage = mysqli_fetch_assoc($find);
		$manageid=$findmanage['manageid'];
		$sql="select name from register_user where userid = $manageid";
		$find = mysqli_query($db, $sql);
		$findmanage = mysqli_fetch_assoc($find);
		$managename=$findmanage['name'];
		echo "<p class='dir'> Manager: $managename </p>";
		echo "</div>";
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
			$uid=$row['uid'];
			$isclose=$row['isclose'];
			$textcolor=($isclose ? "redtext" : "blacktext");
			// posts line by line
			if (!$isclose || $userid == $uid || $permissionlvl == 3) {
				echo "<div class=$textcolor style='display:flex; align-items:center; width:60vw'>";
					if ($userid == $uid) {
					echo "<a class=icon-btn style='display:inline-block;' 
							href='edit.php?userid=$userid&postid=$postid&areaid=$areaid'> <img src='icon/edit.svg' alt='edit' class='fit'> </a>";
					} else {
					echo "<p class=icon-btn style='display:inline-block;'> </p>";
					}
					echo "<a href='viewPostDetail.php?postid=$postid&userid=$userid&areaid=$areaid' class='post'
							style='margin-left:5%'> <b class=$textcolor> $postname </b> </a>";
				echo "</div>";
				echo "<hr>";
			}
		}
		echo "</div> </div>";
	?>
</div>
<br>
</body>

</html>