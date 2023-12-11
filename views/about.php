<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
    echo '<h1 class="main-header">about ilPluginAdmin</h1>';

    $baseUrl = $_SERVER[ 'PHP_SELF' ];

    $repo = new Repoinformation( __DIR__ . '/..' );

    echo '<div class="how-to">';
    echo 'hash  : ' . $repo->getHash() . '<br />';
    echo 'behind: ' . $repo->getBehind() . '<br />';
    echo '<a href="' . $baseUrl . '?pullme=1&cmd=1&path=1">pull me</a>';
    
    
    echo '</div>';