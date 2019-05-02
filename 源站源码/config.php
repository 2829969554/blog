<?php

//客户设备唯一标识
function getkey(){
    if(isset($_SESSION['user'])){
        return sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].$_SESSION['user']);
    }else{
        return sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
    }
}

//sql参数初始化
function sql_check_input($value){
    return '"'.preg_replace('# #','',$value).'"';
}

//处理数据
function check_input($value){

    $sts=preg_replace('#document#','<b>document</b>',$value);
    $sts=preg_replace('#window#','<b>window</b>', $sts);
    $sts=preg_replace('#.js#','<b>.js</b>',$sts);
    $sts=preg_replace('#eval#','<b>eval</b>',$sts);
    return $sts;
}
//评论赞+1
function addpinglunzan($id){
    global $db;
    //blogs表
    $sql='select * from blogs where id='.$id.';';
    $ret = $db->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    $liang=$row['good']; 
    $username=$row['username'];  
    $liang=$liang + 1;
    $sql="update blogs set good = ".$liang." where id =".$id." ;";
    $ret = $db->query($sql);
    //user表
    $sql='select * from user where username="'.$username.'";';
    $ret = $db->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    $liang=$row['good'];  
    $liang=$liang + 1;
    $sql="update user set good = ".$liang." where username ='".$username."' ;";
    $ret = $db->query($sql);
}

//评论赞是否存在
function isok_pinglunzan($username,$id){
    $sql = "select * from pinglunzan where username = '".$username."' and blog_id = ".$id." ;";
    global $db;
    $ret = $db->query($sql);
    if($row = $ret->fetchArray(SQLITE3_ASSOC) ){ 
        return("真");
    }else{
        return("假");
    }
}

//取用户评论量
function getpinglun_user($username){
    global $db;
    //echo $username;
    $sql='select * from message where username='.sql_check_input($username).';';
    //echo $sql;
    $ret = $db->query($sql);
    $index=0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $index=$index+1;  
    }
    return $index;
}

//取用户信息
function getinfo_user($username,$str){
    global $db;
    //echo $username;
    $sql='select * from user where username='.sql_check_input($username).';';
    //echo $sql;
    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      return $row[$str];       
    }
    return '*';
}

//取用户发帖量
function getyuanchuang_user($username){
    global $db;
    //echo $username;
    $sql='select * from blogs where username='.sql_check_input($username).';';
    //echo $sql;
    $ret = $db->query($sql);
    $index=0;
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        $index=$index+1;  
    }
    return $index;
}

//账号查昵称
function getname_user($username){
    global $db;
    //echo $username;
    $sql='select * from user where username='.sql_check_input($username).';';
    //echo $sql;
    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
      return $row['name'];       
    }
    return '在下无名';
}

//是否被封号
function isok_user($username){
    global $db;
    //echo $username;
    $sql='select * from user where username='.sql_check_input($username).';';
    //echo $sql;
    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
        if($row['type']==-1){
            return '真';
        }else{
            return '假';
       }
        
    }
    return '假';
}
//返回头像名称
function gettx_user($username){
    global $db;
    //echo $username;
    $sql='select * from user where username='.sql_check_input($username).';';
    //echo $sql;
    $ret = $db->query($sql);
    while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
       return $row['http'];      
    }
    return '空';
}
//初始化数据库
if(!isset($db)){
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('blog.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } 
}
//验证环境如果不对则失效   
if(isset($_SESSION['user'])){
    if($_SESSION['key']!=getkey()){
        unset($_SESSION['user']);
		unset($_SESSION['user_type']);
		unset($_SESSION['key']);
		 echo '<script>alert("登录状态超时,请重新登陆!");</script>'; 
		 echo '<script>window.location.href="login.php";</script>';
	//	header('location:login.php');
    }
}

//**获取博客分组
$sql= "select * from blog_type;";
$ret =  $db->query($sql);
$blog_list=array();

  while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
	array_push($blog_list,$row['type']);

}
//**获取用户分组
$sql= "select * from user_type;";
$ret = $db->query($sql);
$user_type_list=array();
$user_type_id=array();
  while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
	array_push($user_type_list,$row['type']);
	array_push($user_type_id,$row['id']);

}
?>
