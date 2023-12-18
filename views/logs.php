<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1 class="main-header">logs</h1>
<?php
$baseUrl  = $_SERVER[ 'PHP_SELF' ];
$allFiles = array();

$ini = Inireader::getInstance();
$path = $ini->getErrorDir();
$fullCommand = 'cd ' . $path . " && ( stat -c '%y %n %s' *.log | awk '{print $1,$2,$4}' | sort -r )"; //| awk '{print $3'})";
exec( $fullCommand, $output, $result );
foreach( $output as $line ) {
    $explodedLine = explode( ' ', $line );
    $timestamp = $explodedLine[ 0 ] . ' ' . $explodedLine[ 1 ];
    $name      = $explodedLine[ 2 ];
    
    $allFiles[ $name ] = $timestamp;
//    echo $line . '<br />' . PHP_EOL;
}

$filename = '';
if( isset( $_REQUEST[ 'log' ] ) ) {
    $filename = $_REQUEST[ 'log' ];
}

if( strlen( $filename ) == 0 ) {
    // determine first in $allFiles
    $first = '';
    foreach( $allFiles as $name => $timestamp ) {
        if( strlen( $first ) > 0 ) 
            continue;
        $first = $name;
    }
    $filename = $first;
}

echo '<div id="logFiles">';
echo '<h2>all Log Files</h2>';
echo '<table id="fileTable">';
foreach( $allFiles as $name => $timestamp ) {
    echo '<tr>'
        . '<td>' 
            . '<a href="' . $baseUrl . '?log=' . $name . '">'            
            . $name 
            . '</a>'
        . '</td>'
        . '<td>' . $timestamp . '</td>'
        . '</tr>'
    ;
}
echo '</table>';
echo '</div>';

if( is_file( $path . '/' . $filename ) ) {
    echo '<div id="logFileContent">';
    echo '<h2>contents of: ' . $filename . '</h2>'; 
    echo '<div id="logContent"><textarea class="copypaste" rows="20" cols="200">';
    echo file_get_contents( $path . '/' . $filename );
    echo '</textarea></div>';
    echo '</div>';
}
