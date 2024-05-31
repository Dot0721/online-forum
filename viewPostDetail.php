<html>

<title> Post Detail </title>

<?php
	include "db.php";
	include "style.html";
	//session_start();
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
	.visitor_last-page {
		width: 100px;
        height: 50px;
        font-size: 16;
        color: black;
        background: none;
        border: none;
        position: fixed;
        top: 40px;
        right: 160px;
        cursor: pointer;
    }
	input {
		padding:5px 15px;
		background:#F5F5F5;
		border:2px solid black;
		cursor:pointer;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		font-family: 'Nunito', sans-serif;
		font-size: 19px;
	}
	h1 {
		top: revert;
		margin: 5px;
	}
	h2 {
		top: revert;
		margin: 5px;
	}
	hr {
		width: 80vw;

	}
	.dir {
		top: revert;
	}
	.user-name {
		font-size: 24px;
		font-family: 'Nunito', sans-serif;
	}
	.comment {
		left: 5vw;
		font-size: 16px;
		text-align: left;
		word-wrap: break-word;
		font-family: 'Nunito', sans-serif;
	}
	
</style>	

<body>
	<!-- toolbar -->
	<?php
		echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'> <button class='last-page'> <b> Posts </b> </button> </a>";
		if (!$userid) {
			echo '<a href="index.php"> <button class="upper-right-button"> <b> Login </b> </button> </a>';
		}
		else {
			echo '<a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>';
			echo "<a class=account href='userinfo.php?userid=" . $userid . "&areaid=0&postid=".$postid."'>User</a>";
		}
	?>
	<!-- other content, offset by 110px-->
	<div class="pos-ref" style="margin-top: 110px;">
	
		<div class="flex-center" style="margin-bottom: 10vh">
		<?php
			// collect post infomation 
			$mysql="select manageid from post_area where areaid=$areaid";
			$find = mysqli_query($db, $mysql);
			$findmanage = mysqli_fetch_assoc($find);
			$manageid=$findmanage['manageid'];
			$sql = "select * from post where postid = $postid";
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);
			$postname=$row['postname'];
			$article=$row['article'];
			$showInput = ($userid) ? 1 : 0;
			$uid=$row['uid'];
			$mysql="select * from register_user where userid = $uid";
			$find = mysqli_query($db, $mysql);
			$findname = mysqli_fetch_assoc($find);
			$username=($uid) ? $findname['name'] : '';
			$mysql="select * from register_user where userid = ".($userid ? $userid : '""');
			$find = mysqli_query($db, $mysql);
			$findname = mysqli_fetch_assoc($find);
			$permissionlvl = ($userid) ? $findname['permission_level'] : 0;
			// show post message
			echo "<div class='flex-center full-width'>";
			echo 	"<h1>$postname</h1>";
			echo 	"<p class='dir'>Poster: $username</p>";
			echo 	"<div class='article full-width'>";
			echo 		"<br>" . nl2br($article) . "<br>"; 
			echo 	"</div>";
			echo "</div>";
			// show edit & delete if post by self
			if ($userid == $uid&&$showInput==1) { 
				echo "<a class='pos-abs icon-btn' style='right:20%; top:0' 
						href='edit.php?userid=$userid&postid=$postid&areaid=$areaid'> <img src='icon/edit.svg' alt='edit' class='fit'> </a>";
				echo "<a class='pos-abs icon-btn' style='right:calc(20% + 60px); top:0'
						href='delete.php?userid=$userid&postid=$postid&areaid=$areaid'> <img src='icon/delete.svg' alt='delete' class='fit'> </a>";
			}
			// show close post if have permission
			if (($userid == $manageid)|| $permissionlvl==3) {
				echo "<a class='pos-abs icon-btn' style='right:calc(20% - 60px); top:0' 
						href='closepost.php?userid=$userid&postid=$postid&areaid=$areaid'> <img src='icon/circle-cross.svg' alt='close' class='fit'> </a>";
			}
			
		?>
		</div>
		<div>
		<!-- show like button -->
		<form name="form2" action="likeuser.php" method="post" style=height:70px;>
			<input type="hidden" name="postid" value="<?=$postid?>">
			<input type="hidden" name="userid" value="<?=$userid?>">
			<input type="hidden" name="areaid" value="<?=$areaid?>">
			<?php
				// like btn
				if ($showInput==1) {
					$sql = "select COUNT(*) as liked from likeuserid where pid=$postid AND uid=$userid";
					$result = mysqli_query($db, $sql);
					$icon = "icon/thumbs-up-" . ((mysqli_fetch_assoc($result)['liked']!=0) ? "black" : "hollow") . ".svg"; 
					echo "<input type='image' name='submit' src=$icon alt='LIKE' 
							class='pos-ref icon-btn' style='left:30%'>";

				} else {
					echo "<img src='icon/thumbs-up-hollow' alt='LIKE' 
							class='pos-ref icon-btn' style='left:30%'>";
				}
				// like count
				$sql="select * from likeuserid where pid=$postid";
				$result = mysqli_query($db,$sql);
				echo "<p class=pos-ref style='left:calc(30% + 75px); top:-40px'>" . mysqli_num_rows($result) . "</p>";
			?>
		</form>
		</div>
		<hr>
		<div class="flex-center" style="margin-bottom: 10vh">
			<h2> Message </h2>
			<!-- show comment text box for member-->
			<form name="form1" action="viewPostDetail.php" method="post">
				<input type="hidden" name="postid" value="<?=$postid?>">
				<input type="hidden" name="userid" value="<?=$userid?>">
				<input type="hidden" name="areaid" value="<?=$areaid?>">
				<?php
				if ($showInput==1) {
					echo '<p><input type="text" name="text"></p>';
					echo '<p style="text-align:center"><input type="submit" name="submit" value="SEND"></p>';
				}
				?>
			</form>
			<?php
				// show all comments
				$sql="select uid,text from message where pid=$postid";
				$result = mysqli_query($db,$sql);
				echo "<hr>";
				while($row=mysqli_fetch_assoc($result)) {
					$uid=$row['uid'];
					$mysql="select name from register_user where userid=$uid";
					$mysqlre =mysqli_query($db,$mysql);
					$row2= mysqli_fetch_assoc($mysqlre);
					$name=$row2['name'];
					$text=$row['text'];	
					echo "<dir class=full-width style='margin:0 0'>";
					echo 	"<p class='user-name'> $name: </p>";
					echo 	"<p class='comment pos-ref'> $text </p>";
					echo "</dir>";
					echo "<hr>";
				}
			?>
	</div>
	<?php
	//送出留言後會執行下面這段程式碼
		if (isset($_POST['submit'])&&$_POST['text']!=null) {
			echo '<div class="success">Added successfully ！</div>';
			$postid = $_POST['postid'];
			$text = $_POST['text'];
			$userid=$_POST['userid'];
			$areaid=$_POST['areaid'];
			$sql = "INSERT INTO message(uid,pid,text) VALUES ('$userid', '$postid','$text')";
			if (!mysqli_query($db, $sql)) {	
				die(mysqli_error($db));
			}
			else {
				echo "
					<script>
						setTimeout(function(){window.location.href='viewPostDetail.php?userid=" . $userid . "&areaid=" . $areaid . "&postid=".$postid."';},500);
					</script>";
			}
		}
	?>
</body>

</html>