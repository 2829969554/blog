<?php
/*
当前接口版本:V201905012205

我们的接口是向下兼容的
意思就是 模板版本 必须比上面的版本号小 或者 一致才能正常使用
*/
//接口声明
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type:application/json; charset=utf-8');
//初始化数据库
if(!isset($db)){
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open("blog.db");
      }
   }
   $db = new MyDB();
   if(!$db){
      exit($db->lastErrorMsg());
   }
}   
   
 //用户代码区  
 
 
     //获取全部博客分类
    if(isset($_GET['get_blog_type_list'])){
        $intaaa=0;
        $sql= "select * from blog_type;";
        $ret =  $db->query($sql);
        $blog_type_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_type_list['date']['s'.$intaaa]['id']=$row['id'];
           $blog_type_list['date']['s'.$intaaa]['type']=urlencode($row['type']);
            $intaaa=$intaaa+1;
        }  
        $blog_type_list['lang']=$intaaa;
       
        exit(urldecode(json_encode($blog_type_list)));
    }
    
         //获取某博客分类
    if(isset($_GET['get_blog_type']) && isset($_GET['id'])){
        $intaaa=0;
        $sql= "select * from blog_type where id=".$_GET['id'].";";
        $ret =  $db->query($sql);
        $blog_type_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_type_list['date']['id']=$row['id'];
           $blog_type_list['date']['type']=urlencode($row['type']);
            $intaaa=$intaaa+1;
        }  
        $blog_type_list['lang']=$intaaa;
        
        exit(urldecode(json_encode($blog_type_list)));
    }
    
    //获取全部用户分组
if(isset($_GET['get_user_type_list'])){
        $intaaa=0;
        $sql= "select * from user_type;";
        $ret =  $db->query($sql);
        $user_type_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $user_type_list['date']['s'.$intaaa]['id']=$row['id'];
            $user_type_list['date']['s'.$intaaa]['type']=urlencode($row['type']);
            $intaaa=$intaaa+1;
        }  
        $user_type_list['lang']=$intaaa;
        exit(urldecode(json_encode($user_type_list)));
}

         //获取某用户分类
    if(isset($_GET['get_user_type']) && isset($_GET['id'])){
        $intaaa=0;
        $sql= "select * from user_type where id=".$_GET['id'].";";
        $ret =  $db->query($sql);
        $blog_type_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_type_list['date']['id']=$row['id'];
           $blog_type_list['date']['type']=urlencode($row['type']);
            $intaaa=$intaaa+1;
        }  
        $blog_type_list['lang']=$intaaa;
        exit(urldecode(json_encode($blog_type_list)));
    }

//获取全部文章列表
if(isset($_GET['get_blog_list'])){
        $intaaa=0;
        $sql= "select * from blogs;";
        $ret =  $db->query($sql);
        $blog_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_list['date']['s'.$intaaa]['id']=$row['id'];
            $blog_list['date']['s'.$intaaa]['title']=urlencode($row['title']);
            $blog_list['date']['s'.$intaaa]['content']=urlencode($row['content']);
            $blog_list['date']['s'.$intaaa]['veiws']=$row['veiws'];
            $blog_list['date']['s'.$intaaa]['username']=urlencode($row['username']);
            $blog_list['date']['s'.$intaaa]['time']=urlencode($row['time']);
            $blog_list['date']['s'.$intaaa]['type']=$row['type'];
            $blog_list['date']['s'.$intaaa]['good']=$row['good'];
            $intaaa=$intaaa+1;
        }  
        $blog_list['lang']=$intaaa;
        
        exit(urldecode(json_encode($blog_list)));
}

//获取某人博客列表
if(isset($_GET['get_body_blog_list'])  && isset($_GET['username'])){
        $intaaa=0;
        $sql= "select * from blogs where username ='".$_GET['username']."';";
        $ret =  $db->query($sql);
        $blog_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_list['date']['s'.$intaaa]['id']=$row['id'];
            $blog_list['date']['s'.$intaaa]['title']=urlencode($row['title']);
            $blog_list['date']['s'.$intaaa]['content']=urlencode($row['content']);
            $blog_list['date']['s'.$intaaa]['veiws']=$row['veiws'];
            $blog_list['date']['s'.$intaaa]['username']=urlencode($row['username']);
            $blog_list['date']['s'.$intaaa]['time']=urlencode($row['time']);
            $blog_list['date']['s'.$intaaa]['type']=$row['type'];
            $blog_list['date']['s'.$intaaa]['good']=$row['good'];
            $intaaa=$intaaa+1;
        }  
        $blog_list['lang']=$intaaa;
        
        exit(urldecode(json_encode($blog_list)));
}

//获取全部用户列表
if(isset($_GET['get_user_list'])){
        $intaaa=0;
        $sql= "select * from user;";
        $ret =  $db->query($sql);
        $blog_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_list['date']['s'.$intaaa]['id']=$row['id'];
            $blog_list['date']['s'.$intaaa]['username']=urlencode($row['username']);
            $blog_list['date']['s'.$intaaa]['password']=urlencode($row['password']);
            $blog_list['date']['s'.$intaaa]['type']=$row['type'];
            $blog_list['date']['s'.$intaaa]['QQ']=urlencode($row['QQ']);
            $blog_list['date']['s'.$intaaa]['autograph']=urlencode($row['autograph']);
            $blog_list['date']['s'.$intaaa]['tel']=urlencode($row['tel']);
            $blog_list['date']['s'.$intaaa]['http']=urlencode($row['http']);
            $blog_list['date']['s'.$intaaa]['name']=urlencode($row['name']);
            $blog_list['date']['s'.$intaaa]['xingbie']=$row['xingbie'];
            $blog_list['date']['s'.$intaaa]['good']=$row['good'];
            $intaaa=$intaaa+1;
        }  
        $blog_list['lang']=$intaaa;
        
        exit(urldecode(json_encode($blog_list)));
}

//获取某文章评论列表
if(isset($_GET['get_blog_message_list']) && isset($_GET['id'])){
        $intaaa=0;
        $sql= 'select * from message where blog_id='.$_GET['id'].";";
        $ret =  $db->query($sql);
        $blog_message_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_message_list['date']['s'.$intaaa]['id']=$row['id'];
            $blog_message_list['date']['s'.$intaaa]['username']=urlencode($row['username']);
            $blog_message_list['date']['s'.$intaaa]['message']=urlencode($row['message']);
            $blog_message_list['date']['s'.$intaaa]['blog_id']=$row['blog_id'];
            
            $blog_message_list['date']['s'.$intaaa]['time']=urlencode($row['time']);
            
            $intaaa=$intaaa+1;
        }  
        $blog_message_list['lang']=$intaaa;
        
        exit(urldecode(json_encode($blog_message_list)));
}

//获取某文章信息
if(isset($_GET['get_blog']) && isset($_GET['id'])){
        $intaaa=0;
        $sql= "select * from blogs where id=".$_GET['id'].";";
        $ret =  $db->query($sql);
        $blog_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_list['date']['id']=$row['id'];
            $blog_list['date']['title']=urlencode($row['title']);
            $blog_list['date']['content']=urlencode($row['content']);
            $blog_list['date']['veiws']=$row['veiws'];
            $blog_list['date']['username']=urlencode($row['username']);
            $blog_list['date']['time']=urlencode($row['time']);
            $blog_list['date']['type']=$row['type'];
            $blog_list['date']['good']=$row['good'];
            $intaaa=$intaaa+1;
        }  
        $blog_list['lang']=$intaaa;
       
        exit(urldecode(json_encode($blog_list)));
}

//获取某用户信息id
if(isset($_GET['get_user']) && isset($_GET['id'])){
        $intaaa=0;
        $sql= "select * from user where id=".$_GET['id'].";";
        $ret =  $db->query($sql);
        $blog_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_list['date']['id']=$row['id'];
            $blog_list['date']['username']=urlencode($row['username']);
            $blog_list['date']['password']=urlencode($row['password']);
            $blog_list['date']['type']=$row['type'];
            $blog_list['date']['QQ']=urlencode($row['QQ']);
            $blog_list['date']['autograph']=urlencode($row['autograph']);
            $blog_list['date']['tel']=urlencode($row['tel']);
            $blog_list['date']['http']=urlencode($row['http']);
            $blog_list['date']['name']=urlencode($row['name']);
            $blog_list['date']['xingbie']=$row['xingbie'];
            $blog_list['date']['good']=$row['good'];
            $intaaa=$intaaa+1;
        }  
        $blog_list['lang']=$intaaa;
        
        exit(urldecode(json_encode($blog_list)));
}

//获取某用户信息username
if(isset($_GET['get_user']) && isset($_GET['username'])){
        $intaaa=0;
        $sql= "select * from user where username='".$_GET['username']."';";
        $ret =  $db->query($sql);
        $blog_list=array();
       
         while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
            $blog_list['date']['id']=$row['id'];
            $blog_list['date']['username']=urlencode($row['username']);
            $blog_list['date']['password']=urlencode($row['password']);
            $blog_list['date']['type']=$row['type'];
            $blog_list['date']['QQ']=urlencode($row['QQ']);
            $blog_list['date']['autograph']=urlencode($row['autograph']);
            $blog_list['date']['tel']=urlencode($row['tel']);
            $blog_list['date']['http']=urlencode($row['http']);
            $blog_list['date']['name']=urlencode($row['name']);
            $blog_list['date']['xingbie']=$row['xingbie'];
            $blog_list['date']['good']=$row['good'];
            $intaaa=$intaaa+1;
        }  
        $blog_list['lang']=$intaaa;
       
        exit(urldecode(json_encode($blog_list)));
}
//文章评论
if(isset($_GET['new_message']) && isset($_GET['id'])  && isset($_GET['message']) && isset($_GET['name']) ){
    $time=date("Y-m-d H:i:s");
        $sql= "insert into message values (null,'".$_GET['name']."','".$_GET["message"]."',".$_GET['id'].",'".$time."')";
        $ret = $db->query($sql);
        $blog_list['name']=$_GET['name'];
        $blog_list['message']=$_GET["message"];
        $blog_list['time']=$time;
        $blog_list['lang']=1;
        exit(urldecode(json_encode($blog_list)));
}

//新建文章
// &&  isset($_GET['password']
if(isset($_GET['new_blog']) && isset($_POST['title'])  && isset($_POST['content']) && isset($_POST['username'])  &&  isset($_POST['type']) ){
    $sql="insert into blogs (title,content,veiws,username,time,type,good) values ('".$_POST['title']."','".base64_encode($_POST['content'])."',0,'".$_POST['username']."','".date("Y-m-d H:i:s")."',".$_POST['type'].",0)";
    $ret =  $db->query($sql);

    $sql= "select * from blogs where title='".$_POST['title']."' and content='".base64_encode($_POST['content'])."';";
    
    $ret =  $db->query($sql);
    $json=array();
    $verify=0;
     while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
     	$verify=$verify+1;
    }
    if($verify==0){
	     $json['type']="no";
	     $json['username']=urlencode($_POST['username']);
	}else{
	     $json['type']="yes";
	     $json['username']=urlencode($_POST['username']);
	}
     exit(urldecode(json_encode($json)));
	}


exit('{"状态":"不能识别当前接口"}');
//关闭数据库
$db->close();
?>