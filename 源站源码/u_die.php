<?php
session_start();
if (isset($_SESSION['user'])) {
    if($_SESSION['user_type']>7){
        //链接数据库
        include("config.php");
        $ids=$_REQUEST['ids'];
        if(isok_user($_SESSION['user'])=='假'){

            
            //1\先判断是否为空
            
            if(is_array($ids)){
            
            	$idsstr = implode(',',$ids);
            	$sql="delete from user where id in($idsstr)";
            	$ret = $db->query($sql);
            	
            	header('location:user.php');	
            	
            }else{
            
            
            	$sql="delete from user where id=$ids";
            
            	$ret = $db->query($sql);
            	header('location:user.php');	
            
            }
            $db->close();
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