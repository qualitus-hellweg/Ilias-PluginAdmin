<?php
final class Inireader {
    
    /**
     *
     * @var Inireader
     */
    private static $instance = null;
    
    /**
     *
     * @var array
     */
    protected $data;
    
    /**
     *
     * @var array
     */
    protected $clientData;
    
    /**
     * 
     * @return Inireader
     */
    public static function getInstance() {
        if( self::$instance == null ) {
            self::$instance = new Inireader();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->data = parse_ini_file( ILIAS_FS_PATH . "/ilias.ini.php",true);
        
        $filename = $this->getClientIniFilename();
        $this->clientData = parse_ini_file( ILIAS_FS_PATH . '/' . $filename,true);
    }
    
    /**
     * 
     * @return string
     */
    public function getIliasName() {
        return $this->clientData[ 'client' ][ 'name' ] 
                . '('
                . $this->clientData[ 'client' ][ 'description' ] 
                . ')'
        ;
    }
    
    /**
     * 
     * @return string
     */
    public function getIliasUrl() {
        return $this->data[ 'server' ][ 'http_path' ];
    }
    
    /**
     * 
     * @return string
     */
    public function getDataDir() {
        return $this->data[ 'clients' ][ 'datadir' ] . $this->data[ 'clients' ][ 'default' ];
    }      
    
    /**
     * 
     * @return string
     */
    public function getLogDir() {
        return $this->data[ 'log' ][ 'path' ];
    }
    
    /**
     * 
     * @return string
     */
    public function getErrorDir() {
        return $this->data[ 'log' ][ 'error_path' ];
    }
    
    /**
     * 
     * @return string
     */
    protected function getClientIniFilename() {
        return $this->data[ 'clients' ][ 'path' ] . '/' . $this->data[ 'clients' ][ 'default' ] . '/' . $this->data[ 'clients' ][ 'inifile' ];
    }
    
    /**
     * @deprecated pls use only for debugging
     */
    public function printme() {
        echo '<h1>data</h1><pre>' ,print_r( $this->data, true ), '</pre>';
        echo '<h1>client</h1><pre>' ,print_r( $this->clientData, true ), '</pre>';
    }
    
    /**
     * 
     * @return array
     */
    public function getDbArray() {
        $host = "" . $this->clientData[ 'db' ][ 'host' ];
        
        if( defined( 'ILIAS_FUNNY_IP' ) ) {
            $host = '127.0.1'; // preg_replace( '/127.0.0.1/', '127.0.1', $host );
        }
        
        $out = array(
              $host 
            , "" . $this->clientData[ 'db' ][ 'user' ] 
            , "" . $this->clientData[ 'db' ][ 'pass' ] 
        );
        
        return $out;
    }
    
    /**
     * 
     * @return array
     */
    public function getDbName() {
        return $this->clientData[ 'db' ][ 'name' ];
    }
}