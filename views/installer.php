<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1>installer</h1>
<?php
$baseUrl = $_SERVER[ 'PHP_SELF' ];
$search = '';
if( isset( $_REQUEST[ 'search' ] ) ) {
    $search = $_REQUEST[ 'search' ];
}
echo '<form action="' . $baseUrl . '">'
     . 'search <input type="text" name="search" value="' . $search . '" />'
     . '<input type="submit">'
     . '<hr />'
;
if( strlen( $search ) > 0 ) {
    echo '
<div id="searchresults">
        <h2>Search-Results</h2>
<table>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>URL</th>
        <th>install</th>   
    </tr>';
    
    
    $gitdata = GitData::getInstance();
    $results = $gitdata->search( $search );
    ksort( $results );
    foreach( $results as $git ) {
//        echo '<pre>', print_r( $git, true ), '</pre>'; continue;
        
        
        /** @var GitProjectDto $git */
        $name = $git->getName();
        $type = basename( dirname( $git->getFilepath() ) );
        $url  = '<a href="' . $git->getRepourl() . '" target="_blank">' . $git->getRepourl() . '</a>';
        $install = '';
        if( strlen( $git->getFilepath() ) > 3 ) {
            $install = '<a href="' . $baseUrl . '?add='
                        . urlencode( $git->getRepourl() )
                        . '">install</a>'                
            ;
        }
        
        echo '<tr>'
            . '<td>' . $name    . '</td>'
            . '<td>' . $type    . '</td>'
            . '<td>' . $url     . '</td>'
            . '<td>' . $install . '</td>'
        ;
    }
    
    echo '
</table>
</div>
<hr />
    ';
}        


    $finder = Repofinder::getInstance();    
    $allRepos = $finder->getAll();
    
    
    echo '
<div id="installed">
<h2>Installed</h2>
<table>
<tr>
    <th>Name</th>
    <th>Type</th>
    <th>delete</th>
</tr>
';
    foreach( $allRepos as $path ) {
        $repo = new Repoinformation( $path );
        
        $name     = $repo->getName();
        $type     = $repo->getType();
        
        echo '<tr>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $type . '</td>';
        echo '<td><a href="' . $baseUrl . '?cmd=del&path=' . urlencode( $path ) . '">del</a></td>';
        echo '</tr>';
    }
    echo '
</table>
</div>
';
