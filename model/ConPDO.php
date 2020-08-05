<?php
define('HOST', 'localhost');
define('DBNAME', 'cmdv_db');
define('CHARSET', 'utf8');
//define('USER', 'cmdv_user');
//define('PASSWORD', 'xvnfgj56w6j4');
define('USER', 'root');
define('PASSWORD', '020473');


//ssspmg221242ap

/*
define('HOST', 'localhost');
define('DBNAME', 'apcmdvvenda');
define('CHARSET', 'utf8');
define('USER', 'root');
define('PASSWORD', '');
 * 
 */
class ConPDO {

    private static $instance;

    private function __construct() {
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME . "; charset=" . CHARSET . ";", USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            } catch (PDOException $e) {
                print "erro getInstance() : " . $e->getMessage();
            }
        }
        return self::$instance;
    }

}
