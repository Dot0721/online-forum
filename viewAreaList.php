<html>
	
<title> All Areas </title>
	
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
	a {
		display: inline-block;
	}
	.login {
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
        top: 5%;
        right: 5%;
        cursor: pointer;
    }
	.fav {
		width: 100px;
        height: 50px;
        background: none;
		border: none;
		font-size: 16;
        position: absolute;
        top: 5%;
        right: 15%;
        cursor: pointer;
	}
	.create_area {
		width: 110px;
        height: 50px;
        background: none;
		border: none;
		font-size: 16;
        position: absolute;
        top: 5%;
        right: 25%;
        cursor: pointer;
	}
	.account {
		width: 100px;
        height: 50px;
		font-size: 16px;
		background: none;
		border-radius: 5px;
        position: absolute;
        top: 5%;
        left: 5%;
		cursor: pointer;
	}
	.cards {
		display: flex;
        top: 300px;
		width: 80vw;
		font-family: 'Nunito', sans-serif;
        letter-spacing: .125rem;
        position: absolute;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
		gap: 15px;
	}
	.box {
		display: inline;
		width: 200px;
		height: 300px;
		border: solid #333;
		padding: 1em;
	}
	.enter {
		display: inline;
		width: 150px;
        height: 35px;
		color: white;
        background: black;
        border-radius: 5px;
		position: relative;
		cursor: pointer;
		top: 10px;
	}
	.star {
		width: 20px;
		height: 20px;
		position: relative;
		left: 160px;
		top: -40px;
	}
</style>

<body>
	<?php
		if (!$userid) {
			echo '<a href="index.php"> <button class="login"> <b> Login </b> </button> </a>';
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
	<h1> All Areas </h1>
	<p class="dir"> Choose an area to start chatting! </p>
	<div style=display:flex;justify-content:center;>
		<div class="cards">
			<?php
				$sql = "select * from post_area";
				$result = mysqli_query($db, $sql);
				//從資料庫中撈留言紀錄並顯示出來
				while ($row = mysqli_fetch_assoc($result)) {
					$areaname=$row['areaname'];
					$areaid=$row['areaid'];
					echo "<div class='box'>";
					echo "<h3> $areaname </h3>";
					echo "<a href='collectArea.php?areaid=$areaid&userid=$userid' class='link'> <img src='star.png' alt='Favorite' class='star'> </a>";
					// echo "<img src='star.png' alt='Favorite' class='star' onclick='location.href='pageurl.html';'";
					echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid' class='link'> <button class='enter'> enter </button> </a>";
					// echo "<button class='enter' onclick='viewPostList.php?areaid=$areaid&userid=$userid'> enter </button>";
					echo "</div>";
					//echo "<br>Subject：" . $row['subject'];
					// echo "<h3> $areaname <h3>";
					// echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'> <button class='enter'> enter </button> </a>";
					// echo "<a href='collectArea.php?areaid=$areaid&userid=$userid'> <img src='star.png' alt='Button' class='star'> </a>";
					// echo "<br><hr><br>";
				}
				/*
				echo "<br>";
				echo '<div class="bottom left position-abs content">';
				echo "There are " . mysqli_num_rows($result) . " messages.";
				*/
			?>
		</div>
	</div>
</body>

</html>