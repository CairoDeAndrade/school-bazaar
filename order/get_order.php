<?php

session_start();
class Order {
    public $id;
    public $cpf;

    function getOrderById($id) {
        include_once('../conn.php');
        $conn = new Conn();
        $connect = $conn->connDB();

        $sql = mysqli_query($connect, "SELECT * FROM bazar.order WHERE id_order = $id");
        $result = mysqli_fetch_array($sql);

        $array = array(
            'cpf' => $result['cpf'],
            'value' => $result['value']
        );

        $json = json_encode($array);

        echo $json;
    }

    function getOrderByCPF($cpf){
        include_once('../conn.php');
        $conn = new Conn();
        $connect = $conn->connDB();

        $sql = mysqli_query($connect, "SELECT * FROM bazar.order WHERE cpf LIKE '$cpf%'");

        if(mysqli_num_rows($sql) === 1){
            $result = mysqli_fetch_array($sql);
            $array = array(
                'id_order' => $result['id_order'],
                'cpf' => $result['cpf'],
                'value' => $result['value'],
                'date_inserted' => $result['date_inserted']
            );
        } else if (mysqli_num_rows($sql) > 1){
            while($result = mysqli_fetch_array($sql)){
                $array[] = array(
                    'id_order' => $result['id_order'],
                    'cpf' => $result['cpf'],
                    'value' => $result['value'],
                    'date_inserted' => $result['date_inserted']
                );
            }
        }
        else if (mysqli_num_rows($sql) === 0){
            $_SESSION['error-search'] = 0;
            header('Location: index.php');
            die();
        }
        $_SESSION['json'] = json_encode($array);
        header('Location: index.php');

    }
}

    if (isset($_GET['id'])) {
        $order = new Order();
        $order->getOrderById($_GET['id']);
    } 

    if(isset($_GET['cpf-search'])){
        $order = new Order;
        $order->getOrderByCPF($_GET['cpf-search']);
    } 
?>
