
<?php
//链接数据库
include("config.php");
//判断注册提交
if(isset($_POST['button'])){
	header("Content-type:text/html; charset=utf-8");
		$username=$_POST['username'];
		$password=$_POST['password'];
		$repassword=$_POST['repassword'];
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
            
                $sql = "select username from user where username = '$_POST[username]'";
                $result =mysql_query($sql);
                $number = mysql_fetch_assoc($result);
                if ($number) {
                    echo '<script>alert("用户名已经存在");history.go(-1);</script>';
                } else {
                    $sql_insert = "insert into user (username,password) values('$_POST[username]','$_POST[password]')";
					//echo $sql_insert;exit;
                    $res_insert =mysql_query($sql_insert);
                    if ($res_insert) {
             	           echo '<script>alert("注册成功请登录！");window.location="login.php";</script>';
                    } else {
                        echo "<script>alert('系统繁忙，请稍候！');</script>";
                    }
                }
           
        }else{
            echo "<script>alert('提交未成功！'); history.go(-1);</script>";
        }

}
include './template/register.html';
?>
