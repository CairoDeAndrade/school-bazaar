<?php

class Order {
    public $id;

    function getOrderById($id) {
        include_once("conn.php");
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
}

    if (isset($_GET['id'])) {
        $order = new Order();
        $order->getOrderById($_GET['id']);
    } else {
        echo "ID do pedido não foi fornecido.";
    }

?>
