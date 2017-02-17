<?php

/* Image Uploading Script 

* ========================================================================================

Process images and moves them into a uploads folder, each image will have the date of upload 

appended to its url to prevent replacing.


- Trevor 06/29/13


*/

// only allow the following formats

$allowedExts = array("gif", "jpeg", "jpg", "png");


// explode the file name to to check the ext

$temp = explode(".", $_FILES["file"]["name"]);


// not sure what end does

$extension = end($temp);


// check file type

if ((($_FILES["file"]["type"] == "image/gif")

|| ($_FILES["file"]["type"] == "image/jpeg")

|| ($_FILES["file"]["type"] == "image/jpg")

|| ($_FILES["file"]["type"] == "image/pjpeg")

|| ($_FILES["file"]["type"] == "image/x-png")

|| ($_FILES["file"]["type"] == "image/png"))

&& ($_FILES["file"]["size"] < 2097152) // limit the size of the file to 2mb

&& in_array($extension, $allowedExts)){


  // check if there was an error

  if($_FILES["file"]["error"] > 0){

    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";

  } else {

    // echo "Upload: " . $_FILES["file"]["name"] . "<br>";

    // echo "Type: " . $_FILES["file"]["type"] . "<br>";

    // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";

    // echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";


    // get the date

    // added this to always refrence America/Los_Angeles VS sever timestamp

    $date = new DateTime(null, new DateTimeZone('America/Los_Angeles'));

    $current_date = $date->getTimestamp();

    // add the date to the filename 

    $file_name = $temp[0] . $current_date;

    // add the extension back on. 

    $file = $file_name.".".$temp[1];

    // move the file to its new location

    move_uploaded_file( $_FILES["file"]["tmp_name"], "upload/" .$file);

      

    // echo '<img src="upload/'.$_FILES["file"]["name"].'">';

  }

} else {

  echo "You have uploaded an invalid file.";

}



?> 

<html>

<body>


<form action="" method="post" enctype="multipart/form-data">

  <label for="file">Filename:</label>

  <input type="file" name="file" id="file"><br>

  <input type="submit" name="submit" value="Submit">

  <p>Max upload limit 2mb.</p>

</form>


</body>

</html> 

