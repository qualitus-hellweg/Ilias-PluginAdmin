<?php
//if( ! defined( 'I_WAS_CALLED_FROM_INDEX' ) ) {
//    die();
//}

require_once __DIR__ . '/lib/Inireader.php';



function adminer_object() {
  
    class IliasAdminer extends Adminer {

        /**
         * custom name in title and heading
         * 
         * @return string
         */
        function name() {
            $ini = Inireader::getInstance();

            return 'IliasAdminer:' . $ini->getIliasName();
        }

        /**
         * server, username and password for connecting to database
         * 
         * @return type
         */
        function credentials() {
            $ini = Inireader::getInstance();
            
            $out = $ini->getDbArray();
            return $out;
        }

        /**
         * database name, will be escaped by Adminer
         *  
         * @return string
         */
        function database() {
//            return 'reporting';
            
            $ini = Inireader::getInstance();
            
            return $ini->getDbName();
        }
        
        function login($login, $password) {
            return true;
        }

    }
  
    return new IliasAdminer;
}

include __DIR__ . '/lib/adminer/adminer-4.8.1-mysql.php';
