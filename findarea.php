<html>

<title> Find Area </title>

<?php
    include "style.html";
	include "db.php";
?>

<style>
	h1 {
        font-size: 50;
        font-family: 'Nunito', sans-serif;
        text-align: center;
        position: relative;
        top: 60px;
    }
	.dir { /*direction*/
        color: grey;
        font-size: 18;
        text-align: center;
        position: relative;
        top: 30px;
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
	a {
		text-decoration: none;
	}
	.cards {
		display: flex;
        top: 40px;
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
    $userid = $_GET['userid'];
    $search = $_GET['search'];
		// Toolbar for non-member
		if (!$userid) {
			echo "<a href='viewAreaList.php?userid=0'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log In </b> </button>  </a>';
            echo '<form action="findarea.php" method="get">
					<div class="visitor-search">
					<input type="hidden" name="userid" value="'.$userid.'">
					<input type="text" name="search" placeholder="Enter keywords to search area" class="search-field">
					<button type="submit" class="search-button"> <b> Search </b> </button>
					</div>
					</form>';
		}
		// Toolbar for member
		else {
			$sql ="select * from register_user where userid=$userid";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_assoc($result);
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
            echo '<form action="findarea.php" method="get">
					<div class="search">
					<input type="hidden" name="userid" value="'.$userid.'">
					<input type="text" name="search" placeholder="Enter keywords to search area" class="search-field">
					<button type="submit" class="search-button"> <b> Search </b> </button>
					</div>
					</form>';
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
			/*if($row['permission_level']==3){
				echo "<a href='createArea.php?userid=" . $userid . "'> <button class='create-area'> <b> Create Area </b> </button> </a>";
			}*/
		}
	?>
	<a href='viewAreaList.php?userid=<?=$userid?>'> <button class='visitor-last-page'> <b> All Areas </b> </button> </a>
	<h1> Favorite Areas </h1>
	<p class="dir"> Choose an area to start chatting! </p>
	<div class="centerbox">
		<div class="cards">
			<?php
				$sql = "SELECT * 
				FROM post_area pa
				WHERE pa.areaname LIKE '%$search%'";
				$result = mysqli_query($db, $sql);
				//從資料庫中撈留言紀錄並顯示出來
				while ($row = mysqli_fetch_assoc($result)) {
					$areaname=$row['areaname'];
					$areaid=$row['areaid'];
					// Container for each area
					echo "<div class='box'>";
					echo 	"<h3 style='height:13%; width:85%; text-align:center'> $areaname </h3>";
					if ($userid) {
						$sql = "select COUNT(*) as fav from collect_area where uid=$userid AND aid=$areaid";
						$is_favCount = mysqli_query($db, $sql);
						$is_fav = mysqli_fetch_assoc($is_favCount)['fav'] != 0;
						// Choose image(star) to display
						$star_style = "icon/star-" . ($is_fav ? "black" : "hollow") . ".svg" ;
						echo 	"<a href='collectArea.php?areaid=$areaid&userid=$userid' class='star icon-btn'> <img src=$star_style alt='Favorite' class='fit'	> </a>";
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