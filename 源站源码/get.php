<?php
function getkey(){
    if(isset($_SESSION['user'])){
        return sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].$_SESSION['user']);
    }else{
        return sha1($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
    }
}
echo getkey();
function check_input($value){

$sts=preg_replace('#document#','<b>document</b>',$value);
$sts=preg_replace('#window#','<b>window</b>', $sts);
$sts=preg_replace('#.js#','<b>.js</b>',$sts);
//preg_replace('#?#','<b>?</b>',$sts)
return $sts;
}
echo check_input("<br/>window.open document.xxx xss.xx xxx.js");

?>