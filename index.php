
<?php

include"inc/rights.php";


	require_once 'dbconfig.php';

	

	if(isset($_GET['delete_id']))

	{

		// select image from db to delete

		$stmt_select = $DB_con->prepare('SELECT userPic FROM tbl_users WHERE userID =:uid');

		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));

		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);

		unlink("/reem/".$imgRow['userPic']);

		

		// it will delete an actual record from db

		$stmt_delete = $DB_con->prepare('DELETE FROM tbl_users WHERE userID =:uid');

		$stmt_delete->bindParam(':uid',$_GET['delete_id']);

		$stmt_delete->execute();

		

		header("Location: admin.php");



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
<?php include('inc/styled.php');?>
<style>
    body { padding-top: 1px; }
    </style>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ادمن الصور : عصر الوابكا</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/main.css">
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
    <!-- بداية الصفحة -->


<span class="ad1"><a href="/admin.php">ادمن الصور</a></span>
 <form id="login-form" class="login-form" name="form1">
<div id="form-content">


 <!-- 1 logo -->
<?php include('inc/header.php');?>
<!-- 2 logo -->

            <div class="container">

 <!-- 1 add -->
<?php include('inc/add.php');?>
<!-- 2 add -->

<hr>

            <div class="a77">
               
<?php

	

	$stmt = $DB_con->prepare('SELECT userID, userName, userProfession, userPic FROM tbl_users ORDER BY userID DESC');

	$stmt->execute();

	

	if($stmt->rowCount() > 0)

	{

		while($row=$stmt->fetch(PDO::FETCH_ASSOC))

		{

			extract($row);

			?>
                <p class="lead">

<div align="right">
<a href="<?php echo $folder?>/<?php echo $row['userPic']; ?>"><img src="<?php echo $folder?>/<?php echo $row['userPic']; ?>" class="img-rounded" alt="3sr <?php echo $vir?>" width="170" height="70"/></a>
(<font color="#ff0088"><?php echo $row['userID']; ?></font>)

  <p class="ad1">

 <span class="label label-info"><font color="#ffffff"><?php echo $userName; ?></font></span>/
 <?php echo$userProfession; ?>
</p>
<textarea>
رابط للمنتديات
[url=<?php echo $ucode?>/<?php echo $folder?>/<?php echo $row['userPic']; ?>][img]<?php echo $ucode?>/<?php echo $folder?>/<?php echo $row['userPic']; ?>[/img][/url]</textarea>
<hr>
			</div> 
	<?php

		}

	}

	else

	{

		?>

 </div>
	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; تم تنظيف السرفر تلقائيا وتم نقل الصور القديمه
   <?php

	}

	

?>
</div>
          </div>

       
    </div>
    <!-- /نهاية الصفحة -->


  <!-- بداية الفوتر -->
<span class="alj1">
<?php include('inc/footer.php'); ?>
</span>
  <!-- /نهاية الفوتر -->

    <!-- الجيكويري -->
    <script src="js/jquery.js"></script>

    <!-- البوت ستراب -->
    <script src="js/bootstrap.min.js"></script>

</div>
</form>
</body>

</html>
