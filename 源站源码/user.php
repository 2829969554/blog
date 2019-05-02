<?php
session_start();
if (isset($_SESSION['user'])) {
    if($_SESSION['user_type']>7){
        include "config.php";
        if (isset($_GET['textfield']) && $_GET['textfield']) {
             $sql= "select * from user where name like '%".$_GET['textfield']."%' or username like '%".$_GET['textfield']."%';";
             $ret = $db->query($sql);
            # code...
        }else{
                    $sql= "select * from user;";
        $ret = $db->query($sql);      
        }

        //while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        //    echo "<p>".$row['id']."\t".$row['username']."\t".$row['password']."\n</p>";
        //}
        include "./template/user.html";
        $db->close();
    }else{
        echo "<script>alert('权限不足,请不要越权操作!');window.location.href='admin.php';</script>";
    }
}else{
    		header('location:login.php');
}
?>
