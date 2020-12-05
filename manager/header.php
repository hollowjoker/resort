<?php
//print_r($_SESSION);
include("../includes/db.conn.php");
include("language.php");
$path=pathinfo($_SERVER['PHP_SELF']);
$filename=$path['basename'];
$get_sub_title=$mysqli->query("select * from bsi_adminmenu where url='".$filename."'");
if($get_sub_title->num_rows){
	$get_sub_title_row=$get_sub_title->fetch_assoc();
	$get_parent_title=$mysqli->query("select * from bsi_adminmenu where id='".$get_sub_title_row['parent_id']."'");
	$get_parent_title_row=$get_parent_title->fetch_assoc();
	$main_title=$get_parent_title_row['name'].' > '.$get_sub_title_row['name'];
	$_SESSION['main_title']=$main_title;
}
if($filename=='admin-home.php')
$main_title="Home";
elseif($filename=='change_password.php')
$main_title="Change Password";
else
$main_title=$_SESSION['main_title'];

$urlRequest = pathinfo($_SERVER['PHP_SELF'])['basename'];
$linkJqueryLibrary = '../js/jquery.min.js';
$assetFilter = true;
if ($urlRequest == 'view_bookings.php') {
	$assetFilter = false;
	$linkJqueryLibrary = 'js/jquery.min.js';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manager Page</title>
<link href="../admin/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../css/bootstrap.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../css/datepicker1.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="../admin/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css" media="screen"/>
<link type="text/css" href="css/menu.css" rel="stylesheet" />
<!-- Load JQuery -->
<script type="text/javascript" src="<?= $linkJqueryLibrary ?>"></script>
<script type="text/javascript" src="js/menu.js"></script>
<?php if($assetFilter): ?>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<?php endif;?>
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
</head>
<body>
<div id="top">
 <div id="top-inside">
  <div id="bsi-addmin-text"><a href="admin-home.php">Manager</a></div>
  <div class=" top-link_last"><a href="logout.php"><?=HEADER_LOGOUT?></a></div>
  <div class=" top-link"><a href="change_password.php"><?=HEADER_CHANGE_PASS?></a></div>
  <div class=" top-link"><a href="admin-home.php"><?=HEADER_HOME?></a></div>
  <div class=" top-link" data-action="notif">
  	<a href="#" class="notification-holder">
	  <i class="fa fa-bell-o"></i>
	  <span class="badge badge-danger" data-badge="count">0</span>
	  <div class="notification-menu">
	  	<ul></ul>
	  </div>
	</a>
</div>
 
 </div>
</div>
<div id="con">
<div id="container">
<div id="contain">
<div id="title">
 <h1>
  <?=$main_title?>
 </h1>
</div>
<div id="menu">
 <ul class="menu">
  <?php
  $sql_parent=$mysqli->query("select * from bsi_adminmenu where parent_id=0 and status='Y' and id<>6 order by ord"); //added id<>6 to remove settings. manager can't change anything.
	while($row_parent=$sql_parent->fetch_assoc())
	{
		if($row_parent['name']=='SETTING')
		echo '<li class="last"><a href="'.$row_parent['url'].'"><span>'.$row_parent['name'].'</span></a>';
		else
		echo '<li><a href="'.$row_parent['url'].'"><span>'.$row_parent['name'].'</span></a>';
		$sql_parent222=$mysqli->query("select * from bsi_adminmenu where parent_id=".$row_parent['id']." and status='Y' order by ord");
		if($sql_parent222->num_rows)
		{
			echo '<ul>';
			while($row_parent222=$sql_parent222->fetch_assoc())
			{
				echo '<li><a href="'.$row_parent222['url'].'"><span>'.$row_parent222['name'].'</span></a></li>';
			}
			echo '</ul>';
		}else{
			echo '</li>';
		}
	}
  ?>
 </ul>
</div>
