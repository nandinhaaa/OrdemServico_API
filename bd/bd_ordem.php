<?php 
require_once("conecta_db.php");

function consultaStatusUsuario($status){
    $conexao = conecta_db();
    $query = "SELECT count(*) AS total
                FROM ordem
            WHERE status = '$status'";
    $resultado = mysqli_query($conexao,$query);
    $total  = mysqli_fetch_assoc($resultado);
    return $total;
}

function consultaStatusCliente( $cod_usuario,$status){
    $conexao = conecta_db();
    $query = "SELECT count(*) AS total
                FROM ordem
            WHERE cod_cliente='$cod_usuario' and status = '$status'";
    $resultado = mysqli_query($conexao,$query);
    $total  = mysqli_fetch_assoc($resultado);
    return $total;
}

function consultaStatusTerceirizado( $cod_usuario,$status){
    $conexao = conecta_db();
    $query = "SELECT count(*) AS total
                FROM ordem
            WHERE cod_terceirizado='$cod_usuario' and status = '$status'";
    $resultado = mysqli_query($conexao,$query);
    $total  = mysqli_fetch_assoc($resultado);
    return $total;
}

function listaOrdem(){
    $conexao = conecta_db();
    $ordem = array();
    $query = "SELECT
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_terceirizada,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.status AS status
              FROM  ordem o,servico s, cliente c, terceirizado t
              where o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_terceirizado = t.cod
              ORDER by o.status ASC";
  
    $resultado = mysqli_query($conexao,$query);
    while($dados = mysqli_fetch_array($resultado)) {
      array_push($ordem,$dados);
    }
  
    return $ordem;
}

function cadastraOrdem($cod_cliente,$cod_servico,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_db();
    $query = "INSERT INTO ordem(cod_cliente,cod_servico,cod_terceirizado,data_servico,status,data) 
              VALUES ('$cod_cliente','$cod_servico','$cod_terceirizado','$data_servico','$status','$data')";
  
    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_affected_rows($conexao);
  
    return $dados;
}

function buscaOrdemadd (){
    $conexao = conecta_db();

	$query = "Select 
			  c.nome AS nome_cliente,
			  t.nome AS nome_terceirizada,
			  s.nome AS nome_servico,
			  s.valor AS valor_servico,
			  o.data_servico AS data_servico,
			  o.status AS status
			  From ordem o,servico s, cliente c, terceirizado t 
			  Where o.cod_cliente = c.cod AND 
			        o.cod_servico = s.cod AND 
			        o.cod_terceirizado = t.cod
			  ORDER BY o.cod DESC LIMIT 1";
						  
	$resultado = mysqli_query($conexao, $query);
	$dados = mysqli_fetch_array($resultado);

	return $dados;
}

function buscaOrdemeditar($codigo){
    $conexao = conecta_db();
	$query = "Select 
			  o.cod AS cod,
			  c.nome AS nome_cliente,
			  t.nome AS nome_terceirizada,
			  s.nome AS nome_servico,
			  o.data_servico AS data_servico,
			  o.status AS status,
			  t.cod AS cod_terceirizado
			  From ordem o,servico s, cliente c, terceirizado t 
			  Where o.cod_cliente = c.cod AND 
			        o.cod_servico = s.cod AND 
			        o.cod_terceirizado = t.cod AND
			        o.cod = '$codigo'";
						  
	$resultado = mysqli_query($conexao, $query);
	$dados = mysqli_fetch_array($resultado);

	return $dados;
}

function editarOrdem($codigo,$cod_terceirizado,$data_servico,$status,$data){
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM ordem
              WHERE cod='$codigo'";
  
    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_num_rows($resultado);
  
    if($dados == 1){
      $query = "UPDATE  ordem
                SET cod_terceirizado = '$cod_terceirizado', data_servico = '$data_servico', status = '$status', data = '$data'
                WHERE cod = '$codigo'";
       $resultado = mysqli_query($conexao,$query);
       $dados = mysqli_affected_rows($conexao);
       return $dados;
    }
  }
  
  function listaOrdemCliente(){
    $conexao = conecta_db();
    $ordem = array();
    $query = "SELECT
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_terceirizada,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.status AS status
              FROM  ordem o,servico s, cliente c, terceirizado t
              where o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_terceirizado = t.cod AND
                    o.cod_cliente = '".$_SESSION['cod_usu']."'
              ORDER by o.status ASC";
  
    $resultado = mysqli_query($conexao,$query);
    while($dados = mysqli_fetch_array($resultado)) {
      array_push($ordem,$dados);
    }
  
    return $ordem;
}

function listaOrdemTerceirizado(){
    $conexao = conecta_db();
    $ordem = array();
    $query = "SELECT
              o.cod AS cod,
              c.nome AS nome_cliente,
              t.nome AS nome_terceirizada,
              s.nome AS nome_servico,
              o.data_servico AS data_servico,
              o.status AS status
              FROM  ordem o,servico s, cliente c, terceirizado t
              where o.cod_cliente = c.cod AND
                    o.cod_servico = s.cod AND
                    o.cod_terceirizado = t.cod AND
                    o.cod_terceirizado = '".$_SESSION['cod_usu']."'
              ORDER by o.status ASC";
  
    $resultado = mysqli_query($conexao,$query);
    while($dados = mysqli_fetch_array($resultado)) {
      array_push($ordem,$dados);
    }
  
    return $ordem;
}

function removeOrdem($codigo){
    $conexao = conecta_db();
      $query = "delete from ordem where cod = '$codigo'";
      $resultado = mysqli_query($conexao, $query);
      $dados = mysqli_affected_rows($conexao);
      return $dados;
  
  }

  function editarOrdemTerceirizado($codigo,$data_servico,$status,$data){
    $conexao = conecta_db();
    $query = "SELECT * 
              FROM ordem
              WHERE cod='$codigo'";
  
    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_num_rows($resultado);
  
    if($dados == 1){
      $query = "UPDATE  ordem
                SET data_servico = '$data_servico', status = '$status', data = '$data'
                WHERE cod = '$codigo'";
       $resultado = mysqli_query($conexao,$query);
       $dados = mysqli_affected_rows($conexao);
       return $dados;
    }
  }
?>


