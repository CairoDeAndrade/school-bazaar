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
      if(isset($_SESSION['register'])){
        
          if($_SESSION['register'] === 'Duplicity'){
            ?>
                <script>
                    showModalInformation("Erro!" , "Erro ao cadastrar, cpf já existente!");
                </script>
            <?php
          }
          if($_SESSION['register'] === true){
            ?>
                <script>
                    showModalInformation("Cadastrado!" , "A compra foi cadastrada com sucesso!");
                </script>
            <?php
          }
          if($_SESSION['register'] === false){
            ?>
                <script>
                    showModalInformation("Erro!" , "Erro ao cadastrar no banco de dados, tente novamente ou entre em contato com o Administrador");
                </script>
            <?php
          }
          unset($_SESSION['register']);
      }
      if(isset($_SESSION['edit'])){
            if($_SESSION['edit'] === true){
                ?>
                    <script>
                        showModalInformation("Editado!" , "A compra foi editada com sucesso!");
                    </script>
                <?php
            } 
            if($_SESSION['edit'] === false){
                ?>
                    <script>
                        showModalInformation("Erro!" , "Erro ao editar, tente novamente ou entre em contato com o administrador!");
                    </script>
                <?php
            }
            if($_SESSION['edit'] === 'Valor Acima'){
                ?>
                    <script>
                        showModalInformation("Atenção!" , "O valor ultrapassou o limite de R$1000!");
                    </script>
                <?php
            }
            unset($_SESSION['edit']);
      }

      if(isset($_SESSION['error-search'])){
        ?>
                    <script>
                        showModalInformation("Atenção!" , "O CPF digitado não existe!");
                    </script>
        <?php
            unset($_SESSION['error-search']);
      }
  ?>

    <!-- Register modal -->
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
    <div class='modal fade' id='register' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        data-backdrop='static'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title text-center'>Cadastrar Pedido</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                            aria-hidden='true'>×</span></button>
                </div>
                <div class='modal-body'>
                    <form class='form-horizontal' method='POST'
                        action='http://26.155.119.91/school-bazaar/school-bazaar/order/register.php'>
                        <div class='form-group'>
                            <label for='inputEmail3' class='col-sm-2 control-label'>CPF</label>
                            <div class='col-sm-10'>
                                <input type='text' name='cpf' id='cpf'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='inputEmail3' class='col-sm-2 control-label'>Valor</label>
                            <div class='col-sm-10'>
                                <input type='text' name='value' id='value'>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="btnRegister">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit moodal -->
    <div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel'
        data-backdrop='static'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h4 class='modal-title text-center'>Editar Compra</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span
                            aria-hidden='true'>×</span></button>
                </div>
                <div class='modal-body'>
                    <form class='form-horizontal' method='POST' action='http://26.155.119.91/school-bazaar/school-bazaar/order/update.php'>
                        <div class='form-group'>
                            <label for='inputEmail3' class='col-sm-2 control-label'>CPF</label>
                            <div class='col-sm-10'>
                                <input type='text' name='cpf-edit' id='cpf-edit' readonly>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='inputEmail3' class='col-sm-2 control-label'>Valor</label>
                            <div class='col-sm-10'>
                                <input type='number' name='value-edit' id='value-edit' maxlength="15" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnEdit" name="btnEdit">Editar</button>
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
                <button type="button" class="btn btn-light" id="btn-sync" onclick="refresh()">Sincronizar</button>
                <button style='display: none;' type="button" class="btn btn-light" id="btn-refresh" onclick="refresh()">Limpar Busca</button>
            </ul>

            <form class="form-inline mt-2 mt-md-0" METHOD='GET' action='get_order.php'>
                <input class="form-control mr-sm-2" type="text" name='cpf-search' placeholder="Digite um CPF..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>

    </nav>

    <div class="content">

        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">CPF</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Data da Última Compra</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>

            <tbody>
                <?php

                if(isset($_SESSION['json'])){ 
                    ?>
                        <script>
                            var element1 = document.getElementById('btn-refresh');
                            var element2 = document.getElementById('btn-sync');
                            element1.style.display = 'block';
                            element2.style.display = 'none';
                        </script>
                    <?php
                    $result = json_decode($_SESSION['json'], true);
                    
                    
                    if(array_key_first($result) === 'id_order'){
                        ?>
                                <tr>
                                    <td><?php echo $result['cpf']?></td>
                                    <td><?php echo "R$" .$result['value']?></td>
                                    <?php
                                        if($result['value'] === "0"){
                                            ?>
                                                <td>Sem Compra</td>
                                            <?php
                                        } else {
                                            ?>
                                                <td><?php echo date('d/m/Y H:i:s' , strtotime($result['date_inserted']))?></td>
                                            <?php     
                                        }
                                    ?>
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
                                <td><?php echo "R$" .$key['value']?></td>
                                <?php
                                    if($key['value'] === "0"){
                                        ?>
                                            <td>Sem Compra</td>
                                        <?php
                                    } else {
                                        ?>
                                            <td><?php echo date('d/m/Y H:i:s' , strtotime($key['date_inserted']))?></td>
                                        <?php     
                                    }
                                ?>
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
                    unset($_SESSION['json']);
                } else {
                    include_once('../conn.php');
                    $conn = new Conn;
                    $connect = $conn->connDB();

                    $sql = mysqli_query($connect, "SELECT * FROM bazar.order ORDER BY date_inserted DESC");
                    
                    while($result = mysqli_fetch_array($sql)){
                        ?>
                        <tr>
                            <td><?php echo $result['cpf']?></td>
                            <td><?php echo "R$" .$result['value']?></td>
                            <?php
                                if($result['value'] === "0"){
                                    ?>
                                        <td>Sem Compra</td>
                                    <?php
                                } else {
                                    ?>
                                        <td><?php echo date('d/m/Y H:i:s' , strtotime($result['date_inserted']))?></td>
                                    <?php     
                                }
                            ?>
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