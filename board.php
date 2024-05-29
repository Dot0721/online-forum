<html>

<title> Write Post </title>

<?php
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
    h1 {
        font-size: 50;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 110px;
    }
    h2 {
        font-size: 30;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 120px;
    }
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
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 40px;
        cursor: pointer;
    }
    .post-name {
        width: 300px;
        height: 50px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-size: 18px;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 100px;
    }
    .article {
        width: 500px;
        height: 100px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-size: 18px;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 100px;
    }
    .send {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: relative;
        top: 120px;
        cursor: pointer;
    }
</style>

<body>
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class="bubbles"> <b> Bubbles </b> </button> </a>
    <a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>
    <form name="form1" action="board.php" method="post">
        <div>
            <input type="hidden" name="userid" value="<?=$userid?>"> 
            <input type="hidden" name="areaid" value="<?=$areaid?>"> 
            <h1> <?="Hi, " . $name . "!"?> </h1>
            <h2> Postname </h2>
            <p> <input type="text" name="postname" class="post-name"> </p>
            <h2> Article </h2>
            <p> <textarea name="article" class="article"> </textarea> </p>
            <button type="submit" name="submit" value="SEND" class="send"> <b> Send </b> </button>
        </div>
    </form>
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
        }
        else {
        //若成功將留言存進資料庫，會自動跳轉到顯示留言的頁面
            echo "
                <script>
                    setTimeout(function(){window.location.href='viewPostList.php?userid=" . $userid . "&areaid=" . $areaid . "';},500);
                </script>";
        }
    }
    else {
        echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
    }
?>