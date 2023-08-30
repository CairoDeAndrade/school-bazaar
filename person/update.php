<?php

        session_start();

        class Person{
            public $id;
            public $cpf;

            function validateCPF($cpf, $id){
                include_once('../conn.php');
                $conn = new Conn;
                $connect = $conn->connDB();

                $sql = mysqli_query($connect, "SELECT cpf FROM bazar.order WHERE cpf = '$cpf'");

                if(mysqli_num_rows($sql) > 0){
                    $_SESSION['edit-person'] = 'Duplicity';
                    header('Location: index.php');
                    die();
                } else {
                    $this->updateDB($cpf, $id);
                }
            }
            function updateDB($cpf, $id){
                include_once('../conn.php');

                $conn = new Conn;
                $connect = $conn->connDB();

                $sql = mysqli_query($connect, "UPDATE bazar.order SET cpf = '$cpf' WHERE id_order = '$id'");

                if(mysqli_affected_rows($connect) > 0){
                    $_SESSION['edit-person'] = true;
                } else {
                    $_SESSION['edit-person'] = false;
                }

                header('Location: index.php');

            }
        }

        $person = new Person;
        $person->validateCPF($_POST['cpf-edit-person'] , $_POST['id-edit']);

?>
