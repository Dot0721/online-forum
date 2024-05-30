<html>

<title> Favorite Areas </title>

<?php
	include "style.html";
	include "db.php";
	$userid = $_GET['userid'];
?>

<style>
	h3 {
		position: relative;
		left: 0;
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
	a {
		text-decoration: none;
	}
	.cards {
		display: flex;
        top: 100px;
		width: 80vw;
		font-family: 'Nunito', sans-serif;
        letter-spacing: .125rem;
        position: relative;
		flex-direction: row;
		flex-wrap: wrap;
		justify-content: center;
		gap: 15px;
	}
	.box {
		display: inline;
		width: 10em;
		height: 12em;
		border: solid #333;
		padding: 2em;
	}
	.enter {
		display: inline;
		width: 100%;
		height: fit-content;
		color: white;
		background: black;
		border-radius: 5px;
		cursor: pointer;
		padding: 5% 0;
		text-align: center;
		position: relative;
		bottom: -3em;
	}
	.star {
		display: block;
		width: 20px;
		height: 20px;
		position: relative;
		left: 90%;
		top: -2.5em;
	}
	.fit {
		width: 100%;
		height: 100%;
	}
	.centerbox {
		display: flex;
		justify-content: center;
	}
</style>

<body>
	<?php
		// Toolbar for non-member
		if (!$userid) {
			echo '<a href="index.php"> Login </a>';
		}
		// Toolbar for member
		else {
			$sql ="select * from register_user where userid=$userid";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
			/*if($row['permission_level']==3){
				echo "<a href='createArea.php?userid=" . $userid . "'> <button class='create-area'> <b> Create Area </b> </button> </a>";
			}*/
		}
	?>
	<a href='viewAreaList.php?userid=<?=$userid?>'> <button class='last-page'> <b> Last Page </b> </button> </a>
	<h1> Favorite Areas </h1>
	<p class="dir"> Choose an area to start chatting! </p>
	<div class="centerbox">
		<div class="cards">
			<?php
				$sql = "SELECT * 
				FROM post_area pa
				JOIN collect_area ca ON pa.areaid = ca.aid
				WHERE ca.uid = $userid";
				$result = mysqli_query($db, $sql);
				//從資料庫中撈留言紀錄並顯示出來
				while ($row = mysqli_fetch_assoc($result)) {
					$areaname=$row['areaname'];
					$areaid=$row['areaid'];
					// Container for each area
					echo "<div class='box'>";
					echo 	"<h3> $areaname </h3>";
					$star_style = "icon/star-yellow.svg" ;
					echo 	"<a href='collectArea.php?areaid=$areaid&userid=$userid' class='star'> <img src=$star_style alt='Favorite' class='fit'	> </a>";
					// Button to enter area
					echo 	"<div class='centerbox'>
								<a href='viewPostList.php?areaid=$areaid&userid=$userid' class='enter'> enter </a>
							</div>";
					echo "</div>";
				}
			?>
		</div>
	</div>
	<footer></footer>
</body>

</html>