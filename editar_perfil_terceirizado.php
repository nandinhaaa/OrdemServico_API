<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once ("bd/bd_terceirizado.php");
require_once ("cep_envia.php");

$dados = buscaTerceirizadoeditar($_SESSION['cod_usu']);
$nome = $dados["nome"];
$email = $dados["email"];
$telefone = $dados["telefone"];
$cep = $dados["cep"];
$endereco = $dados["endereco"];
$numero = $dados["numero"];
$bairro = $dados["bairro"];
$cidade = $dados["cidade"];
$estado = $dados["estado"];
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR DADOS DO TERCEIRIZADO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php
                if (isset($_SESSION['texto_erro'])):
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;<?= $_SESSION['texto_erro'] ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    unset($_SESSION['texto_erro']);
                endif;
                ?>

                <?php
                if (isset($_SESSION['texto_sucesso'])):
                    ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i>&nbsp;&nbsp;<?= $_SESSION['texto_sucesso'] ?></strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                    unset($_SESSION['texto_sucesso']);
                endif;
                ?>

                <form class="user" action="editar_perfil_terceirizado_envia.php" method="post">
                    <input type="hidden" name="cod" value="<?=$_SESSION['cod_usu']?>">

                        <div class="form-group">
                            <label> Nome Completo </label>
                            <input type="text" class="form-control form-control-user" id="nome" name="nome" value="<?= $nome ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" class="form-control form-control-user" id="email" name="email" value="<?= $email ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Telefone - Ex.: (11) 91234-1234 </label>
                            <input type="tel" class="form-control form-control-user" id="telefone" name="telefone" value="<?=$telefone ?>"maxlength="15" placeholder="(xx)xxxxx-xxxx" required >
                        </div>

                        <div class="form-group">
                            <label> CEP </label>
                            <input type="text" class="form-control form-control-user" id="cep" name="cep" value="<?= $cep ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Rua </label>
                            <input type="text" class="form-control form-control-user" id="endereco" name="endereco" value="<?= $endereco ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Numero </label>
                            <input type="number" class="form-control form-control-user" id="numero" name="numero" value="<?= $numero ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Bairro </label>
                            <input type="text" class="form-control form-control-user" id="bairro" name="bairro" value="<?= $bairro ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Cidade </label>
                            <input type="text" class="form-control form-control-user" id="cidade" name="cidade" value="<?= $cidade ?>"required>
                        </div>

                        <div class="form-group">
                            <label> Estado </label>
                            <input type="text" class="form-control form-control-user" id="estado" name="estado" value="<?= $estado ?>"required>
                        </div>

                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="home.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <a title="Atualizar"><button type="submit" name="updatebtn" class="btn btn-primary uptadebtn"><i class="fas fa-edit">&nbsp;</i>Atualizar</button> </a>
                        </div>
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Scripts JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    
    <!-- Script para buscar e preencher o endereço pelo CEP -->
    <script>
    document.getElementById('cep').addEventListener('blur', function() {
        const cep = this.value.replace(/\D/g, '');
        if (cep) {
            const url = `https://viacep.com.br/ws/${cep}/json/`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (!data.erro) {
                        document.getElementById('endereco').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                        document.getElementById('estado').value = data.uf
                    } else {
                        alert('CEP não encontrado!');
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar o CEP:', error);
                });
        }
    });
</script>

<?php
require_once('footer.php');
?>