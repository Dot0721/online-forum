<html>

<title> Edit User Information </title>

<?php
    include "style.html";
?>

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
            <p class="dir"> Password should contain at least a number and an alphabet. </p>
            <input type="hidden" name="postid" value="<?=$postid?>">
            <input type="hidden" name="userid" value="<?=$rs['userid']?>">
            <input type="hidden" name="areaid" value="<?=$areaid?>">
            <h2> User name </h2>
            <input type="text" name="name" value="<?=$rs['name']?>"class="input-field" >
            <h2> Password </h2>
            <input type="text" name="password" placeholder="Enter Your New Password" class="input-field">
            <h2> Confirm password </h2>
            <input type="text" name="conpass" placeholder="Enter Your Password Again" class="input-field">
            <br>
            <button type="submit" name="submit" value="SAVE" class="save"> <b> Save </b> </button>
            <button type="reset" name="Reset" value="REWRITE" class="rewrite"> <b> Rewrite </b> </button>
        </div>
    </form>
    <footer></footer>
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