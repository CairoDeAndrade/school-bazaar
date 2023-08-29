<?php

        session_start();

        class Person{
            public $cpf;

            function updateDB($cpf){
                include_once('../conn.php');

                $conn = new Conn;
                $connect = $conn->connDB();

                $sql = mysqli_query($connect, "UPDATE bazar.order SET cpf = '$cpf' ")
            }
        }

?>
