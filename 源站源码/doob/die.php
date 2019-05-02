<?php
//链接数据库
include("config.php");
$ids=$_REQUEST['ids'];

//1\先判断是否为空

if(is_array($ids)){
	/*foreach($ids as $v){
		$sql="delete from news where id=$v";
		mysql_query($sql);
	}*/
	$idsstr = implode(',',$ids);
	$sql="delete from news where id in($idsstr)";
	mysql_query($sql);
	
	header('location:admin.php');	
	
}else{

	//拼接sql语句
	//$sql="select * from news";
	$sql="delete from news where id=$ids";
	//echo $sql;exit;
	if(mysql_query($sql)){
		header('location:admin.php');	
	}else{
		die(mysql_error())	;
	}
}
?>