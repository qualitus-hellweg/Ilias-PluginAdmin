<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1 class="main-header">Large Files in fs</h1>

<?php
    $ini = Inireader::getInstance();

    $dir = $ini->getDataDir();
    echo '<h2 class="second-header">Large Files in Data-Dir: ' . $dir . '</h2>';
    $fullCommand = 'cd ' . $dir . ' && du -hs * | sort -rh | awk \'{print $2,$1}\' | grep "[M|G]$"';
//    echo '<h1>', $fullCommand, '</h2>';
    
    echo '
<table id="fsinfo">
    <thead><tr>
        <th>file/dir</th>
        <th>size</th>    
    </tr></thead><tbody>
    ';
    $output = array();
    $result = exec( $fullCommand, $output );
    foreach( $output as $line ) {
//        echo $line . '<br />';
        $explodedLine = explode( ' ', $line );
        echo '<tr>';
        echo '<td>' . $explodedLine[ 0 ] . '</td>';
        echo '<td>' . $explodedLine[ 1 ] . '</td>';
        echo '</tr>';        
    }
    echo '</tbody>
</table>    
    ';

    // -----------------------------------------------------------------------------------------------------
    $dir = $ini->getLogDir();
    echo '<h2 class="second-header">Large Files in Log-Dir: ' . $dir . '</h2>';
    $fullCommand = 'cd ' . $dir . ' && du -hs * | sort -rh | awk \'{print $2,$1}\' | grep "[M|G]$"';
//    echo '<h1>', $fullCommand, '</h2>';
    
    echo '
<table id="fsinfo">
    <thead><tr>
        <th>file/dir</th>
        <th>size</th>    
    </tr></thead><tbody>
    ';
    $output = array();
    $result = exec( $fullCommand, $output );
    foreach( $output as $line ) {
//        echo $line . '<br />';
        $explodedLine = explode( ' ', $line );
        echo '<tr>';
        echo '<td>' . $explodedLine[ 0 ] . '</td>';
        echo '<td>' . $explodedLine[ 1 ] . '</td>';
        echo '</tr>';        
    }
    echo '</tbody>
</table>    
    ';

    // -----------------------------------------------------------------------------------------------------
    $dir = ILIAS_FS_PATH . '/Customizing/global/plugins';
    echo '<h2 class="second-header">Large Files in plugins-Dir: ' . $dir . '</h2>';
    $fullCommand = 'cd ' . $dir . ' && du -hs */* | sort -rh | awk \'{print $2,$1}\' | grep "[M|G]$"';
//    echo '<h1>', $fullCommand, '</h2>';
    
    echo '
<table id="fsinfo">
    <thead><tr>
        <th>file/dir</th>
        <th>size</th>    
    </tr></thead><tbody>
    ';
    $output = array();
    $result = exec( $fullCommand, $output );
    foreach( $output as $line ) {
//        echo $line . '<br />';
        $explodedLine = explode( ' ', $line );
        echo '<tr>';
        echo '<td>' . $explodedLine[ 0 ] . '</td>';
        echo '<td>' . $explodedLine[ 1 ] . '</td>';
        echo '</tr>';        
    }
    echo '</tbody>
</table>    
    ';

    // -----------------------------------------------------------------------------------------------------
    $dir = ILIAS_FS_PATH . '/Customizing/global/skin';
    echo '<h2 class="second-header">Large Files in skin-Dir: ' . $dir . '</h2>';
    $fullCommand = 'cd ' . $dir . ' && du -hs * | sort -rh | awk \'{print $2,$1}\' | grep "[M|G]$"';
//    echo '<h1>', $fullCommand, '</h2>';
    
    echo '
<table id="fsinfo">
    <thead><tr>
        <th>file/dir</th>
        <th>size</th>    
    </tr></thead><tbody>
    ';
    $output = array();
    $result = exec( $fullCommand, $output );
    foreach( $output as $line ) {
//        echo $line . '<br />';
        $explodedLine = explode( ' ', $line );
        echo '<tr>';
        echo '<td>' . $explodedLine[ 0 ] . '</td>';
        echo '<td>' . $explodedLine[ 1 ] . '</td>';
        echo '</tr>';        
    }
    echo '</tbody>
</table>    
    ';
?>