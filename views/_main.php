<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();       
}
?>
<header><div><img src="./views/css/images/favicons/android-chrome-192x192.png" alt="" /><h1>ilPluginAdmin</h1></div></header>
<?php
    $baseUrl = $_SERVER[ 'PHP_SELF' ];
    
    echo '<nav class="side-nav">';
    $allowed = array(
          '' => '' // first
        , 'info' => 'Info'    
        , 'konsole' => 'Console'     
        , 'logs' => 'Logs'       
        , 'adminer' => 'Database'
        , 'fsinfo' => 'Large File Info'        
        , 'autopuller' => 'Autopuller(Generator)'        
        , 'installer' => 'Installer'
        , 'phinghelper' => 'plugins.csv(phinghelper)'
        , 'puller' => 'Updates(puller)'
        , 'about' => 'About'
    );
    
    // render navi
    echo '<ul id="navigation">';
    foreach( $allowed as $view => $text ) {
        if( strlen( $view ) == 0 )
            continue;
        $target = '';
        if( $view == "adminer" ) {
            $target = ' target="_blank"';
        }
        $class = '';
        if( $view == $_SESSION[ 'view' ] ) {
            $class = ' class="active"';
        }
        echo '<li' . $class . '><a href="' . $baseUrl . '?view=' . $view . '"' . $target . '>';
        echo '<img src="./views/css/images/menu/menu-' . $view . '.svg" alt="' . $text . '" /><span>' . $text . '</span></a></li>';
    }
    
//    echo '<li><a href="' . dirname( $baseUrl ) . '/views/adminer2.php" target="_blank">adminer</a></li>';
    
    echo '</ul>';
    
    echo '</nav><main class="main-content">';
    echo '<div id="copy-status"></div>';
    echo '<button class="toggle-button" title="Seitenleiste anzeigen"></button>';

    // include other views
    $filename = $_SESSION[ 'view' ];
    // adminer-special
    if( $_REQUEST[ 'view' ] == 'adminer' ) {
        include __DIR__ . '/adminer.php';
    } else {
        if( isset( $allowed[ $filename ] ) ) {
            include __DIR__ . '/' . $filename . '.php';
        } else {
            include __DIR__ . '/template_for_others.php';
        }
    }
    
    echo '</main>';
    echo '<script src="./views/js/script.js"></script>';
?>