
<?php
//链接数据库

include("config.php");
//判断是否存在提交按钮
if(isset($_POST['button']) && isset($_POST['username']) && $_POST['username']){
				//获取用户名和密码
				$username=sql_check_input($_POST['username']);
				if(strlen($username)<=4){
					echo '<script>alert("账号长度必须大于4位!");</script>';
				}else{
					$psd=sql_check_input($_POST['password']);
					if(strlen($psd)<=6){
						echo '<script>alert("密码长度必须大于6位!");</script>';
							
					}else{
							//执行sql语句
							//安全sql
							$sql="select * from user where username=$username and password=$psd;";
						//	echo $sql;exit;
							$ret = $db->query($sql);
							//获取结果集的记录
							  while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
							      if(isok_user($row['username'])=='假'){
								session_start();
								$_SESSION['user']=$row['username'];
								$_SESSION['user_type']=$row['type'];
								$_SESSION['user_id']=$row['id'];
								$_SESSION['key']=getkey();
								echo '<script>window.location.href="admin.php";</script>';	
								
							  }else{
							     echo '<script>alert("该账户已被封停!");</script>'; 
							  }
								//header('location:admin.php');
							  }	
								echo '<script>alert("登陆失败");history.back(-1);</script>';	
							
//echo '<script>history.back(-1);</script>';	
						}

				}


}

include "./template/login.html";
$db->close();
?>
