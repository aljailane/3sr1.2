<?php



	error_reporting( ~E_NOTICE ); // avoid notice

	

	require_once 'dbconfig.php';

mysql_set_charset('utf8');
	

	if(isset($_POST['btnsave']))

	{

		$username = $_POST['user_name'];// user name

		$userjob = $_POST['user_job'];// user email

		

		$imgFile = $_FILES['user_image']['name'];

		$tmp_dir = $_FILES['user_image']['tmp_name'];

		$imgSize = $_FILES['user_image']['size'];

		

		

		if(empty($username)){

			$errMSG = "عفوا شكلك نسيت تحط اسم نكك";

		}

		else if(empty($userjob)){

			$errMSG = "لا انته نسيت تحط وصف للصوره ";

		}

		else if(empty($imgFile)){

			$errMSG = "لم تحدد صورة .";

		}

		else

		{

			$upload_dir = 'reem/'; // upload directory

	

			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

		

			// valid image extensions

			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

			// rename uploading image

			$userpic = substr(md5(rand(000000000,999999999)),-5).".".$imgExt;

				

			// allow valid image file formats

			if(in_array($imgExt, $valid_extensions)){			

				// Check file size '5MB'

				if($imgSize < 5000000)				{

					move_uploaded_file($tmp_dir,$upload_dir.$userpic);

				}

				else{

					$errMSG = "صورتگ كبيره جدا عن المسموح";

				}

			}

			else{

				$errMSG = "نسمح فقط بالامتدادات  JPG, JPEG, PNG & GIF ";		

			}

		}

		

		

		// if no error occured, continue ....

		if(!isset($errMSG))

		{

			$stmt = $DB_con->prepare('INSERT INTO tbl_users(userName,userProfession,userPic) VALUES(:uname, :ujob, :upic)');

			$stmt->bindParam(':uname',$username);

			$stmt->bindParam(':ujob',$userjob);

			$stmt->bindParam(':upic',$userpic);

    

			if($stmt->execute())

			{

				$successMSG = "  مبروك نجحت فعلا في رفع الصورة";

				header("refresh:0;index.php"); // redirects image view page after 1 seconds.

			}

			else

			{

				$errMSG = "نأسف حدثت مشكلة قم بالتواصل معنا";

			}

		}

	}

?>
<!DOCTYPE html>
<html lang="ar">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>مركز تحميل عصر الوابكا</title>

    <!-- استايل البوت ستراب -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

<style>
    body { padding-top: 1px; }
    </style>
<?php include('inc/styled.php');?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ادمن الصور : عصر الوابكا</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/aljailane.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>

    <!-- تخصيص الاستايل -->

    <!-- التجاوب -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<script src="http://cdn-ye.yn.lt/3sr/s1.js"></script>
<script async="true" src="http://cdn-ye.yn.lt/3sr/s2.js"></script>
    <![endif]-->
<?php include('inc/rights.php');?>
</head>


<body>


    <!-- بداية النافبار -->
    
  <!-- /نهاية الناف بار -->

    <!-- بداية الصفحة -->
    <div class="container">

<div class="a5">
    <div class="list-group-item active">
           عزيزي الزائر يمكنك رفع صور لك ولجميع الاعضاء ولاكن تذكر انك ترفع صور غير مخالفه لشرعنا وديننا الله يحفظنا واياكم
            </div>
            <div class="list-group-item">
         <p>

<?php

	if(isset($errMSG)){

			?>

            <div class="alert alert-danger"  align="right">

            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>

            </div>

            <?php

	}

	else if(isset($successMSG)){

		?>

        <div class="alert alert-success" align="right">

              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>

        </div>

        <?php
	}

	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
<br>اكتب نكك:<br>
 <input class="form-control" type="text" name="user_name" placeholder="الرجاء ادخال اسمگ فقط" value="<?php echo $username; ?>" />
<br>الحين وصف بسيط<br>
 <input class="form-control" type="text" name="user_job" placeholder="اختـر وصف يوضح الصورة" value="<?php echo $userjob; ?>" />
<br>باقي صورة من جهازگ:<br>
<input class="ad2" type="file" name="user_image" accept="image/*" />

    
<br>
        <div colspan="2" align="right"><button type="submit" name="btnsave" class="btn btn-lg btn-danger">
 رفع الصورة

<span class="glyphicon glyphicon-save"></span>
        </button>

        </div>

    

</form>


</p>
      
    <!-- /نهاية الصفحة -->

  <!-- بداية الفوتر -->
<hr>

<?php include('inc/footer.php'); ?>

  <!-- /نهاية الفوتر -->

    <!-- الجيكويري -->
    <script src="js/jquery.js"></script>

    <!-- البوت ستراب -->
    <script src="js/bootstrap.min.js"></script>

  </div>
    </div>
</body>

</html>
