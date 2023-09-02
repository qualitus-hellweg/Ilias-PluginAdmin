<?php

final class Repofinder {
    
    /**
     *
     * @var Repofinder 
     */
    protected static $instance = null;
    
    /**
     *
     * @var array path => path
     */
    protected $plugins;
    
    /**
     *
     * @var array path => path
     */
    protected $skins;
    
    
    public static function getInstance() {
        if( self::$instance == null ) {
            self::$instance = new Repofinder();
        }
        return self::$instance;
    }
    
    /**
     * private constructor, pls use getInstance() for instantiation
     */
    private function __construct() {        
        $temp = $this->scanForPlugins( ILIAS_FS_PATH . '/Customizing/global/plugins' );
        ksort( $temp );
        $this->plugins = $temp;

        $temp = $this->scanForSkins( ILIAS_FS_PATH . '/Customizing/global/skin' );
        ksort( $temp );
        $this->skins = $temp;
    }
    
    
    /**
     * 
     * @param string $dir
     * @return string[] array ( path => path ) of plugin-directories
     */
    protected function scanForPlugins( $dir ) {
        $result = array();
        foreach( scandir( $dir ) as $filename ) {
            if( $filename[0] === '.' ) continue;
            $filePath = $dir . '/' . $filename;
            if( is_dir( $filePath ) ) {
                $result = array_merge( $result, $this->scanForPlugins( $filePath ) );
            } else {
                if( $filename == 'plugin.php' ) {
                    // filter out vendor-paths (composer)
                    if( strpos( $filePath, 'vendor' ) == 0 ) {
                        $result[ $dir ] = $dir;
                    }                    
                }
            }
        }
        return $result;        
    }    
    
    
    
    /**
     * 
     * @param string $dir
     * @return string[] array ( path => path ) of plugin-directories
     */
    protected function scanForSkins( $dir ) {  
        $out = array();
        $temp = scandir( $dir );

        foreach( $temp as $filename ) {            
            if( $filename[0] === '.' ) continue;
            if( is_file( $dir . '/' . $filename . '/template.xml' ) ) {
                $temp = $dir . '/' . $filename;
                $out[ $temp ] = $temp;
            }
        }
        return $out;
    }

    
    /**
     * 
     * @return array  path => path
     */
    public function getPlugins() {
        return $this->plugins;
    }
    
    /**
     * 
     * @return array  path => path
     */
    public function getSkins() {
        return $this->skins;
    }
    
    /**
     * 
     * @return array  path => path of everything(ilias, plugins, skins)
     */
    public function getAll() {
        $temp = array();
        foreach( $this->plugins as $repo ) {
            $temp[ basename( $repo ) ] = $repo;
        }
        foreach( $this->skins as $repo ) {
            $temp[ basename( $repo ) ] = $repo;
        }
        ksort( $temp );
        
        
        $out = array();
        $out[ ILIAS_FS_PATH ] = ILIAS_FS_PATH;
        
        foreach( $temp as $name => $dir ) {
            $out[ $dir ] = $dir;
        }
        
//        $out = array_merge( $out, $this->plugins );
//        $out = array_merge( $out, $this->skins );
//        ksort( $out );
        return $out;
    }
}