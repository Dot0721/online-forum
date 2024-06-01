<html>
	
<title> All Areas </title>
	
<?php
	include "style.html";
	include "db.php";
	$userid = $_GET['userid'];
?>

<style>
	h1 {
		display: inline;
        font-size: 50;
        font-family: 'Nunito', sans-serif;
        text-align: center;
        position: relative;
        top: 110px;
    }
	h3 {
		position: relative;
		left: 0;
	}
	a {
		text-decoration: none;
	}
	.dir {
		display: inline-block;
        color: grey;
        font-size: 18;
        text-align: center;
        position: relative;
        top: 90px;
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
	.centerbox {
		display: flex;
		justify-content: center;
	}
</style>

<body>
	<?php
		// Toolbar for non-member
		if (!$userid) {
			echo "<a href='viewAreaList.php?userid=0'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Login </b> </button> </a>';
		}
		// Toolbar for member
		else {
			// Get user info from db
			$sql ="select * from register_user where userid=$userid";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			echo "<a href='viewAreaList.php?userid=".$userid."'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
			echo "<a href='collectAreaList.php?userid=" . $userid . "'> <button class='fav'> <b> Favorite </b> </button> </a>";
			// Give access to create area if admin
			if($row['permission_level']==3){
				echo "<a href='createArea.php?userid=" . $userid . "'> <button class='create-area'> <b> Create Area </b> </button> </a>";
			}
		}
	?>
	<!-- Heading -->
	<div style="text-align: center;">
		<h1> All Areas </h1>
		<br>
		<p class="dir"> Choose an area to start chatting! </p>
	<div>
	<div class="centerbox">
		<div class="cards">
			<?php
				// Find area info from db
				$sql = "select * from post_area";
				$result = mysqli_query($db, $sql);
				// Show every area
				while ($row = mysqli_fetch_assoc($result)) {
					$areaname=$row['areaname'];
					$areaid=$row['areaid'];
					// Container for each area
					echo "<div class='box'>";
					echo 	"<h3 style='height:13%; width:85%'> $areaname </h3>";
					// Check if area is favorated by user
					if ($userid) {
						$sql = "select COUNT(*) as fav from collect_area where uid=$userid AND aid=$areaid";
						$is_favCount = mysqli_query($db, $sql);
						$is_fav = mysqli_fetch_assoc($is_favCount)['fav'] != 0;
						// Choose image(star) to display
						$star_style = "icon/star-" . ($is_fav ? "black" : "hollow") . ".svg" ;
						echo 	"<a href='collectArea.php?areaid=$areaid&userid=$userid' class='star'> <img src=$star_style alt='Favorite' class='fit'	> </a>";
					}
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