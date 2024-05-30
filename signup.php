<html>

<title> Sign up </title>

<?php
    include 'style.html';
?>

<!-- 留言者按下Signup後接著會執行以下程式碼 -->
<?php
    //header("Content-Type: text/html; charset=utf8");
    if (isset($_POST['submit'])) { 
        include 'db.php';
        $name = $_POST['name'];
        $password = $_POST['password'];
        if ($name && $password) {
            $sql = "select * from register_user where name = '$name'";
            $result = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($result);
            if (!$rows) { //若這個username還未被使用過
                $sql = "insert register_user(permission_level,name,password) values (1,'$name','$password')";
                mysqli_query($db, $sql);

                if (!$result) {
                    die('Error: ' . mysqli_error($con));
                } else {
                    $userid = mysqli_insert_id($db);
                    echo '<div class="success">Sign up successfully ！</div>';
                    echo "
                        <script>
                        setTimeout(function(){window.location.href='viewAreaList.php?userid=" .$userid . "';},600);
                        </script>";
                }
            }
            else { //這個username已被使用
                echo '<div class="warning">The Username has already been used ！</div>';
                echo "
                    <script>
                        setTimeout(function(){window.location.href='signup.php';},1000);
                    </script>";
            }
        }
        else {

            echo '<div class="warning">Incompleted form！ </div>';
            //以下為javascript語法，註冊成功後會自動跳轉到登入頁面
            echo "
                <script>
                    setTimeout(function(){window.location.href='login.php';},2000);
                </script>";
        }
        mysqli_close($db);
    }
?>

<style>
    div {
        text-align: center;
    }
</style>

<body>
    <a href="index.php"> <button class="upper-right-button"> <b> Login </b> </button> </a>
    <form name="signup" action="signup.php" method="post">
        <div>
            <h1> Create Your Account </h1>
            <p class="dir"> Password should contains at least a number and an alphabet. </p>
            <h2> User Name </h2>
            <input type="text" name="name" placeholder="Enter User Name" class="input-field">
            <h2> Password </h2>
            <input type=password name="password" placeholder="Enter Password" class="input-field">
            <br>
            <button type="submit" name="submit" value="Sign up" class="submit"> <b> Create </b> </button>
        </div>
    </form>
</body>

</html>