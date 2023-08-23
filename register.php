<?php 
    session_start();
    
    class registerOrder{

        
        public $cpf;
        public $value;

        function register(){

            include_once('conn.php');
            $conn = new Conn;
            $connect = $conn->connDB();


            $sql = mysqli_query($connect, "INSERT INTO bazar.order (cpf, value) 
            VALUES ('$this->cpf' , '$this->value')");
            if(mysqli_affected_rows($connect) > 0){
                $_SESSION['register'] = true;
            } else {
                $_SESSION['register'] = false;
            }
            
        }

        function validadeDuplicity(){
            
            $this->cpf = $_POST['cpf'];
            $this->value = $_POST['value'];
            
            include_once('conn.php');
            $conn = new Conn;
            $connect = $conn->connDB();

            $sql = mysqli_query($connect, "SELECT cpf FROM bazar.order WHERE cpf = '$this->cpf' ");

            if(mysqli_num_rows($sql) === 1){
                $_SESSION['register'] = "Duplicity";
                header('Location: index.php');
                die();
            } else {
                $this->register();
                header('Location: index.php');
            }      
        }
    }

    $registerOrder = new registerOrder;
    $registerOrder->validadeDuplicity();
?>