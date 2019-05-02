
<?php
session_start();
if (isset($_SESSION['user'])) {
	include("config.php");
//查询总记录数
	$sr=mysql_query('select count(*) c from news');
	//将资源配置成索引数组
	//$sql="select * from news";
	//$sw=mysql_query($sql);
	if(isset($_POST['exit'])){
		unset($_SESSION['user']);
		header('location:login.php');
	}
	if(isset($_POST['button'])){
		function edit($id='',$data=''){
			if(!$id || !$data){
				return false;	
			}	
		}	
	}
	//先用$_post判断下是否有提交按钮或者输入框
	if(isset($_GET['textfield']) && $_GET['textfield']){
		$subject=$_GET['textfield'];
	//echo $subject;exit;
		$sql="select * from news where title like '%".$subject."%' or content like '%".$subject."%' ";
		//echo $sql;exit;
		$sw=mysql_query($sql);
	}else{
		$sw=mysql_query("select * from news  order by id desc");// limit 10
	}                                                                                                    
		
	include "template/admin.html";
	# code...
}else{
	//echo "<script>alert('请先登录账号!');</script>";
	header('location:login.php');
}
//链接数据库


?>
