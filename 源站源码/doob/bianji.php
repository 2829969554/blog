
<?php
//获取修改页面地址
$id=$_GET['id'];
//链接数据库
include("config.php"); 

//新闻内容编辑，获取数据库新闻
function edit($id='',$data=''){
	if(!$id || !$data){
		return false;	
	}
	$title=$data['title'];
	$content=$data['content'];
	//拼接sql语句	 编辑新闻
	$sql="update news set title='$title',content='$content' where id=$id ";
	if(mysql_query($sql)){
		header('location:admin.php');
	}else{
		echo '修改失败';
		exit();
	}
}
if(isset($_POST['button_1'])){
	edit($id,$_POST);	
}
$sql="select * from news where id=$id";
$sw=mysql_query($sql);
$rows=mysql_fetch_assoc($sw);
//检查数据库链接语句
//print_r ($rows);exit;
include("./template/bianji.html"); //引用编辑模板
?>
