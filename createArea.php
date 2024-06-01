<html>
    
<title> Create Area </title>

<?php
    include "style.html";
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
</style>

<body>
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class='bubbles'> <b> Bubbles </b> </button> </a>
    <a href="index.php"> <button class="upper-right-button"> <b> Log Out </b> </button> </a>
    <?php
        echo "<a href='userinfo.php?userid=" . $userid . "&areaid=0&postid=0'> <button class='account'> <b> Account </b> </button> </a>";
    ?>
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class='last-page'> <b> Last Page </b> </button> </a>
    <form name="form1" action="createArea.php" method="post">
        <div>
            <h1> Create Area </h1>
            <input type="hidden" name="userid" value="<?=$userid?>">
            <p class="dir"> Create an area and assign a manager </p>
            <h2> Area Name </h2>
            <input type="text" name="areaname" placeholder="Enter Area Name" class="input-field">
            <h2> Manager Name </h2>
            <input type="text" name="manager" placeholder="Enter Manager Name" class="input-field">
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
        $userid = $_POST['userid'];
        $areaname=$_POST['areaname'];
        $manager=$_POST['manager'];
        $sql="select * from register_user where name = '$manager'";
        $result=mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $manageid=$row['userid'];
        if ($row['permission_level'] == 1) {
            $sql = "update register_user set permission_level=2 where userid='$manageid'";
            mysqli_query($db, $sql);
        }
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