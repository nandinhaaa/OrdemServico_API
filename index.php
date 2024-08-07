<?php
session_start();
require_once('header.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// O restante do seu código


?>


<body class="bg-gradient-light">

    <div class="container">

        <!-- Outer Row -->
        <div class="row vh-100 justify-content-center align-items-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-info font-weight-bold mb-4">Gerenciador de Ordem de Serviço</h1>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['texto_erro_login'])):
                                    ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro_login'] ?></strong> 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php
									unset($_SESSION['texto_erro_login']);
                                    endif;
                                    ?>
                                    
                                    <form class="user" action="valida_login.php" method="post">
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="email" class="form-control form-control-user"
                                                id="email" name="email" aria-describedby="emailHelp"
                                                placeholder="Endereço de Email..." required>
                                        </div>
                                        <div class="form-group">
                                            <label> Senha </label>
                                            <input type="password" class="form-control form-control-user"
                                                id="senha" name="senha" placeholder="Senha" required>
                                        </div>
                                        <div class="form-group">
                                            <label> Perfil </label>
                                            <select class="form-control" id="perfil" name="perfil" required>
                                                <option value=""> </option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Cliente</option>
                                                <option value="3">Terceirizado</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-user btn-block">
                                            Acessar
                                        </button>
                                        <hr>        
                                        <div class="text-center mt-3">
                                            <a class="small" href="esqueci_senha.php">Esqueci minha senha</a>
                                        </div>
                                    <!-- Novo link para cadastro de cliente -->
                                    <div class="text-center mt-2">
                                        <a class="small" href="cadastrar_novo_cliente.php">Cadastrar Cliente</a>
                                    </div>

                                        
                                    </form>
                                    
                                    <div class="text-center">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/validate.js"></script>


