<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1>puller</h1>
<table>
    <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Behind</th>         
        <th>git-pull</th>
    </tr>
<?php
    $baseUrl = $_SERVER[ 'PHP_SELF' ];

    $finder = Repofinder::getInstance();    
    $allRepos = $finder->getAll();
    
    foreach( $allRepos as $path ) {
        $repo = new Repoinformation( $path );
        
        $name     = $repo->getName();
        $type     = $repo->getType();
        $behind   = '';        
        $pull     = '';

        if( $repo->isGit() ) {
            $name = '<a href="' . $repo->getUrl() . '" target="_blank">'
                    . $name 
                    . '(' . $repo->getHash() . ')'
                    . '</a>'
            ;   
            $behind = $repo->getBehind();
            $pull = '<a href="' . $baseUrl . '?cmd=pull&path=' . urlencode( $path ) . '">pull</a>';                        
        }
                        
        echo 
            '<tr>'
            . '<td>' . $name . '</td>'
            . '<td>' . $type . '</td>'
            . '<td>' . $behind . '</td>'
            . '<td>' . $pull . '</td>'
            . '</tr>'
        ;
    }
?>
</table>