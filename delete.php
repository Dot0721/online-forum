<?php
include "db.php";
session_start();
$postid=$_GET['postid'];
$userid=$_GET['userid'];
$areaid=$_GET['areaid'];
$sql = "delete from post where postid='$postid'";
mysqli_query($db, $sql);
if (!mysqli_query($db, $sql)) {
	die(mysqli_error($con));
} else {
	echo "
         <script>
         setTimeout(function(){window.location.href='viewPostList.php?areaid=$areaid&userid=$userid';},200);
        </script>";

}
