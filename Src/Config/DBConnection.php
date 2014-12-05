<?php

/**
 * Description of DBConnection
 *
 * @author lfnsantos
 */

namespace Src\Config;

use \PDO;

class DBConnection {
    
    public $conn;
    protected $dsnDB         = 'mysql:host=localhost;dbname=siscona';
    protected $userDB        = 'root';
    protected $passwordDB    = '';
    protected $optionsDB     = array(
                                            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                                            ,\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                                            //,\PDO::ATTR_PERSISTENT => TRUE
                                            // More options
                                        );
    
    public function __construct()
    {
        try
        {
            $this->conn = new \PDO($this->dsnDB, $this->userDB, $this->passwordDB, $this->optionsDB);
        }
        catch (PDOException $e)
        {
            echo 'Erro de Conexão: ' . $e->getMessage();
        }
        
        if ($this->conn)
            return $this->conn;
    }

    public function __destruct()
    {
        $this->conn = null;
    }
    
}
