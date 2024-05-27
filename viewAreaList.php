<html>

<title> Area List </title>

<?php
	include "db.php";
	$userid = $_GET['userid'];
?>

<style>
	h1 {
		text-align: center;
		font-size: 50;
		font-family: 'Nunito', sans-serif;
		position: relative;
		top: 100px;
	}
	h3 {
		position: relative;
		left: 0;
	}
	.dir {
		text-align: center;
		font-size: 18;
		font-family: 'Nunito', sans-serif;
		color: grey;
		position: relative;
		top: 90px;
	}
	.logout {
        width: 100px;
        height: 50px;
        color: white;
        background: black;
        border-radius: 5px;
		font-size: 16;
        position: absolute;
        top: 40px;
        right: 60px;
        cursor: pointer;
    }
	.fav {
		width: 100px;
        height: 50px;
        background: none;
		border: none;
		font-size: 16;
        position: absolute;
        top: 40px;
        right: 180px;
        cursor: pointer;
	}
	.create_area {
		width: 110px;
        height: 50px;
        background: none;
		border: none;
		font-size: 16;
        position: absolute;
        top: 40px;
        right: 300px;
        cursor: pointer;
	}
	.account {
		width: 100px;
        height: 50px;
		font-size: 16px;
		background: none;
		border-radius: 5px;
        position: absolute;
        top: 40px;
        left: 20px;
		cursor: pointer;
	}
	.main {
		width: 500px;
        font-size: 20px;
		font-family: 'Nunito', sans-serif;
        letter-spacing: .125rem;
        position: relative;
        left: 400px;
        top: 125px;
	}
	.enter {
		width: 90px;
        height: 35px;
		color: white;
        background: black;
        border-radius: 5px;
		position: absolute;
		right: 0px;
		cursor: pointer;
	}
	.star {
		width: 20px;
		height: 20px;
		position: absolute;
		left: 0px;
	}
</style>

<body>
	<?php
		if (!$userid) {
			echo '<a href="index.php">Log in</a>';
		}
		else {
			//echo "<a href='board.php?name=" . $name . "'>Write some messages</a>";
			$sql ="select * from register_user where userid=$userid";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			echo "<a href='collectAreaList.php?userid=" . $userid . "'> <button class='fav'> <b> Favorite </b> </button> </a>";
			if($row['permission_level']==3){
				echo "<a href='createArea.php?userid=" . $userid . "'> <button class='create_area'> <b> Create Area </b> </button> </a>";
			}
			echo '<a href="index.php"> <button class="logout"> <b> Log out </b> </button> </a>';
		}
	?>
	<?php
		if($userid){
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
		}
	?>
	<h1> Bubbles </h1>
	<p class="dir"> Choose a bubble to start chatting! </p>
	<div class="main">
		<?php
			$sql = "select * from post_area";
			$result = mysqli_query($db, $sql);
			//從資料庫中撈留言紀錄並顯示出來
			while ($row = mysqli_fetch_assoc($result)) {
				$areaname=$row['areaname'];
				$areaid=$row['areaid'];
				//echo "<br>Subject：" . $row['subject'];
				echo "<h3> $areaname <h3>";
				echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'> <button class='enter'> enter </button> </a>";
				echo "<a href='collectArea.php?areaid=$areaid&userid=$userid'> <img src='star.png' alt='Button' class='star'> </a>";
				echo "<br><hr><br>";
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