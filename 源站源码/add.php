<?php

echo $_POST['fnm'];
  if ($_FILES["file"]["error"] > 0)
    {
 //   echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
		/*
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
*/
    if (file_exists("img/" . $_POST['fnm']))
      {
  //     echo "img/" . $_FILES["file"]["name"];
      }
    else
      {

      move_uploaded_file($_FILES["file"]["tmp_name"],
      "img/" . $_POST['fnm']);

 //     echo "img/" . $_FILES["file"]["name"];
      }
    }

?>