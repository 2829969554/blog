<?php
function send_post($url, $post_data) {
  
  $postdata = http_build_query($post_data);
  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type:application/x-www-form-urlencoded',
      'content' => $postdata,
      'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  
  return $result;
}
if(is_array($_POST)&&count($_POST)>0){
	 if(isset($_POST['img']) and isset($_POST['id'])){
		$img=$_POST['img'];
		$id=$_POST['id'];
	}
		/**
		 * 发送post请求
		 * @param string $url 请求地址
		 * @param array $post_data post键值对数据
		 * @return string
		 */

		  
		//使用方法
		$post_data = array(
		  'user' => '18638272572',
		  'pass' => 'zsf19981103',
		  'act' => 'image',
		  'type' => 'shibie',
		  'typeid' => $id,
		  'image' => $img,
		  'dev' => ''
		);
		echo (send_post('https://yzcode.xinby.cn/api.php?', $post_data));
	}else{
		echo <<<EOF
<p style="text-align:center;">请以POST方式发送数据!<br/><br/>
<a  href="https://shimo.im/docs/BN5YjMaA3csQoM8J">查看接口使用说明</a>
</p>
EOF;
	}
?>