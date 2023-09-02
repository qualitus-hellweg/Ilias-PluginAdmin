<?php 
    define( 'ILIAS_FS_PATH', __DIR__ . '/../reporting' );

    // leave out, if you dont know what that is
    //define( 'ILIAS_FUNNY_IP', 'yes' );


    session_start(); 
    define( "I_WAS_CALLED_FROM_INDEX", "Yes I was" );
?>
<html>
    <head>
        <title>
            ilPluginAdmin
        </title>
    </head>
    <body>
<?php
    require_once __DIR__ . '/lib/_all.php';
    require_once __DIR__ . '/controller.php';
    require_once __DIR__ . '/views/_main.php'; 
?>        
    </body>
</html>
