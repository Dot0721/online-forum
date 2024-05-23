<?php
include 'db.php';
include 'style.html';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $violate=$_POST['violate'];
    $postid = $_POST['postid'];
    $userid=$_POST['userid'];
    $areaid=$_POST['areaid'];
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
                        <a href='viewPostDetail.php?postid=<?=$postid?>&userid=<?=$userid?>&areaid=<?=$areaid?>'>Last Page</a>
                        <a href="index.php">Logout</a>
                        <a href="signup.php">Register</a>
                </div>

      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="closepost.php" method="post">
                        <input type="hidden" name="postid" value="<?=$postid?>">
                        <input type="hidden" name="userid" value="<?=$userid?>">
                        <input type="hidden" name="areaid" value="<?=$areaid?>">
                        <p>違規選項</p>
                        <select name="violate">
                            <option>仇恨或歧視內容</option>
                            <option>不雅或不當內容</option>
                            <option>侵犯隱私</option>
                            <option>垃圾訊息</option>
                            <option>欺詐或誤導內容</option>
                            <option>違反特定版區規則</option>
                        </select>
                        <p><input type="submit" name="submit" value="SELECT">
                    <style>
                        input {padding:5px 15px; background:#ccc; border:0 none;
                        cursor:pointer;
                        -webkit-border-radius: 5px;
                        border-radius: 5px; }
                    </style>
                        <style>
                            /* 设置下拉框的宽度和高度 */
                            select {
                                width: 200px; /* 调整宽度 */
                                height: 40px; /* 调整高度 */
                                font-size: 16px; /* 调整字体大小 */
                                padding: 5px; /* 设置内边距 */
                                border-radius: 5px; /* 设置圆角边框 */
                                background-color: #f9f9f9; /* 设置背景颜色 */
                                border: 1px solid #ccc; /* 设置边框 */
                            }
                        </style>        
                    </form>
                </div>

</body>
</html>
<?php 

if (isset($_POST['submit'])) {
    $postid = $_POST['postid'];
    $violate=$_POST['violate'];
    $userid=$_POST['userid'];
    $areaid=$_POST['areaid'];
    $sql ="delete from message where pid=$postid";
    $sql ="delete from likeuserid where pid=$postid";
    mysqli_query($db, $sql);
	$sql = "update post set postname='$violate',article='' where postid='$postid'";
	if (!mysqli_query($db, $sql)) {
		die(mysqli_error($con));
	} else {
		echo "
         <script>
            setTimeout(function(){window.location.href='viewPostList.php?areaid=$areaid&userid=$userid';},200);
        </script>";

	}
} 
?>