<?php
//链接数据库      //数据库地址  用户名  密码
$c=mysql_connect("localhost","root","root"); //or die("111");
//选择目标数据库
mysql_select_db("news",$c);
//数据库乱码
mysql_query("set names utf8");
?>