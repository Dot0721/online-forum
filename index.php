<html>

<title> Login </title>

<?php
    include 'style.html';
?>

<?php
    //header("Content-Type: text/html; charset=utf8");
    if (isset($_POST['submit'])) {
        include 'db.php';
        $name = $_POST['name'];
        $password = $_POST['password'];
        if ($name && $password) {
            $sql = "select * from register_user where name = '$name' and password='$password'";
            $result = mysqli_query($db, $sql);
            $rows = mysqli_num_rows($result);
            if ($rows) {
                $output=mysqli_fetch_assoc($result);
                $userid=$output['userid'];
                echo '<div class="sucess">welcome！ </div>';
                echo "
                <script>
                setTimeout(function(){window.location.href='viewAreaList.php?userid=" .$userid . "';},600);
                </script>";
                exit;
            }
            else {
                echo '<div class="warning">Wrong Username or Password！</div>';
            }
        }
        else {
            echo '<div class="warning">Incompleted form！ </div>';
            echo "<script> setTimeout(function(){window.location.href='index.php';},2000); </script>";
        }
        mysqli_close($db);
    }
?>

<style>
    div {
        text-align: center;
    }
    .dir {
        color: grey;
        font-size: 18;
        position: relative;
        top: 90px;
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
        top: 80px;
    }
    .login {
        width: 100px;
        height: 50px;
        color: white;
        font-size: 16;
        background: black;
        border-radius: 5px;
        position: relative;
        top: 110px;
        cursor: pointer;
    }
    .view {
        width: 170px;
        height: 50px;
        font-size: 16;
        border: none;
        background: none;
        position: relative;
        top: 120px;
        cursor: pointer;
    }
</style>

<body>
    <a href="signup.php"> <button class="upper-right-button"> <b> Sign Up </b> </button> </a>
    <form name="login" action="index.php" method="post">
        <div>
            <h1> Welcome to Bubbles! </h1>
            <p class="dir"> Sign in to get started. </p>
            <h2> User Name </h2>
            <input type="text" name="name" placeholder="Enter Your User Name" class="input-field">
            <h2> Password </h2>
            <input type=password name="password" placeholder="Enter Your Password" class="input-field">
            <br>
            <button type="submit" name="submit" class="login"> <b> Login </b> </button>
            <br>
        </div>
    </form>
    <div>
        <a href="viewAreaList.php?userid="> <button class="view"> <b> View as Anonymous </b> </button> </a>
    </div>
</body>

</html>