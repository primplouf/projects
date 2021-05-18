<?php

class database {
    
    protected $_dbName;
    protected $_dbHost;
    protected $_dbPwd;
    protected $_dbLogin;

    public function __construct(){
        $this->_dbHost = 'localhost';
        $this->_dbName = 'film';
        $this->_dbLogin = 'root';
        $this->_dbPwd = '';
    }

    public function connectDb(){
        try {
            $bdd = new PDO('mysql:host='.$this->_dbHost.';dbname='.$this->_dbName.';charset=utf8', $this->_dbLogin, $this->_dbPwd);
            return $bdd;
        }catch (Exception $e) {
            exit('Erreur : '.$e->getMessage());
        }
    }
}

?>