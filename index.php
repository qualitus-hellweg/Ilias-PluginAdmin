<?php 
    define( 'ILIAS_FS_PATH', __DIR__ . '/../ilias7' );

    // leave out, if you dont know what that is
    define( 'ILIAS_FUNNY_IP', 'yes' );


    session_start(); 
    define( "I_WAS_CALLED_FROM_INDEX", "Yes I was" );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./views/css/ilpluginadmin.css">
	<title>ilPluginAdmin</title>
	<link rel="apple-touch-icon" sizes="180x180" href="./views/css/images/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./views/css/images/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="./views/css/images/favicons/favicon-16x16.png">
	<link rel="manifest" href="./views/css/images/favicons/site.webmanifest">
	<link rel="mask-icon" href="./views/css/images/favicons/safari-pinned-tab.svg" color="#965ba5">
	<link rel="shortcut icon" href="./views/css/images/favicons/favicon.ico">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-config" content="./views/css/images/favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

</head>
<body>
<?php
    require_once __DIR__ . '/lib/_all.php';
    require_once __DIR__ . '/controller.php';
    require_once __DIR__ . '/views/_main.php'; 
?>        
</body>
</html>