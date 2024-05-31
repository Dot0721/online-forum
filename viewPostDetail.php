<html>

<title> Post Detail </title>

<?php
	include "db.php";
	include "style.html";
	session_start();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$postid = $_POST['postid'];
		$text = $_POST['text'];
		$userid=$_POST['userid'];
		$areaid=$_POST['areaid'];
	}
	else{
		$postid=$_GET['postid'];
		$userid=$_GET['userid'];
		$areaid=$_GET['areaid'];
	}
?>

<style>
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
	.last-page {
		width: 100px;
        height: 50px;
        font-size: 16;
        color: white;
        background: black;
        border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 160px;
        cursor: pointer;
    }
</style>	

<body>
	<div>
	<?php
		echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'> <button class='last-page'> <b> Posts </b> </button> </a>";
		if (!$userid) {
			echo '<a href="index.php"> <button class="login"> <b> Log in </b> </button> </a>';
		}
		else {
			echo '<a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>';
			echo "<a class=account href='userinfo.php?userid=" . $userid . "&areaid=0&postid=".$postid."'>User</a>";
		}
	?>
	<div>
		<?php
			$mysql="select manageid from post_area where areaid=$areaid";
			$find = mysqli_query($db, $mysql);
			$findmanage = mysqli_fetch_assoc($find);
			$manageid=$findmanage['manageid'];
			$sql = "select * from post where postid = $postid";
			$result = mysqli_query($db, $sql);
		?>
	</div>
</body>

</html>