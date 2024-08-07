<?php
session_start();

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$senha = md5($_POST["senha"]);
$cep = $_POST["cep"];
$endereco = $_POST["endereco"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$status = $_POST["status"];
$perfil = 2;
$data=date("y/m/d");

require_once ("bd/bd_cliente.php");

$dados = buscaCliente($email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	$_SESSION['telefone'] = $telefone;
	$_SESSION['cep'] = $cep;
	$_SESSION['endereco'] = $endereco;
	$_SESSION['numero'] = $numero;
	$_SESSION['bairro'] = $bairro;
	$_SESSION['cidade'] = $cidade;
	$_SESSION['estado'] = $estado;
	header ("Location:cad_cliente.php");
}else{

	$dados = cadastraCliente($nome,$email,$telefone,$senha,$cep,$endereco,$numero,$bairro,$cidade,$estado,$status,$perfil,$data);

	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['telefone']);
		unset ($_SESSION['senha']);
		unset ($_SESSION['cep']);
		unset ($_SESSION['endereco']);
		unset ($_SESSION['numero']);
		unset ($_SESSION['bairro']);
		unset ($_SESSION['cidade']);
		unset ($_SESSION['estado']);
		header ("Location:cliente.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
		$_SESSION['telefone'] = $telefone;
		$_SESSION['cep'] = $cep;
		$_SESSION['endereco'] = $endereco;
		$_SESSION['numero'] = $numero;
		$_SESSION['bairro'] = $bairro;
		$_SESSION['cidade'] = $cidade;
		$_SESSION['estado'] = $estado;
		header ("Location:cad_cliente.php");
	}
}

?>