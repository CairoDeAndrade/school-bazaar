<?php

class Conn {

    private $serverName;
    private $dataBase;
    private $usernameDatabase;
    private $passwordDatabase;

    function __construct() {
        $this->serverName = "localhost";
        $this->dataBase = "bazar";
        $this->usernameDatabase = "root";
        $this->passwordDatabase = "";
    }

    public function connDB() {
        $conn = mysqli_connect($this->serverName, $this->usernameDatabase, $this->passwordDatabase, $this->dataBase);
        if (!$conn) {
            die("A conexão falhou: " . mysqli_connect_error());
        } else {
            return $conn;
        }
    }
}

$conn = new Conn;
$conn->connDB();

?>
