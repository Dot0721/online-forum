<html>

<title> Edit User Information </title>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $postid=$_POST['postid'];
        $userid=$_POST['userid'];
        $areaid=$_POST['areaid'];
        $name=$_POST['name'];
        $passwotd=$_POST['password'];
        $conpass=$_POST['conpass'];
    }
    else {
        $postid=$_GET['postid'];
        $userid=$_GET['userid'];
        $areaid=$_GET['areaid'];
    }
?>

<style>
    div {
        text-align: center;
    }
    h1 {
        font: bold;
        font-size: 50;
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
    .warn {
        width: 624px;
        height: 30px;
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        color: #828282;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        margin-top: auto; 
    }
    .log-out {
        width: 100px;
        height: 50px;
        font-size: 16;
        color: white;
        background: black;
        border-radius: 5px;
        position: fixed;
        top: 40px;
        right: 40px;
        cursor: pointer;
    }
    .text{
        width: 100px;
        height: 30px;
        color: black;
        justify-content: center;
        position: relative;
        padding: 0;
        left: 50%; 
        transform: translateX(-50%);
        font-family: 'Nunito', sans-serif;
        top: 110px;
    }
    .name {
        width: 300px;
        height: 50px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-size: 18px;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 110px;
    }
    .passwd {
        width: 300px;
        height: 50px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-size: 18px;
        font-family: 'Nunito', sans-serif;
        position: relative;
        top: 110px;
    }
    .save {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: relative;
        top: 130px;
        left: 0%;
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
        top: 130px;
        right: 0%;
        cursor: pointer;
    }
    .warning {
        width: 100%; /* 設置寬度佔滿整個頁面 */
        height: 30px;
        font-family: 'Inter', sans-serif;
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 30px; /* 確保行高與高度相同 */
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #ffffff; /* 白色文字 */
        background-color: #ff0000; /* 紅色背景 */
        position: fixed; /* 固定位置 */
        top: 0; /* 固定在頂部 */
        left: 0; /* 從左邊開始 */
        z-index: 1000; /* 確保在其他元素上方 */
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); /* 添加陰影 */
}
</style>

<body>
    <a href='viewAreaList.php?userid=<?=$userid?>'> <button class='bubbles'> <b> Bubbles </b> </button> </a>
    <a href="index.php"> <button class="log-out"> <b> Log out </b> </button> </a>
    <?php
        include 'db.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $query = "SELECT * FROM register_user WHERE  userid=" . $_POST['userid'] .""; 
        }
        else {
            $query = "SELECT * FROM register_user WHERE  userid=" . $_GET['userid'] .""; 
        }
        $result = mysqli_query($db, $query);
        while ($rs = mysqli_fetch_array($result)) {
    ?>
    <form name="form1" action="editUser.php" method="post">
        <div>
            <h1> Edit User Information </h1>
            <p class="warn">Password should contain at least a number and an alphabet.</p>
            <input type="hidden" name="postid" value="<?=$postid?>">
            <input type="hidden" name="userid" value="<?=$rs['userid']?>">
            <input type="hidden" name="areaid" value="<?=$areaid?>">
            <p class="text">User name</p>
            <p> <input type="text" name="name" class="name" > </p>
            <p class="text">Password</p>
            <p> <input type="text" name="password" class="passwd"> </p>
            <p class="text">Confirm password</p>
            <p> <input type="text" name="conpass"  class="passwd"> </p>
            <button type="submit" name="submit" value="SAVE" class="save"> <b> Save </b> </button>
            <button type="reset" name="Reset" value="REWRITE" class="rewrite"> <b> Rewrite </b> </button>
        </div>
    </form>
</body>

</html>

<?php }
    if (isset($_POST['submit'])) {
        $postid=$_POST['postid'];
        $userid=$_POST['userid'];
        $areaid=$_POST['areaid'];
        $name=$_POST['name'];
        $password=$_POST['password'];
        $conpass=$_POST['conpass'];
        if($conpass==$password){
            $sql = "update register_user set password='$password',name='$name' where userid='$userid'";
            if (!mysqli_query($db, $sql)) {
                die(mysqli_error($con));
            }
            else {
                echo "
                <script>
                    setTimeout(function(){window.location.href='viewAreaList.php?areaid=$areaid&userid=$userid';},200);
                </script>";
            } 
        }
        else{
            echo '<div class="warning">The password and confirmation password do not match！</div>';
        }
    }
?>