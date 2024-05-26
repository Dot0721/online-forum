<html>

<title> Login </title>

<style>
    h1 {
        font: bold;
        font-size: 50;
        font-family: 'Nunito', sans-serif;
        position: fixed;
        right: 475px;
        top: 80px;
    }
    .dir {
        color: grey;
        position: fixed;
        right: 515px;
        top: 175px;
    }
    .name {
        width: 295px;
        height: 48px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-family: 'Nunito', sans-serif;
        font-size: 19px;
        position: fixed;
        right: 500px;
        top: 250px;
    }
    .passwd {
        width: 295px;
        height: 48px;
        padding: 12px 16px;
        border: solid;
        border-radius: 5px;
        font-family: 'Nunito', sans-serif;
        font-size: 19px;
        position: fixed;
        right: 500px;
        top: 325px;
    }
    .signin {
        width: 90px;
        height: 40px;
        color: white;
        background-color: black;
        position: fixed;
        right: 600px;
        top: 425px;
        border-radius: 5px;
    }
    .view {
        width: 150px;
        height: 40px;
        border: none;
        position: fixed;
        right: 570px;
        top: 500px;
    }
    .signup {
        width: 90px;
        height: 40px;
        color: white;
        background-color: black;
        position: fixed;
        right: 80px;
        top: 56px;
        border-radius: 5px;
    }
</style>

<?php
header("Content-Type: text/html; charset=utf8");
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

<body>
    <a href="signup.php"> <button class="signup"> Sign Up </button> </a>
    <form name="login" action="index.php" method="post">
        <h1> Good Morning! </h1>
        <p class="dir"> Welcome to Bubbles, sign in to get started. </p>
        <p> <input type="text" name="name" placeholder="User Name" class="name"> </p>
        <p> <input type=password name="password" placeholder="Password" class="passwd"> </p>
        <button type="submit" name="submit" class="signin"> <b> Sign In </b> </button>
    </form>
    <a href="viewAreaList.php?userid="$_GET['userid']""> <button class="view"> <b> View as Anonymous </b> </button> </a>
</body>

</html>