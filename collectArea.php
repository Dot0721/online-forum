<?php
    include "db.php";
    session_start();
    $userid = $_GET['userid'];
    $areaid = $_GET['areaid'];
    header("Location: viewAreaList.php?userid=$userid");
    $sql ="select * from collect_area where uid=$userid and aid=$areaid";
    $result = mysqli_query($db,$sql);
    if ($rows = mysqli_num_rows($result)==0){
        $sql = "INSERT INTO collect_area (uid, aid) VALUES ('$userid', '$areaid')";
        if (!mysqli_query($db, $sql)) {
            die('Error: ' . mysqli_error($db));
        }
        else {
            echo "
            <script>
                setTimeout(function(){window.location.href = 'viewAreaList.php?userid=$userid;},200);
            </script>";
        }
    }
    else {
        $sql = "DELETE FROM collect_area WHERE uid=$userid and aid=$areaid";
        if (!mysqli_query($db, $sql)) {
            die('Error: ' . mysqli_error($db));
        }
        else {
            echo "
            <script>
                setTimeout(function(){window.location.href = 'viewAreaList.php?userid=$userid;},200);
            </script>";
        }
    }
    // 假设 $db 是已连接的数据库连接对象
?>