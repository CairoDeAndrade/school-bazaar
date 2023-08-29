<?php

        session_start();

        class Person{
            
            public $cpf;

            public $value = 0;

            function registerDB($cpf, $value){
                
                include_once('../conn.php');
                $conn = new Conn;
                $connect = $conn->connDB();

                $sql = mysqli_query($connect, "INSERT INTO bazar.order(cpf, value) 
                VALUES ('$cpf' , '$value')");
                if(mysqli_affected_rows($connect) > 0){
                    $_SESSION['registerPerson'] = true;
                } else {
                    $_SESSION['registerPerson'] = false;
                }
            }

            function validateCPF($cpf){
                include_once('../conn.php');
                $conn = new Conn;
                $connect = $conn->connDB();

                $sql = mysqli_query($connect, "SELECT cpf FROM bazar.order WHERE cpf = '$cpf'");

                if(mysqli_num_rows($sql) > 0){
                    $_SESSION['registerPerson'] = "Duplicity";
                    header('Location: index.php');
                    die();
                } else {
                    $this->registerDB($cpf , 0);
                    header('Location: index.php');
                } 
            }
        }

        if(isset($_POST['btn-register-person'])){
            $person = new Person;
            $person->validateCPF($_POST['cpf-person']);
        }

?>