<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1 class="main-header">phinghelper</h1>
<h2  class="second-header">plugins.csv - File</h2>
<?php

$out = 'Name;Path;URL;prod-Branch;dev-Branch;composer;comments' . PHP_EOL;


$finder = Repofinder::getInstance();    
$allRepos = $finder->getAll();

$skipFirst = true;
foreach( $allRepos as $path ) {
    if( $skipFirst ) {
        $skipFirst = false;
        continue;
    }            
    
    $repo = new Repoinformation( $path );
    if( ! $repo->isGit() ) {
        continue;
    }
    
    $name   = $repo->getName();
    
    $length = strlen( ILIAS_FS_PATH ) + 1;
    $fsPath = dirname( substr( $path, $length ) );

    $url    = $repo->getUrl();
    $branch = $repo->getBranch();
    $composer = '';
    $comment = 'check prod/dev-branches';
    if( $repo->isComposer() ) {
        $composer = '1';
        $comment  = 'check composer, ' . $comment;
    }    
    $out .= $name 
            . ';' 
            . $fsPath
            . ';'
            . $url 
            . ';'
            . $branch
            . ';'
            . $branch
            . ';'
            . $composer
            . ';'
            . $comment
            . ';'
        . PHP_EOL;
}

echo '<textarea class="copypaste" style="max-width: 100%;" cols="400" rows="40">'
        . $out 
        . '</textarea>'
;