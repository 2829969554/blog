<?php
include "config.php";
session_start();
if (isset($_SESSION['user'])) {
    if($_SESSION['user_type']>7){
        if(isok_user($_SESSION['user'])=='假'){
        
            $sql ='update user set type = '.$_GET['to'].' where id='.$_GET['ids'];
                //echo $sql;
                  $ret = $db->exec($sql);
                  header('location:user.php');
        }else{
        echo "<script>alert('账号已经被封停,禁止操作!');window.location.href='user.php';</script>";
    }
    }else{
        echo "<script>alert('权限不足,请不要越权操作!');window.location.href='admin.php';</script>";
    }
}else{
	
	//header('location:user.php');
		header('location:login.php');
}
?>