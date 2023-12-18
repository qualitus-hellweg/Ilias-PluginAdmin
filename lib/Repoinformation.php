<?php

class Repoinformation {
    
    /**
     *
     * @var string
     */
    protected $path = '';
    
    /**
     * 
     * @param string $path
     */
    public function __construct( $path ) {
        $this->path = $path;
    }
    
    /**
     * 
     * @return string
     */
    public function getName() {
        return basename( $this->path );
    }
    
    /**
     * 
     * @return string
     */
    public function getType() {
        $type = 'ilias';
        if( $this->path != ILIAS_FS_PATH ) {
            $type = basename( dirname( $this->path ) );
        }
        return $type;
    }
    
    /**
     * 
     * @return string
     */
    public function getBehind() {
        $behind = '';
        $result = exec( 'cd ' . $this->path . ' && git fetch && git status -sb'  );
        if( $result ) {
            $explodedResult = explode( '[', $result );
            $behind = $explodedResult[ 1 ];
            $behind = str_replace( ']', '', $behind );
        }
        return $behind;
    }
    
    /**
     * 
     * @return string
     */
    public function getUrl() {
        return exec( 'cd ' . $this->path . ' && git config --get remote.origin.url' );
    }
    
    /**
     * 
     * @return string
     */
    public function getBranch() {
        return exec( 'cd ' . $this->path . ' && git symbolic-ref --short -q HEAD'  );
    }
    
    /**
     * 
     * @return string[]
     */
    public function getBranchList() {
        $branches = array();

        $result = exec( 'cd ' . $this->path . ' && git branch -r', $output );
        if( count( $output ) > 0 ) {
            foreach( $output as $line ) {
                $temp = explode( '/', $line );
                $temp = $temp[ 1 ]; // no origin

                $temp = explode( ' ', $temp );
                $temp = $temp[ 0 ]; // no ->
                if( 
                    ( strlen( $temp ) > 0 ) 
                    && ( $temp != 'HEAD' )
                ) {
                    $branches[ $temp ] = $temp;
                }
            }
        }

        return $branches;
    }
    
    /**
     * 
     * @return string
     */
    public function getHash() {
        return exec( 'cd ' . $this->path . ' && git rev-parse --short HEAD'  );
    }
    
    /**
     * 
     * @return bool
     */
    public function isGit() {
        return is_dir( $this->path . '/.git' );
    }    
    
    /**
     * 
     * @return bool
     */
    public function isComposer() {
        return is_file( $this->path . '/composer.json' );
    }
    
    /**
     * 
     * @return bool
     */
    public function isComposerUpdate() {
        return ( is_file( $this->path . '/vendor/autoload.php' ) );
    }
    
    /**
     * 
     * @return bool
     */
    public function isComposerInstall() {
        return( 
               ( $this->isComposer() )
            && ( ! $this->isComposerUpdate() )
        );
    }    
}