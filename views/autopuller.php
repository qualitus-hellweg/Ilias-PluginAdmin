<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1 class="main-header">Autopuller</h1>
<h2>autopuller-generator</h2>

<table>
    <thead><tr>
        <th>Name</th>
        <th>Type</th>                 
        <th>code</th>   
    </tr></thead><tbody>
<?php
    $baseUrl = $_SERVER[ 'PHP_SELF' ];

    $finder = Repofinder::getInstance();    
    $allRepos = $finder->getAll();
    
    foreach( $allRepos as $path ) {
        $fullCommand = '';
        $repo = new Repoinformation( $path );
        if( $repo->isGit() ) {
            $fullCommand = '<textarea class="copypaste" rows="1" cols="3">'
                            . 'cd ' . $path . ' && while [ : ]; do echo; date; git pull; sleep 10; done'
                            . '</textarea>'
            ;
        }
        echo '<tr>';
        echo '<td>' . $repo->getName() . '</td>';
        echo '<td>' . $repo->getType() . '</td>';
        echo '<td>' .  $fullCommand  . '</td>';        
        echo '</tr>';
    }
?>
	</tbody>
</table>