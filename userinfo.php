<html>

<title> User Infomation </title>

<?php
	$userid=$_GET['userid'];
	$areaid=$_GET['areaid'];
	$postid=$_GET['postid'];
?>

<style>
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
	.main {
		text-align: center;
		font-size: 30;
		position: relative;
		top: 40%;
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
			echo '<a href="index.php">Log in</a>';
		}
		else {
			echo "<a href='viewAreaList.php?userid=".$userid."'> <button class='bubbles'> <b> Bubbles </b> </button> </a>";
			echo '<a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>';
		}
	?>
	<div class="main">
		<?php
			session_start();
			include "db.php";
			$sql = "select * from register_user where userid = '$userid'";
			$result = mysqli_query($db, $sql);
			$_SESSION['userid'] = $userid = $_GET['userid'];
			//從資料庫中撈留言紀錄並顯示出來
			while ($row = mysqli_fetch_assoc($result)) {
				echo "Name：" . $row['name'];
				echo "<br>Password：" . $row['password'];
				echo '<br><a href=" editUser.php?userid=' . $userid . '&areaid=' .$areaid.'&postid='.$postid.'"> <button class="edit"> Edit User Infomation </button> </a>';
			}
		?>
	</div>
</body>

<html>