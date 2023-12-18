<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}
?>
<h1 class="main-header">konsole</h1>
<?php
    $baseUrl = $_SERVER[ 'PHP_SELF' ];

    $finder = Repofinder::getInstance();    
    $allRepos = $finder->getAll();

    echo '<a class="composer" title="Run composer du" href="' . $baseUrl . '?composerdu=1&cmd=1&path=1">composer du</a>';
?>
<table>
    <tr>
        <th>Name</th>
        <th>Type</th>
         
        <th>git-pull</th>
        <th>git-switch</th>
        <th>git-others</th>        
        
        <th>composer</th>        
    </tr>
<?php    
    foreach( $allRepos as $path ) {
        $repo = new Repoinformation( $path );
        
        $name     = $repo->getName();
        $type     = $repo->getType();
        
        $pull     = '&nbsp;<br />&nbsp;';
        $switch   = '';
        $others   = '';
        $composer = '';
        
        if( $repo->isGit() ) {
            $name = '<a href="' . $repo->getUrl() . '" target="_blank">'
                    . $name 
                    . '(' . $repo->getHash() . ')'
                    . '</a>'
            ;            
            
            $pull = '<a href="' . $baseUrl . '?cmd=pull&path=' . urlencode( $path ) . '">pull</a>';
            
            $switch = '<form acion="' . $baseUrl . '">'
                    . '<input type="hidden" name="cmd" value="switch" />'
                    . '<input type="hidden" name="path" value="' . $path . '" />'
                    . '<select name="gitbranch" onchange="submit()">'
            ;
            
            $currentBranch = $repo->getBranch();
            $branchList = $repo->getBranchList();
            foreach( $branchList as $branch ) {
                $switch .= '<option value="' . $branch . '"';
                if( $branch == $currentBranch ) {
                    $switch .= ' selected="selected"';
                }
                $switch .= '>'
                            . $branch
                            . '</option>'
                ;
            }
            $switch .= '</select></form>';
//            $switch = $repo->getBranch();
            
            $others = '<a href="' . $baseUrl . '?cmd=fetch&path=' . urlencode( $path ) . '">fetch</a><br />'
                      . '<a href="' . $baseUrl . '?cmd=stash&path=' . urlencode( $path ) . '">stash</a>';
            
        } 
        
        if( $repo->isComposer() ) {
            if( $repo->isComposerInstall() ) {
                $composer = '<a href="' . $baseUrl . '?cmd=install&path=' . urlencode( $path ) . '">install</a><br />'
                      . '<a href="' . $baseUrl . '?cmd=install-nodev&path=' . urlencode( $path ) . '">install-nodev</a>';
            } else {
                $composer = '<a href="' . $baseUrl . '?cmd=update&path=' . urlencode( $path ) . '">update</a><br />'
//                      . '<a href="' . $baseUrl . '?cmd=du&path=' . urlencode( $path ) . '">-du</a>'
                ;                
            }
        }
        
        echo 
            '<tr>'
            . '<td valign="top">' . $name . '</td>'
            . '<td valign="top">' . $type . '</td>'
            . '<td valign="top">' . $pull . '</td>'
            . '<td valign="top">' . $switch . '</td>'
            . '<td>' . $others . '</td>'
            . '<td>' . $composer . '</td>'
            . '</tr>'
        ;
    }
?>
</table>