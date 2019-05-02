
<?php


// 进行安全的 SQL
session_start();
if (isset($_SESSION['user'])) {
	include("config.php");
//查询总记录数
if($_SESSION['user_type']>7){
    $sql= "select * from blogs;";
    $ret = $db->query($sql);
}else{

$sql= "select * from blogs where username = '".$_SESSION['user']."';";
$ret = $db->query($sql);
}
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
	if(isset($_POST['button'])){
		function edit($id='',$data=''){
			if(!$id || !$data){
				return false;	
			}	
		}	
	}
	//先用$_gett判断下是否有提交按钮或者输入框
	if(isset($_GET['textfield']) && $_GET['textfield']){
		$subject=$_GET['textfield'];
	//echo $subject;exit;
		$sql="select * from blogs where title like '%".$subject."%' or content like '%".$subject."%' ";
		//echo $sql;exit;
		$ret = $db->query($sql);


	}                                                                                                    
		
	include "template/admin.html";
	# code...
}else{
	//echo "<script>alert('请先登录账号!');</script>";
	header('location:login.php');
}
//链接数据库

$db->close();
?>
