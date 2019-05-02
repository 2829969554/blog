<?php
include "config.php";
if(isset($_POST['button'])){
$uid=$_POST['uid'];
$name=$_POST['name'];
$password=$_POST['password'];
$qq=$_POST['qq'];
$tel=$_POST['tel'];
$http=$_POST['http'];
$autograph=$_POST['autograph'];
$sql="update user set password='".$password."',name='".$name."',qq='".$qq."',tel='".$tel."',http='".$http."',autograph='".$autograph."' where id=".$uid.";";
echo $sql;
$ret = $db->query($sql);
echo "
<script>
alert('保存成功');
location.href='user.php'
</script>
";
}else{

        $sql= "select * from user where id=".$_GET['ids'].";";
        $ret = $db->query($sql);
        $row = $ret->fetchArray(SQLITE3_ASSOC);
        //while(){
        //    echo "<p>".$row['id']."\t".$row['username']."\t".$row['password']."\n</p>";
        //}
       include './template/ziliao.html';
   }
        $db->close();

?>