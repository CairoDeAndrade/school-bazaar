<?php

class Order{
    public $cpf;
    public $value;

    function receiveData(){
        session_start();
        $this->cpf = $_POST['cpf-edit'];
        $this->value = $_POST['value-edit'];

        $this->validateValue($this->value, $this->cpf);
    }


    function validateValue($value, $cpf){
        include_once('../conn.php');
        $conn = new Conn;
        $connect = $conn->connDB();

    
        $validate = mysqli_query($connect, "SELECT value FROM bazar.order WHERE cpf = '$cpf'");
        $result = mysqli_fetch_array($validate);

        if($result['value'] + $value > 1000){
            $_SESSION['edit'] = "Valor Acima";
            header('Location: index.php');
        } else {
            $this->updateDB($value, $cpf);
        }
    }

    function updateDB($value, $cpf){

        include_once('../conn.php');
        $conn = new Conn;
        $connect = $conn->connDB();

        $sql = mysqli_query($connect, "UPDATE bazar.order SET value = '$value' WHERE cpf = '$cpf'");
        if(mysqli_affected_rows($connect) > 0){
            $_SESSION['edit'] = true;
        } else {
            $_SESSION['edit'] = false;
        }
        header('Location: index.php');
    }

}

    $order = new Order;
    $order->receiveData();
?>