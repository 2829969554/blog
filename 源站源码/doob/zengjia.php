
<?php
//$id=$_GET['id'];
//链接数据库
include("config.php");
include("./template/zengjia.html");//引用模板
//判断提交按钮
if(isset($_POST['button'])){
//获取提交数据
	function add($data=''){
		if(!$data){
			return false;	
		}
		$title=$data['title'];
		$content=$data['content'];
		//拼接SQL语句
		$sql="insert into news (title,content) values('$_POST[title]','$_POST[content]')";
		//echo $sql;exit;
		if(mysql_query($sql)){
			header('location:admin.php');	
		}else{
			echo '修改失败';
			exit();	
		}
	}
	add($_POST);
}
$sql="select * from news";
//echo $sql;exit;
$rs=mysql_query($sql);

$rows=mysql_fetch_assoc($rs);


?>
