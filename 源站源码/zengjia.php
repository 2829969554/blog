<?php
session_start();
if (isset($_SESSION['user'])) {
include("config.php");

//判断提交按钮
if(isset($_POST['button'])){
//获取提交数据
    if(isok_user($_SESSION['user'])=='假'){
		$title=check_input($_POST['title']);
		$content=base64_encode(check_input($_POST['content']));
		//拼接SQL语句

		$sql="insert into blogs (title,content,veiws,username,time,type,good) values ('$title','$content',0,'".$_SESSION['user']."','".date("Y-m-d H:i:s")."',".$_POST['type'].",'0')";
		//echo $sql;
		//echo $sql;exit;
		$ret = $db->query($sql);	
		header('location:admin.php');	
    }else{
        echo "<script>alert('账号已经被封停,禁止操作!');</script>";
    }	

}

include("./template/zengjia.html");//引用模板
$db->close();
}else{
	//echo "<script>alert('请先登录账号!');</script>";
	header('location:login.php');
}
?>
