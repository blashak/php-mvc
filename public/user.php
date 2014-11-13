<?php 
	error_reporting(E_ALL); ini_set("display_errors", 1);
	include('../app/app.php');
	if (gettype(userController::getAction()) !== 'NULL') exit;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
		<?php echo file_get_contents(ABSOLUTE_URL."/public/includes/head.php"); ?>
	</head>
<body>


<div class="container">
	<div class="panel panel-default">
  		<!-- Default panel contents -->
  		<div class="panel-heading">Usuario</div>
  		<div class="panel-body">
    		<?php include(CURRENT_PATH.'/app/views/forms/user.php'); ?>
  		</div>
	</div>
</div>
<!-- /container -->
</body>
</html>