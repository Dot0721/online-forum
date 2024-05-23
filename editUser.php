<?php
include 'style.html';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postid=$_POST['postid'];
    $userid=$_POST['userid'];
    $areaid=$_POST['areaid'];
    $name=$_POST['name'];
    $passwotd=$_POST['password'];
}
else{
    $postid=$_GET['postid'];
    $userid=$_GET['userid'];
    $areaid=$_GET['areaid'];
}
?>
<title>Edit Message</title>

<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href='viewAreaList.php?userid=<?=$userid?>'>View</a>
                        <a href="index.php">Logout</a>
                        <a href="signup.php">Register</a>
                </div>

<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = "SELECT * FROM register_user WHERE  userid=" . $_POST['userid'] .""; 
}
else{
    $query = "SELECT * FROM register_user WHERE  userid=" . $_GET['userid'] .""; 
}
$result = mysqli_query($db, $query);
while ($rs = mysqli_fetch_array($result)) {
	?>
      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="editUser.php" method="post">
                        <input type="hidden" name="postid" value="<?=$postid?>">
                        <input type="hidden" name="userid" value="<?=$rs['userid']?>">
                        <input type="hidden" name="areaid" value="<?=$areaid?>">
                        <p>Name</p>
                        <input type="text" name="name" value="<?=$rs['name']?>">
                        <p>Password</p>
                        <input type="text" name="password" value="<?=$rs['password']?>">
                        <p><input type="submit" name="submit" value="SAVE">
                    <style>
                        input {padding:5px 15px; background:#ccc; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="REWRITE">
                    <style>
                        input {
                            padding:5px 15px;
                            background:#FFCCCC;
                            border:0 none;
                            cursor:pointer;
                            -webkit-border-radius: 5px;
                            border-radius: 5px;
                            font-family: 'Nunito', sans-serif;
                            font-size: 19px;
                        }
                    </style>
                    </form>
                </div>

</body>
</html>
<?php }

if (isset($_POST['submit'])) {
	$postid=$_POST['postid'];
    $userid=$_POST['userid'];
    $areaid=$_POST['areaid'];
    $name=$_POST['name'];
    $password=$_POST['password'];

	$sql = "update register_user set password='$password',name='$name' where userid='$userid'";
	if (!mysqli_query($db, $sql)) {
		die(mysqli_error($con));
	} else {
		echo "
         <script>
         setTimeout(function(){window.location.href='viewAreaList.php?areaid=$areaid&userid=$userid';},200);
        </script>";

	}
} else {
	echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
}
?>