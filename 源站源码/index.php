<?php
include("config.php");
session_start();
$sx=0;//防止刷新重复提交


//**获取全部博客
//if(isset($_GET["type"])){
//$sql= "select * from blogs where type=".$_GET["type"].";";
//}else{
    $sql= "select * from blogs;";
//}
$ret = $db->query($sql);

$title_list=array();
$content_list=array();
$id_list=array();
$username_list=array();
$veiws_list=array();
$type_list=array();
$time_list=array();
$message_time_list=array();
$message_id_list=array();
$message_username_list=array();
$message_message_list=array();
$good_list=array();
  while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
	array_push($title_list,$row['title']);
	array_push($content_list,base64_decode($row['content']));
	array_push($id_list,$row['id']);
    array_push($username_list,$row['username']);
    array_push($veiws_list,$row['veiws']);
    array_push($type_list,$row['type']);
	array_push($time_list,$row['time']);
    array_push($good_list,$row['good']);
}
 
if(is_array($_POST)&&count($_POST)>0){
    //评论点赞
    if (isset($_POST['pinglunzan'])) {

        if (isset($_SESSION['user'])) {
            if(isok_user($_SESSION['user'])=='假'){
                $sql = "select * from pinglunzan where username = '".$_SESSION['user']."' and blog_id = ".$id_list[$_POST['id']]." ;";
                $ret = $db->query($sql);
                if($row = $ret->fetchArray(SQLITE3_ASSOC) ){ 
                    echo '<script>alert("亲,你已经点过赞了!");</script>';
                    }else{

                        $sql= "insert into pinglunzan values (null,".$id_list[$_POST['id']].",'".$_SESSION['user']."','".date("Y-m-d")."')";
                        //echo $sql;
                        $ret = $db->query($sql);
                        addpinglunzan($id_list[$_POST['id']]);
                        //echo '<script>alert("点赞成功!");</script>';
                    }
                }else{
                echo "<script>alert('账号已经被封停,禁止操作!');</script>";
                    } 
            }else{
                echo'<script>alert("请登录后提交!");</script>';
            }
    }     

    //处理评论
    if(isset($_POST["message"])){
        //匿名提交
        if(strlen($_POST["message"]) >0){

            if(isset($_POST["nimin_message_submit"])){
                $sql= "insert into message values (null,'匿名"."','".check_input($_POST["message"])."',".$id_list[$_POST['id']].",'".date("Y-m-d H:i:s")."')";
                $ret = $db->query($sql);
                //echo'<script>alert("'.$_POST["message"].'");</script>';
            }
        //实名提交
            if(isset($_POST["shimin_message_submit"])){

            if (isset($_SESSION['user'])) {
                if(isok_user($_SESSION['user'])=='假'){
                    $sql= "insert into message values (null,'".$_SESSION['user']."','".check_input($_POST["message"])."',".$id_list[$_POST['id']].",'".date("Y-m-d H:i:s")."')";
                    $ret = $db->query($sql);
                    }else{
                    echo "<script>alert('账号已经被封停,禁止操作!');</script>";
                      }	
                }else{
                    echo'<script>alert("请登录后提交!");</script>';
                }
            
             }
        }
    }
         //删除评论
         if (isset($_SESSION['user'])) {
            if(isset($_POST["delete_message_submit"]))
            {
                if(isok_user($_SESSION['user'])=='假'){
                    $l_list=$_POST["id"];
                    //echo  $l_list,$l_veiws;
                    $sql= "DELETE from message where id=".$l_list.";";
                    $ret = $db->query($sql);
                    
                }else{
                    echo'<script>alert("账号已经被封停,禁止操作!");</script>';
                }
    
            }
         }
         $sx=123456;
         
//作用防止刷新,BUG
//    
}   

if(is_array($_GET)&&count($_GET)>0)
    {
        //浏览量+1
        if(isset($_GET["list"]))
        {
            
            $l_list=$_GET["list"];
            //防止文章不存在
            if(sizeof($title_list)>$l_list  && $l_list >(-1)){
                $l_veiws=$veiws_list[$l_list]+1;
                //echo  $l_list,$l_veiws;
                $sql ='update blogs set veiws = '.$l_veiws.' where id='.$id_list[$l_list];
                //echo $sql;
                  $ret = $db->exec($sql);
                      //*******获取全部留言
                $sql= "select * from message where blog_id=".$id_list[$l_list].";";
                $ret = $db->query($sql);
                
    
                  while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
                    	array_push($message_username_list,$row['username']);
                    	array_push($message_message_list,$row['message']);
                    	array_push($message_id_list,$row['id']);
                    	array_push($message_time_list,$row['time']);
                    }
            }
        }
    
    
}
//作用防止刷新重复
if($sx==123456){
    echo "<script>window.location.href='".'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."';</script>";
    }else{
        include "./template/index.html";    
    }
    
$db->close();
include("safe.html");
?>