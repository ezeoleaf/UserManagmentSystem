<?php

class Connection
{
    private $dbServidor = 'l7000736.ferozo.com';
    private $dbUser = 'l7000736_users';
    private $dbPass = '88gozuPUvo';
    private $dbName = 'l7000736_users';
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