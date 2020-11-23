<?php
    $url = $_SERVER['REQUEST_URI'];
    $exploded = explode('/', $url);
    $slug = $exploded[3];
    $titleMeta = '';

    if ($slug == '' || strpos($slug, 'index') !== false) {
        $titleMeta = 'Home Page - Creative Techies Resort';
    } elseif (strpos($slug, 'catalogue') !== false) {
        $titleMeta = 'Accomodations - Creative Techies Resort';
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?= $titleMeta ?></title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" />
    <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script> 
    <script src="js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="js/jcarousellite_1.0.1.js" type="text/javascript"></script>
    <script src="js/jquery.galleriffic.js" type="text/javascript"></script>
    <script src="js/jquery.opacityrollover.js" type="text/javascript"></script> 
</head>
<body>
    <div id="homeheadr_img">
        <ul id="main_nav">
            <li class="<?= $slug == '' || strpos($slug, 'index') !== false ? 'active' : ''?>">
                <a href="index.php">Home</a>
            </li>
            <li class="<?= strpos($slug, 'catalogue') !== false ? 'active' : ''?>">
                <a href="catalogue.php">Accomodations</a>
            </li>
            <li class="<?= strpos($slug, 'reservation') !== false ? 'active' : ''?>">
                <a href="../index.php">Reservations</a>
            </li>
        </ul>
        <img class="hero-banner" src="images/resort1.jpg"/>
    </div>
	<div class="main_container">