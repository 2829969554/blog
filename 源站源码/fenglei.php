
<?php


// 进行安全的 SQL
session_start();
if (isset($_SESSION['user'])) {
	include("config.php");
//查询总记录数
if($_SESSION['user_type']>7){
    $sql= "select * from blog_type;";
    $ret = $db->query($sql);

    //echo $_SESSION['user_type'];
	//将资源配置成索引数组
	//$sql="select * from news";
	//$sw=mysql_query($sql);
	if(isset($_POST['exit'])){
		unset($_SESSION['user']);
		unset($_SESSION['user_type']);
		unset($_SESSION['key']);
		header('location:login.php');
	}

	if(isset($_GET['ids'])){
	$sql= "delete from blog_type where id=".$_GET['ids'];
	$ret = $db->query($sql);
	header('location:fenglei.php');
	}

	if(isset($_POST['ids'])){
	$sql= "insert into blog_type (id,type) values (".$_POST['ids'].",'".$_POST['names']."');";
	$ret = $db->query($sql);
	header('location:fenglei.php');
	}
	//先用$_gett判断下是否有提交按钮或者输入框                                                                                                
		
	include "template/fenglei.html";
	# code...
}else{

echo "<script>alert('权限不足!');window.location.href='admin.php' </script>";

}

}else{
	//echo "<script>alert('请先登录账号!');</script>";
	header('location:login.php');
}
//链接数据库

$db->close();
?>
