<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT userName, userProfession, userPic FROM tbl_users WHERE userID =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$username = $_POST['user_name'];// user name
		$userjob = $_POST['user_job'];// user email
			
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = '/reem/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = rand(0000,9999).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['userPic']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "الصورة اكبر من 5MB";
				}
			}
			else
			{
				$errMSG = "الملفات المدعومة JPG, JPEG, PNG & GIF ";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['userPic']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('UPDATE tbl_users 
									     SET userName=:uname, 
										     userProfession=:ujob, 
										     userPic=:upic 
								       WHERE userID=:uid');
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':ujob',$userjob);
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('شكرا تم تحديث الصورة');
				window.location.href='index.php';
				</script>
                <?php
			}
			else{
				$errMSG = "ربما لا يتوفر مساحه كافيه قم بمراسلة المدير!";
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

    <title>مركز تحميل <?php echo $namesite?></title>

    <!-- استايل البوت ستراب -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- تخصيص الاستايل -->

    <style>
    body { padding-top: 70px; }
    </style>
<?php include('inc/styled.php');?>

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
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- بداية العرض المحمول -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $urlsite?>"><?php echo $namesite?></a>
            </div>
            <!-- بداية روابط القائمة -->
         <?php include('inc/header.php'); ?>
            <!-- /نهاية روابط القائمة -->
        </div> 
    </nav>
  <!-- /نهاية الناف بار -->

    <!-- بداية الصفحة -->
    <div class="container">

        <div class="row">
<div class="a5">
    <div class="list-group-item active">
           <a class="btn btn-default" href="/"> كل الصور </a>
            </div>
            <div class="list-group-item">
        <p><form method="post" enctype="multipart/form-data" class="form-horizontal" align="right">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
	
<label class="alj1right"><font color="red">الاسم الحالي </font> <?php echo $userName; ?> </label>
        <input class="form-control" align="center" type="text" name="user_name" value="" required />
    
    
   <label class="alj1right"><font color="green">الوصف الحالي </font> <br> <?php echo $userProfession; ?> </label>
       <input class="form-control" align="center" type="text" name="user_job" value="" required />
    
    <label class="alj1right"><font color="blue">الصورة الحاليــة</font></label>
        	<p align="right"><img src="user_images/<?php echo $userPic; ?>" height="100" width="100" /></p>
<label class="alj1right"><font color="maroon">تغيير الصورة</font></label>
        	<input class="btn btn-xm btn-default" type="file" name="user_image" accept="image/*" /> <br>
        <div colspan="2" align="center"><button type="submit" name="btn_save_updates" class="btn btn-default">
تحديث 
        <span class="glyphicon glyphicon-save"></span>
        </button>
        
        <a class="btn btn-default" href="index.php">
 عودة <span class="glyphicon glyphicon-backward"></span></a>
        
        </div>
    
</form></p>
      </div>
        </div> </div>
    </div>
    <!-- /نهاية الصفحة -->

  <!-- بداية الفوتر -->
<div id="footer">
<?php include('inc/footer.php'); ?>
</div>
  <!-- /نهاية الفوتر -->

    <!-- الجيكويري -->
    <script src="js/jquery.js"></script>

    <!-- البوت ستراب -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
