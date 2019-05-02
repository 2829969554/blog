
<?php

session_start();
if (isset($_SESSION['user'])) {
include("config.php"); 

if(isset($_POST['button_1'])){
    if(isok_user($_SESSION['user'])=='假'){
    	$title=check_input($_POST['title']);
    	$content=check_input($_POST['content']);
    
    	$sql="update blogs set title='".$title."',content='".base64_encode($content)."' where id=".$_GET['id'].";";
    	//echo "$sql";
    	$ret = $db->query($sql);
    
    	header('location:admin.php');
    }else{
        echo "<script>alert('账号已经被封停,禁止操作!');</script>";
    }
}

$sql="select * from blogs where id=".$_GET['id'].";";

$ret = $db->query($sql);
$row = $ret->fetchArray(SQLITE3_ASSOC);
//检查数据库链接语句
//print_r ($rows);exit;
include("./template/bianji.html"); //引用编辑模板
$db->close();
}else{
    header('location:login.php');
}
?>
