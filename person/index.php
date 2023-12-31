<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bazar Heriberto Muller</title>
    <!-- Bootstrap -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.0/examples/navbar-fixed/navbar-top-fixed.css" rel="stylesheet">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- css -->
    <link rel="stylesheet" href="../dados-pedido/dados-pedido.css">
    <script src="http://26.155.119.91/school-bazaar/school-bazaar/dados-pedido/script.js"></script>
</head>

<body>

    <?php
    session_start();
      if(isset($_SESSION['registerPerson'])){
        
          if($_SESSION['registerPerson'] === 'Duplicity'){
            ?>
                <script>
                    showModalInformation("Erro!" , "Erro ao cadastrar, cpf já existente!");
                </script>
            <?php
          }
          if($_SESSION['registerPerson'] === true){
            ?>
                <script>
                    showModalInformation("Cadastrado!" , "A pessoa foi cadastrada com sucesso!");
                </script>
            <?php
          }
          if($_SESSION['registerPerson'] === false){
            ?>
                <script>
                    showModalInformation("Erro!" , "Erro ao cadastrar no banco de dados, tente novamente ou entre em contato com o Administrador");
                </script>
            <?php
          }
          unset($_SESSION['registerPerson']);
      }
      if(isset($_SESSION['edit-person'])){
            if($_SESSION['edit-person'] === true){
                ?>
                    <script>
                        showModalInformation("Editado!" , "O CPF foi editado com sucesso!");
                    </script>
                <?php
            } 
            if($_SESSION['edit-person'] === false){
                ?>
                    <script>
                        showModalInformation("Erro!" , "Erro ao editar, tente novamente ou entre em contato com o administrador!");
                    </script>
                <?php
            }
            if($_SESSION['edit-person'] === 'Duplicity'){
                ?>
                    <script>
                        showModalInformation("Atenção!" , "Já existe um CPF cadastrado com o valor do CPF digitado!");
                    </script>
                <?php
            }
            unset($_SESSION['edit-person']);
      }

      if(isset($_SESSION['error-search-cpf'])){
        ?>
            <script>
                 showModalInformation("Atenção!" , "Não existe CPF para o valor buscado!");
            </script>
        <?php
        unset($_SESSION['error-search-cpf']);
      }
  ?>

    <!-- Information modal -->
       <div class="modal fade" id="modal-information" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="title-modal"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id='text-modal'></p>
                </div>
                <div class="modal-footer" id='modal-footer'>

                </div>
            </div>
        </div>
    </div>

    <!-- Register modal -->
    <div class='modal fade' id='register-person' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        data-backdrop='static'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title text-center'>Cadastrar Pessoa</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                            aria-hidden='true'>×</span></button>
                </div>
                <div class='modal-body'>
                    <form class='form-horizontal' method='POST'
                        action='http://26.88.70.231/school-bazaar/school-bazaar/person/register.php'>
                        <div class='form-group'>
                            <label for='inputEmail3' class='col-sm-2 control-label'>CPF</label>
                            <div class='col-sm-10'>
                                <input type='text' name='cpf-person' id='cpf'>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="btn-register-person">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit moodal -->
    <div class='modal fade' id='edit-modal-cpf' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        data-backdrop='static'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title text-center'>Editar Pessoa</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                            aria-hidden='true'>×</span></button>
                </div>
                <div class='modal-body'>
                    <form class='form-horizontal' method='POST' action='http://26.88.70.231/school-bazaar/school-bazaar/person/update.php'>
                        <div class='form-group'>
                            <label for='inputEmail3' class='col-sm-2 control-label'>CPF</label>
                            <div class='col-sm-10'>
                                <input type='number' name='id-edit' style='display: none;' id='id-edit'>
                                <input type='text' name='cpf-edit-person' id='cpf-edit'>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnEdit" name="btn-edit-person">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

        <a class="navbar-brand" href="#">Bazar Receita</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <button type="button" class="btn btn-success" id="btn-register"
                    onclick="showModal('#register-person')">Cadastrar Pessoa</button>
                    &nbsp;
                    <button style='display: none;' type="button" class="btn btn-light" id="btn-refresh" onclick="refresh()">Limpar Busca</button>
            </ul>
            
            <form class="form-inline mt-2 mt-md-0" METHOD='GET' action='get_person.php'>
                <input class="form-control mr-sm-2" type="text" name='cpf-person-search' placeholder="Digite um CPF..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>

    </nav>

    <div class="content">

        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>

            <tbody>
                <?php
                if(isset($_SESSION['json-person'])){ 
                    ?>
                        <script>
                            var element1 = document.getElementById('btn-refresh');
                            element1.style.display = 'block';
                          
                        </script>
                    <?php
                    $result = json_decode($_SESSION['json-person'], true);
                    
                    
                    if(array_key_first($result) === 'id_order'){
                        ?>
                                <tr>
                                    <td><?php echo $result['cpf']?></td>
                                    <td id="editSvg" value="<?php echo $result['id_order']?>"
                                        onclick="showModal('#editModal' , '<?php echo $result['id_order'] ?>')"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                            class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                        </svg>
                                    </td>
                                </tr>
                        <?php
                    } else {
                        foreach($result as $key){
                        ?>
                            <tr>
                                <td><?php echo $key['cpf']?></td>
                                <td id="editSvg" value="<?php echo $key['id_order']?>"
                                    onclick="showModal('#editModal' , '<?php echo $key['id_order'] ?>')"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </td>
                            </tr>
                        <?php
                        }
                    }
                    unset($_SESSION['json-person']);
                } else {
                    include_once('../conn.php');
                    $conn = new Conn;
                    $connect = $conn->connDB();

                    $sql = mysqli_query($connect, "SELECT * FROM bazar.order ORDER BY cpf ASC");
                    
                    while($result = mysqli_fetch_array($sql)){
                        ?>
                        <tr>
                            <td><?php echo $result['cpf']?></td>    
                            <td id="editSvg" value="<?php echo $result['id_order']?>"
                                onclick="showModal('#edit-modal-cpf' , '<?php echo $result['id_order'] ?>')"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </td>
                        </tr>
                        <?php
                    }
                }
        ?>
            </tbody>
        </table>

    </div>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
</body>

</html>