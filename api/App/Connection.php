<?php

class Connection
{
    private $dbServidor = 'localhost';
    private $dbUser = 'root';
    private $dbPass = 'mysql';
    private $dbName = 'testuser';
    protected $link;

    public function connect() {
        $this->link = mysqli_connect($this->dbServidor , $this->dbUser, $this->dbPass) or die('No se pudo conectar: '. mysqli_connect_errno() . PHP_EOL);
        mysqli_select_db($this->link,$this->dbName) or die('No se pudo seleccionar la base de datos');
        
        return $this->link;
    }

    public function close() {
        mysqli_close($this->link);
    }
}

?>