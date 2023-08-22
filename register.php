<?php 

    class registerOrder{

        public $cpf;
        public $value;

        function register(){

            include_once('conn.php');
            $conn = new Conn;
            $connect = $conn->connDB();

            $this->cpf = $_POST['cpf'];
            $this->value = $_POST['value'];

            $sql = mysqli_query($connect, "INSERT INTO bazar.order (cpf, value) 
            VALUES ('$this->cpf' , '$this->value')");
            if(mysqli_affected_rows($connect) > 0){
                $_SESSION['register'] = true;
            } else {
                $_SESSION['register'] = false;
            }
            
        }
    }

    $registerOrder = new registerOrder;
    $registerOrder->register();
?>