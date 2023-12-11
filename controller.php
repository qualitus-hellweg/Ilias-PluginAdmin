<?php
if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
    die();
}

if( ! isset( $_SESSION[ 'view' ] ) ) {
    $_SESSION[ 'view' ] = '';
}
if( isset( $_REQUEST[ 'view' ] ) ) {
    if( $_REQUEST[ 'view' ] != 'adminer' ) {
        $_SESSION[ 'view' ] = $_REQUEST[ 'view' ];
    }
}

if( 
    ( isset( $_REQUEST[ 'cmd' ] ) )
    && ( isset( $_REQUEST[ 'path' ] ) )
) {
    $dir = '';
    $finder = Repofinder::getInstance();
    $all = $finder->getAll();
     
    if( isset( $all[ $_REQUEST[ 'path' ] ] ) ) {        
        $dir = $_REQUEST[ 'path' ];
    }
    
    $command = '';
    if( $_REQUEST[ 'cmd' ] == 'pull' ) {
        $command = 'git pull';
    }
    if( $_REQUEST[ 'cmd' ] == 'fetch' ) {
        $command = 'git fetch';
    }
    if( $_REQUEST[ 'cmd' ] == 'stash' ) {
        $command = 'git stash';
    }
    if( $_REQUEST[ 'cmd' ] == 'install' ) {
        $command = 'composer install --no-interaction';
    }
    if( $_REQUEST[ 'cmd' ] == 'install-nodev' ) {
        $command = 'composer install --no-dev --no-interaction';
    }
    if( $_REQUEST[ 'cmd' ] == 'update' ) {
        $command = 'composer update --no-interaction';
    }
//    if( $_REQUEST[ 'cmd' ] == 'du' ) {
//        $command = 'composer -du --no-interaction';
//    }
    if( $_REQUEST[ 'cmd' ] == 'del' ) {
        if( strlen( $dir ) > 0 ) {
            $plugin = basename( $dir );
            $dir = dirname( $dir );
            $command = 'rm -rf ' . $plugin;
            Repofinder::reInit();
        }
        
    }    
    if( $_REQUEST[ 'cmd' ] == 'switch' ) {
        if( isset( $_REQUEST[ 'gitbranch' ] )  
        && ( strlen( $_REQUEST[ 'gitbranch' ] ) > 0 ) 
        ) {                        
            $branchName = $_REQUEST[ 'gitbranch' ];                        
            $command = "git switch " . $branchName;
        }    
    }

    if( isset( $_REQUEST[ 'composerdu' ] ) ) {
        $command = "composer du";
        $dir = ILIAS_FS_PATH;
    }
    
    if( isset( $_REQUEST[ 'pullme' ] ) ) {
        $command = "git pull";
        $dir = __DIR__;
    }
    
    if(
        ( strlen( $dir ) > 0 )
        && ( strlen( $command ) > 0 )
    ) {
                
        $fullCommand = 'cd ' . $dir . ' && ' . $command . ' 2>&1';
                
        $out  =   '<div id="shellcommand">'
                . '<b>' . $fullCommand . '</b>'
                . '<textarea id="copypaste" rows="1" cols="3">' . $fullCommand . '</textarea>'
                . '<br />returns<br />'
                . '<div id="shelloutput">'
        ;
        
        $result = exec( $fullCommand, $output );
        foreach( $output as $line ) {
            $out .= $line . '<br />' . PHP_EOL;
        }
        $out .= '<b>' . $result . '</b><br />';
        
        $out .= '<a href="' . $baseUrl . '?cmd=' . $REQUEST[ 'cmd' ] . '&path=' . urlencode( $REQUEST[ 'path' ] ) . '">AGAIN</a>';            
        
        $out .= '</div>';
        $out .= '</div>';
        echo $out;
    }
}

// install
if( isset( $_REQUEST[ 'add' ] ) ) {
    $gitdata = GitData::getInstance();
    if( $gitdata->isProject( $_REQUEST[ 'add' ] ) ) {
        $project = $gitdata->getProject( $_REQUEST[ 'add' ] );
        $fullCommand = 'cd ' . ILIAS_FS_PATH . '/'
                        . $project->getFilepath()                        
                        . ' && git clone ' 
                        . $project->getRepourl()
                        . ' ' . $project->getName() 
                        . ' 2>&1'
        ;
        
        $out = '<div id="shellcommand">'
            . '<b>' . $fullCommand . '</b>'                
            . '<br />returns<br />'
            . '<div id="shelloutput">'
        ;
        
        
//        $result = exec( $fullCommand );
        $result = exec( $fullCommand, $output );
        foreach( $output as $line ) {
            $out .= $line . '<br />' . PHP_EOL;
        }
        $out .= '<b>' . $result . '</b><br />';
        // */

        $out .= '</div>';
        $out .= '</div>';
        
        echo $out;
    }
}