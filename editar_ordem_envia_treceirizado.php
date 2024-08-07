<?php
require_once("valida_session.php");
require_once ("bd/bd_ordem.php");
	     
$codigo = $_POST["cod"];
$data_servico = $_POST["data_servico"];
$status = $_POST["status"];
$data=date("y/m/d");

$dados = editarOrdemTerceirizado($codigo,$data_servico,$status,$data);
if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados da ordem de serviço foram alterados no sistema.';
	header ("Location:home.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados da ordem de serviço não foram alterados no sistema!';
	header ("Location:home.php");
}

		
?>