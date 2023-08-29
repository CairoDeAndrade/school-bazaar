<?php

date_default_timezone_set('America/Sao_Paulo');
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

        if($result['value'] === '0' ){
            $this->updateDB($value, $cpf, $result['value']);
        }
        else if($result['value'] + $value > 1000){
            $_SESSION['edit'] = "Valor Acima";
            header('Location: index.php');
        } 
        else if($result['value'] + $value <= 1000){
            $this->updateDB($value, $cpf, $result['value']);
        }
    }

    function updateDB($value, $cpf, $valueDB){

        include_once('../conn.php');
        $conn = new Conn;
        $connect = $conn->connDB();

        $newValue = $value + $valueDB;

        $date = date('Y-m-d H:i:s');
        $sql = mysqli_query($connect, "UPDATE bazar.order SET value = '$newValue' , date_inserted = '$date'  WHERE cpf = '$cpf'");
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