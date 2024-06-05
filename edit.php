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

<style>
    .save {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: relative;
        top: 100px;
        cursor: pointer;
    }
    .rewrite {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: relative;
        top: 100px;
        cursor: pointer;
    }
</style>

<body>
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class='bubbles'> <b> Bubbles </b> </button> </a>
	<a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>
    <a href='userinfo.php?userid=<?=$userid?>&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>
    <a href='viewPostDetail.php?postid=<?=$postid?>&userid=<?=$userid?>&areaid=<?=$areaid?>'> <button class='last-page'> <b> Post content </b> </button> </a>
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
    <form name="form1" action="edit.php" method="post">
        <div style="text-align: center;">
            <input type="hidden" name="postid" value="<?=$rs['postid']?>">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="hidden" name="areaid" value="<?=$areaid?>">
            <h1> Edit Post </h1>
            <p class="dir"> What content do you want to modified? </p>
            <h2> Postname </h2>
            <input type="text" name="postname" value="<?=$rs['postname']?>" class="input-field">
            <h2> Article </h2>
            <textarea name="article"><?= htmlspecialchars($rs['article']) ?></textarea>
            <br>
            <button type="submit" name="submit" value="SAVE" class="save"> <b> Save </b> </button>
            <button type="reset" name="Reset" value="REWRITE" class="rewrite"> <b> Rewrite </b> </button>
        </div>
    </form>
</body>

</html>

<?php }
    if (isset($_POST['submit'])) {
        $postname = $_POST['postname'];
        $postid = $_POST['postid'];
        $article = $_POST['article'];
        $userid=$_POST['userid'];
        $areaid=$_POST['areaid'];
        $sql = "update post set postname='$postname',article='$article',isclose='False' where postid='$postid'";
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($con));
        } else {
            echo "
            <script>
                setTimeout(function(){window.location.href='viewPostList.php?areaid=$areaid&userid=$userid';},200);
            </script>";

        }
    }
    /*
    else {
        echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
    }
    */
?>