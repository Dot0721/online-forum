<html>
    
<title> Create Area </title>

<?php
    include "style.html";
?>

<?php
    include 'db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $userid = $_POST['userid'];
        $areaname=$_POST['areaname'];
        $manager=$_POST['manager'];
    }
    else{
        $userid = $_GET['userid'];
    }
?>

<style>
    div {
        text-align: center;
    }
    h2 {
        font-size: 28;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 100px;
    }
    .input-field {
        width: 300px;
        height: 50px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-size: 18px;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 90px;
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
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class='bubbles'> <b> Bubbles </b> </button> </a>
    <a href="index.php"> <button class="upper-right-button"> <b> Log out </b> </button> </a>
    <form name="form1" action="createArea.php" method="post">
        <div>
            <h1> Create Area </h1>
            <input type="hidden" name="userid" value="<?=$userid?>">
            <h2> Area Name </h2>
            <input type="text" name="areaname" placeholder="Enter Area Name" class="input-field">
            <h2> Manager Name </h2>
            <input type="text" name="manager" placeholder="Enter Manager Name" class="input-field">
            <br>
            <button type="submit" name="submit" value="SEND" class="send"> <b> Send </b> </button>
        </div>
    </form>
</body>

</html>

<?php
    //送出留言後會執行下面這段程式碼
    if (isset($_POST['submit'])) {
        include "db.php";
        $userid = $_POST['userid'];
        $areaname=$_POST['areaname'];
        $manager=$_POST['manager'];
        $sql="select * from register_user where name = '$manager'";
        $result=mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $manageid=$row['userid'];
        $sql = "update register_user set permission_level=2 where userid='$manageid'";
        mysqli_query($db, $sql);
        $sql = "INSERT post_area(manageid,areaname) VALUES ('$manageid','$areaname')";
        if (!mysqli_query($db, $sql)) {
            die(mysqli_error($db));
        }
        else {
            //若成功將留言存進資料庫，會自動跳轉到顯示留言的頁面
            echo '<div class="success">Added successfully ！</div>';
            echo "
                <script>
                    setTimeout(function(){window.location.href='viewAreaList.php?userid=" . $userid . "';},500);
                </script>";
        }
    }
    /*
    else {
        echo '<div class="success">Click <strong>Send</strong> when you\'re done.</div>';
    }
    */
?>