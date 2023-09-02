<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();       
}
?>

<h1>ilPluginAdmin</h1>
<?php
    $baseUrl = $_SERVER[ 'PHP_SELF' ];
    
    echo '<table><tr><td valign="top">';            // delete me!

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
        echo '<li' . $class . '><a href="' . $baseUrl . '?view=' . $view . '"' . $target . '>' . $text . '</a></li>';
    }
    
//    echo '<li><a href="' . dirname( $baseUrl ) . '/views/adminer2.php" target="_blank">adminer</a></li>';
    
    echo '</ul>';
    
    echo '</td><td valign="top" style="margin-left: 40px;padding-left: 40px; ">';            // delete me!
    
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
    
    echo '</td></tr></table>';            // delete me!
?>