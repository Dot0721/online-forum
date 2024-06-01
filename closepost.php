<?php
    include 'style.html';
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $violate=$_POST['violate'];
        $postid = $_POST['postid'];
        $userid=$_POST['userid'];
        $areaid=$_POST['areaid'];
    }
    else {
        $postid=$_GET['postid'];
        $userid=$_GET['userid'];
        $areaid=$_GET['areaid'];
    }
?>

<html>

<title> Close Post </title>

<style>
    div {
        text-align: center
    }
</style>

<body>
    <a href='viewAreaList.php?userid=".$userid."'> <button class='bubbles'> <b> Bubbles </b> </button> </a>
    <a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>
    <a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>
    <a href='viewPostDetail.php?postid=<?=$postid?>&userid=<?=$userid?>&areaid=<?=$areaid?>'> <button class='last-page'> <b> Last Page </b> </button> </a>
    <div>
        <form name="form1" action="closepost.php" method="post">
            <input type="hidden" name="postid" value="<?=$postid?>">
            <input type="hidden" name="userid" value="<?=$userid?>">
            <input type="hidden" name="areaid" value="<?=$areaid?>">
            <h1> Close Post </h1>
            <p class="dir"> Select the reason why close this post. </p>
            <h2> Violation Reason </h2>
            <select>
                <option> Hate or discriminatory content </option> <!-- 仇恨或歧視內容 -->
                <option> Violent or pornographic content </option> <!-- 暴力或色情內容 -->
                <option> Invasion of privacy </option> <!-- 侵犯他人隱私 -->
                <option> Spam </option> <!-- 垃圾訊息 -->
                <option> Fraudulent or misleading content </option> <!-- 欺詐或誤導內容 -->
                <!-- <option> 違反特定版區規則 </option> -->
            </select>
            <br>
            <button type="submit" name="submit" value="SELECT" class="submit"> Submit </button>       
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
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($con));
        }
        $sql ="delete from likeuserid where pid=$postid";
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($con));
        }
        $sql = "delete from post where postid='$postid'";
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($con));
        }
        else {
            echo "
            <script>
                setTimeout(function(){window.location.href='viewPostList.php?areaid=$areaid&userid=$userid';},200);
            </script>";

        }
    }
?>