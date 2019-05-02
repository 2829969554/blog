
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>TrustAnQi Inc</title>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	<meta name="shenma-site-verification" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui" />
	<link rel="stylesheet" href="css/base.css" />
	<link rel="stylesheet" href="css/index.css" type="text/css" />
</head>
<body>

<!--header-->	
<header>

<?php
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('mdb.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
     // echo "Opened database successfully<br/>";
   }

   //$sql =<<<EOF

 //     SELECT * from vedio where type=;
//EOF;
?>

<?php


   $sql =<<<EOF

      SELECT * from types;
EOF;

   $ret = $db->query($sql);
   $a=1;
while($row = $ret->fetchArray(SQLITE3_ASSOC)){

if($row['id']==5){
	echo "<br/>";
}

	echo '<a style="color:red" href="/m3u8/api.php?type='.$row['id'].'">'.$row['type'].'</a>';
	echo "&nbsp&nbsp&nbsp";

}

?>
</header>

<!--/header-->



	<section class="box newsbox">
		<div class="title"><em></em><a href="" title="小视频">视频</a><span><i class="moreArrow"></i></span></div>
		<ul>

        



<?php
if(is_array($_GET)&&count($_GET)==2){
$m=$_GET['type'];
$l=$_GET['list'];
}else{
if(is_array($_GET)&&count($_GET)==1){
$m=$_GET['type'];
echo '<script>window.location.href="/m3u8/api.php?type='.$m.'&list=1";</script>';

}else{
	echo '<script>window.location.href="/m3u8/api.php?type=6&list=1";</script> ';
}
	$m=10;
}

$sql ='SELECT * from vedio where type='.$m.' limit '.(($l-1)*15).',15';
   $ret = $db->query($sql);
   $a=1;
while($row = $ret->fetchArray(SQLITE3_ASSOC)){
	//if($a==20){
	//	break;
	//}
    
	echo '<li >
	<a href="/m3u8/m3u8.php?url='.$row['m3u8'].'" title="">
	<img src="'.$row['img1'].'" alt=""/>
	<p>'.$row['caption'].'</p>
	</a>
	</li>';;

	//$a=$a+1;
}
?>

	</ul>
	</section>


<div class="flink">
	<div class="flinkbox">
	<?php
	$t=$_GET['type'];
	$l=$_GET['list'];
	$s=$l-1;
	$x=$l+1;
	echo '<a href="/m3u8/api.php?type='.$t.'&list='.$s.'">上一页</a>';
	echo '&nbsp&nbsp';
	echo '<a href="/m3u8/api.php?type='.$t.'&list='.$x.'">下一页</a>';
	?>
	</div>
</div>

<section class="footer">
<p>
	Copyright © 2018-2019 TrustAnQi Inc All Rights Reserved.
</p>
<?php
   $db->close();
?>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/touchslide.js"></script>
<script src="js/iscroll.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<div style="display:none;"><script src="js/stat.js" language="JavaScript"></script></div>
</div>
</body>
</html>















