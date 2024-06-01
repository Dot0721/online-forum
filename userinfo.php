<html>

<title> User Infomation </title>

<?php
	include "style.html";
?>

<?php
	$userid=$_GET['userid'];
	$areaid=$_GET['areaid'];
	$postid=$_GET['postid'];
?>

<style>
	div {
		text-align: center;
		font-size: 30;
		font-family: 'Nunito', sans-serif;
		position: relative;
		top: 180px;
	}
	.edit {
		width: 250px;
		height: 50px;
		font-size: 25;
		color: blue;
		background: none;
		border: none;
		position: relative;
		top: 20px;
		cursor: pointer;
	}
</style>

<body>
	<?php
		if (!$userid) {
			echo '<a href="index.php"> Login </a>';
		}
		else {
			echo "<a href='viewAreaList.php?userid=".$userid."'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>';
			echo "<a href='viewAreaList.php?userid=". $userid . "'> <button class='visitor-last-page'> <b> All Areas </b> </button> </a>";
		}
	?>
	<div>
		<?php
			// session_start();
			include "db.php";
			$sql = "select * from register_user where userid = '$userid'";
			$result = mysqli_query($db, $sql);
			$_SESSION['userid'] = $userid = $_GET['userid'];
			//從資料庫中撈留言紀錄並顯示出來
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<b> User Name </b> <br>" . $row['name'];
				echo "<br> <br> <b> Password </b> <br>" . $row['password'];
				echo '<br> <a href=" editUser.php?userid=' . $userid . '&areaid=' .$areaid.'&postid='.$postid.'"> <button class="edit"> Edit Your Infomation </button> </a>';
			}
		?>
	</div>
</body>

<html>