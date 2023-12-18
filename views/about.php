<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
    echo '<h1 class="main-header">about ilPluginAdmin</h1>';

    $baseUrl = $_SERVER[ 'PHP_SELF' ];

    $repo = new Repoinformation( __DIR__ . '/..' );
    
    $behind = 'up to date';
    $temp = $repo->getBehind();
    if( strlen( $temp ) > 0 ) {
        $behind = $temp;
    }
    echo '<div class="how-to">';
    echo 'hash  : ' . $repo->getHash() . '<br />';
    echo 'behind: ' . $behind . '<br />';
    echo '<a href="' . $baseUrl . '?pullme=1&cmd=1&path=1">pull me</a>';
    
    
    echo '</div>';