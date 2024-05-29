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
		text-decoration: none;
	}
	.login {
		width: 100px;
        height: 50px;
        font-size: 16;
        color: white;
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
		font-size: 16;
        color: white;
        background: black;
        border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 40px;
        cursor: pointer;
    }
	.fav {
		width: 100px;
        height: 50px;
        background: none;
		border: none;
		font-size: 16;
        position: fixed;
        top: 40px;
        right: 160px;
        cursor: pointer;
	}
	.create-area {
		width: 110px;
        height: 50px;
        background: none;
		border: none;
		font-size: 16;
        position: fixed;
        top: 40px;
        right: 280px;
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
        left: 40px;
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
			echo '<a href="index.php"> <button class="login"> <b> Login </b> </button> </a>';
		}
		// Toolbar for member
		else {
			// Get user info from db
			$sql ="select * from register_user where userid=$userid";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			echo "<a href='collectAreaList.php?userid=" . $userid . "'> <button class='fav'> <b> Favorite </b> </button> </a>";
			echo '<a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>';
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
			// Give access to create area if admin
			if($row['permission_level']==3){
				echo "<a href='createArea.php?userid=" . $userid . "'> <button class='create-area'> <b> Create Area </b> </button> </a>";
			}
		}
	?>
	<!-- Heading -->
	<h1> All Areas </h1>
	<p class="dir"> Choose an area to start chatting! </p>
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
					echo 	"<h3> $areaname </h3>";
					// Check if area is favorated by user
					$sql = "select COUNT(*) as fav from collect_area where uid=$userid AND aid=$areaid";
					$is_favCount = mysqli_query($db, $sql);
					$is_fav = mysqli_fetch_assoc($is_favCount)['fav'] != 0;
					// Choose image(star) to display
					$star_style = "icon/star-" . ($is_fav ? "yellow" : "hollow") . ".svg" ;
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
</body>

</html>