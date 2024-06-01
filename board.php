<html>

<title> Write Post </title>

<?php
    include "style.html";
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userid = $_POST['userid'];
        $areaid=$_POST['areaid'];
        $postname = $_POST['postname'];
        $article = $_POST['article'];
    }
    else {
        $userid = $_GET['userid'];
        $areaid = $_GET['areaid'];
    }
    $sql = "select * from register_user where userid=$userid";
    $result = mysqli_query($db, $sql);
    $output=mysqli_fetch_assoc($result);
    $name=$output['name'];
?>

<style>
    div {
        text-align: center;
    }
</style>

<body>
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class="bubbles"> <b> Bubbles </b> </button> </a>
    <a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>
    <?php
        echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
        echo "<a href='viewPostList.php?areaid=$areaid&userid=$userid'> <button class='last-page'> <b> All Posts </b> </button> </a>";
    ?>
    <form name="form1" action="board.php" method="post">
        <div>
            <input type="hidden" name="userid" value="<?=$userid?>"> 
            <input type="hidden" name="areaid" value="<?=$areaid?>"> 
            <h1> <?="Hi, " . $name . "!"?> </h1>
            <p class="dir"> It's time to write your post! </p>
            <h2> Postname </h2>
            <input type="text" name="postname" placeholder="Enter Your Postname" class="input-field">
            <h2> Article </h2>
            <textarea name="article" placeholder="Enter Your content"></textarea>
            <br>
            <button type="submit" name="submit" value="SEND" class="submit"> <b> Send </b> </button>
        </div>
    </form>
</body>

</html>

<?php
    //送出留言後會執行下面這段程式碼
    if (isset($_POST['submit'])) {
        include "db.php";
        echo '<div class="success"> Your Post Added Successfully！ </div>';
        $userid = $_POST['userid'];
        $areaid=$_POST['areaid'];
        $postname = $_POST['postname'];
        $article = $_POST['article'];
        $sql = "INSERT post(uid,aid,postname,article) VALUES ('$userid', '$areaid', '$postname', '$article')";
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($db));
        }
        else {
        //若成功將留言存進資料庫，會自動跳轉到顯示留言的頁面
            echo "
                <script>
                    setTimeout(function(){window.location.href='viewPostList.php?userid=" . $userid . "&areaid=" . $areaid . "';},500);
                </script>";
        }
    }
    /*
    else {
        echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
    }
    */
?>