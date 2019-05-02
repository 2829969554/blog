<?php
session_start();
if (isset($_SESSION['user'])) {
//链接数据库
include("config.php");
$ids=$_REQUEST['ids'];

//1\先判断是否为空
if(isok_user($_SESSION['user'])=='假'){
        if(is_array($ids)){
        
        	$idsstr = implode(',',$ids);
        	$sql="delete from blogs where id in($idsstr)";
        	$ret = $db->query($sql);
        	
        	header('location:admin.php');	
        	
        }else{
        
        
        	$sql="delete from blogs where id=$ids";
        
        	$ret = $db->query($sql);
        	header('location:admin.php');	
        
        }
        $db->close();
    }else{
        echo "<script>alert('账号已经被封停,禁止操作!');window.location.href='admin.php';</script>";
        //header('location:admin.php');
    }
}else{
	//echo "<script>alert('请先登录账号!');</script>";
	header('location:login.php');
}
?>