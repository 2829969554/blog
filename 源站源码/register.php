
<?php
//链接数据库
include("config.php");
//判断注册提交
if(isset($_POST['button'])){
	header("Content-type:text/html; charset=utf-8");
	if(strlen($_POST['name'])==0){
		echo '<script>alert("请输入昵称！");history.go(-1);</script>';
		exit(0);
	}
		$name=sql_check_input($_POST['name']);
		$username=sql_check_input($_POST['username']);
		$password=sql_check_input($_POST['password']);
		$repassword=sql_check_input($_POST['repassword']);
	if(strlen($username)<=4){
		echo '<script>alert("账号长度必须大于4位！");history.go(-1);</script>';
		exit(0);	
	}
	if(strlen($password)<=6){
		echo '<script>alert("密码长度必须大于6位！");history.go(-1);</script>';
		exit(0);	
	}
	if($password !=$repassword){
		echo '<script>alert("密码与确认密码应该一致");history.go(-1);</script>';
		exit(0);	
	}
	if($password == $repassword){
            
                $sql = "select * from user where username = $username;";
               	$ret = $db->query($sql);
                if($row = $ret->fetchArray(SQLITE3_ASSOC) ){                
                    echo '<script>alert("用户名已经存在");history.go(-1);</script>';

               	 } else {
               	 if ($_POST['xingbie']=="0") {
               	 	//女生
                 $sql = "insert into user (name,username,password,type,http,good,xingbie,tel,autograph,qq) values($name,$username,$password,0,'nv_niming.png',0,0,'想知道啊?自己来问人家啊,略略略~','这个人很懒,什么也没有留下~','想知道啊?自己来问人家啊,略略略~')";
               	 }else{
               	 	//男生
                 $sql = "insert into user (name,username,password,type,http,good,xingbie,tel,autograph,qq) values($name,$username,$password,0,'niming.jpg',0,1,'想知道啊?自己来问人家啊,略略略~','这个人很懒,什么也没有留下~','想知道啊?自己来问人家啊,略略略~')";
                 }
					//echo $sql_insert;exit;
                 $ret = $db->query($sql);
                 
             	 echo '<script>alert("注册成功请登录！");window.location="login.php";</script>';
                   	
               }
                
           
        }

	}
include './template/register.html';
$db->close();
?>
