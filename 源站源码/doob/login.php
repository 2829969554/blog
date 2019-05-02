
<?php
//链接数据库

include("config.php");
//判断是否存在提交按钮
if(isset($_POST['button']) && isset($_POST['username']) && $_POST['username']){
				//获取用户名和密码
				$username=$_POST['username'];
				if(strlen($username)<=4){
					echo '<script>alert("账号长度必须大于4位!");</script>';
				}else{
					$psd=$_POST['password'];
					if(strlen($psd)<=6){
						echo '<script>alert("密码长度必须大于6位!");</script>';
							
					}else{
							//执行sql语句
							$sql="select * from user where username='$username' and password='$psd'";
							//echo $sql;exit;
							$rs=mysql_query($sql);
							//获取结果集的记录
							if(mysql_num_rows($rs)==1){
								session_start();
								$_SESSION['user']=$username;
								echo '<script>window.location.href="admin.php";</script>';	
								
								//header('location:admin.php');
							}
							else{
								echo '<script>alert("登陆失败");</script>';	
							}

						}

				}


}
include "./template/login.html";
?>
