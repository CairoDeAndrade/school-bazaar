<?php

session_start();

class Person {
    public $cpf;

    function getPerson($cpf) {
        include_once('../conn.php');
        $conn = new Conn;
        $connect = $conn->connDB();

        $sql = mysqli_query($connect, "SELECT id_order, cpf FROM bazar.order WHERE cpf LIKE '$cpf%'");
        
        if(mysqli_num_rows($sql) === 1){
            $result = mysqli_fetch_array($sql);

            $array = array(
                'id_order' => $result['id_order'],
                'cpf' => $result['cpf']
            );
        } else if(mysqli_num_rows($sql) > 1) {
            while($result = mysqli_fetch_array($sql)){
                $array[] = array(
                    'id_order' => $result['id_order'],
                    'cpf' => $result['cpf']
                );
            }
        }
        else if(mysqli_num_rows($sql) === 0){
            $_SESSION['error-search-cpf'] = 0;
            header('Location: index.php');
            die();
        }
        

        $_SESSION['json-person'] = json_encode($array);
        header('Location: index.php');
    }
}

    if (isset($_GET['cpf-person-search'])) {
        $order = new Person();
        $order->getPerson($_GET['cpf-person-search']);
    } else {
        echo "ID do pedido não foi fornecido.";
    }

?>
