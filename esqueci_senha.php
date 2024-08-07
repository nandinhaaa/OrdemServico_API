<?php
session_start();
require_once('header.php');
?>

<body class="bg-gradient-light">
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-4">
                                    <div class="text-center">
                                        <h1 class="h4 text-info font-weight-bold mb-4">Redefinir Senha</h1>
                                    </div>
                                    <form class="user" action="processa_esqueci_senha.php" method="post">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Endereço de Email..." required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nova Senha</label>
                                            <input type="password" class="form-control form-control-user" id="nova_senha" name="nova_senha" placeholder="Nova Senha" required>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-user btn-block">
                                            Redefinir Senha
                                        </button>

                                        <?php if (isset($_SESSION['msg_sucesso'])): ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong><?= $_SESSION['msg_sucesso'] ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['msg_sucesso']); ?>
                                        <?php endif; ?>

                                        <?php if (isset($_SESSION['msg_erro'])): ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong><?= $_SESSION['msg_erro'] ?></strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['msg_erro']); ?>
                                        <?php endif; ?>
                                        <hr>
                                        <div class="text-center mt-3">
                                            <a class="small" href="index.php">Voltar para o Início</a>
                                        </div>
                                    </form>
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
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
