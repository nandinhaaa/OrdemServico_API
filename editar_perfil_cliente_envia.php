<?php
require_once("valida_session.php");
require_once ("bd/bd_cliente.php");
         
$codigo = $_POST["cod"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$cep = $_POST["cep"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$data=date("y/m/d");

$dados = editarPerfilCliente($codigo,$nome,$email,$telefone,$cep,$endereco,$numero,$bairro,$cidade,$estado,$data);
if ($dados == 1){
    $_SESSION['nome_usu'] = $nome;
    $_SESSION['texto_sucesso'] = 'Os dados do cliente foram alterados no sistema.';
    header ("Location:editar_perfil_cliente.php");
}else{
    $_SESSION['texto_erro'] = 'Os dados do cliente não foram alterados no sistema!';
    header ("Location:editar_perfil_cliente.php");
}

        
?>