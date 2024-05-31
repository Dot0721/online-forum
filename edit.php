<html>
    
<title> Edit Post </title>

<?php
    include 'style.html';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postname = $_POST['postname'];
        $postid = $_POST['postid'];
        $article = $_POST['article'];
        $userid=$_POST['userid'];
        $areaid=$_POST['areaid'];
    }
    else {
        $postid=$_GET['postid'];
        $userid=$_GET['userid'];
        $areaid=$_GET['areaid'];
    }
?>

<body>
    <a href='viewPostDetail.php?postid=<?=$postid?>&userid=<?=$userid?>&areaid=<?=$areaid?>'> <button class='last-page'> <b> Last Page </b> </button> </a>
    <a href='viewAreaList.php?userid=". $userid . "'> <button class='bubbles'> <b> Bubbles </b> </button> </a>
	<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>
    <?php
        include 'db.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $query = "SELECT * FROM post WHERE  postid=" . $_POST['postid'] .""; //選出該位使用者所留下的所有留言
        }
        else{
            $query = "SELECT * FROM post WHERE  postid=" . $_GET['postid'] .""; //選出該位使用者所留下的所有留言
        }
        $result = mysqli_query($db, $query);
        while ($rs = mysqli_fetch_array($result)) {
    ?>
      <div class="content">
                <div class="m-b-md">
                    <form name="form1" action="edit.php" method="post">
                        <input type="hidden" name="postid" value="<?=$rs['postid']?>">
                        <input type="hidden" name="userid" value="<?=$userid?>">
                        <input type="hidden" name="areaid" value="<?=$areaid?>">
                        <p>TITLE</p>
                        <input type="text" name="postname" value="<?=$rs['postname']?>">
                        <p>ARTICLE</p>
                        <p><textarea style="font-family: 'Nunito', sans-serif; font-size:20px; width:550px; height:100px;" name="article"></textarea></p>
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
        $postname = $_POST['postname'];
        $postid = $_POST['postid'];
        $article = $_POST['article'];
        $userid=$_POST['userid'];
        $areaid=$_POST['areaid'];
        $sql = "update post set postname='$postname',article='$article' where postid='$postid'";
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($con));
        } else {
            echo "
            <script>
                setTimeout(function(){window.location.href='viewPostList.php?areaid=$areaid&userid=$userid';},200);
            </script>";

        }
    }
    else {
        echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
    }
?>