<?php
include 'style.html';
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $areaid=$_POST['areaid'];
	$postname = $_POST['postname'];
	$article = $_POST['article'];
}
else{
    $userid = $_GET['userid'];
    $areaid = $_GET['areaid'];
}
$sql = "select * from register_user where userid=$userid";
$result = mysqli_query($db, $sql);
$output=mysqli_fetch_assoc($result);
$name=$output['name'];
?>
<title>Board</title>
<body>
     <div class="flex-center position-ref full-height">
                <div class="top-right home">
                        <a href='viewAreaList.php?userid=<?=$userid?>'>View</a>
                        <a href="index.php">Logout</a>
                </div>
      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="board.php" method="post">
                        <input type="hidden" name="userid" value="<?=$userid?>"> 
                        <input type="hidden" name="areaid" value="<?=$areaid?>"> 
                        	<p><strong><?="Hi, " . $name?></strong></p>
                        	<p>Postname</p>
                        	<p><input type="text" name="postname"></p>
                        	<p>Article</p>
                        	<p><textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px;height:100px;" name="article"></textarea></p>
                        	<p><input type="submit" name="submit" value="SEND">
                    <style>
                        input {padding:5px 15px; background:#FFCCCC; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <input type="reset" name="Reset" value="RESET">
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

<?php
//送出留言後會執行下面這段程式碼
if (isset($_POST['submit'])) {
	include "db.php";
	echo '<div class="success">Added successfully ！</div>';
	$userid = $_POST['userid'];
    $areaid=$_POST['areaid'];
	$postname = $_POST['postname'];
	$article = $_POST['article'];
	$sql = "INSERT post(uid,aid, postname,article) VALUES ('$userid', '$areaid','$postname', '$article')";
	if (!mysqli_query($db, $sql)) {
		die(mysqli_error($db));
	} else {
    //若成功將留言存進資料庫，會自動跳轉到顯示留言的頁面
		echo "
                <script>
                setTimeout(function(){window.location.href='viewPostList.php?userid=" . $userid . "&areaid=" . $areaid . "';},500);
                </script>";

	}
} else {
	echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
}
?>