<?php 

require_once("conecta_db.php");

function listaServicos(){
    $conexao = conecta_db();
    $usuarios = array();
    $query = "SELECT * 
              FROM  servico
              ORDER by nome";
  
    $resultado = mysqli_query($conexao,$query);
    while($dados = mysqli_fetch_array($resultado)) {
      array_push($usuarios,$dados);
    }
  
    return $usuarios;
}

function cadastraServico($nome,$valor,$data){
  $conexao = conecta_db();
  $query = "INSERT INTO servico(nome,valor,data) 
            VALUES ('$nome','$valor','$data')";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_affected_rows($conexao);

  return $dados;
}

function buscaServicoeditar($codigo){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM servico 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_fetch_array($resultado);

  return $dados;
}

function editarServico($codigo,$nome,$valor,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM servico
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  servico
              SET nome = '$nome',valor = '$valor',data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function removeServico($codigo){
  $conexao = conecta_db();
    $query = "delete from servico where cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;

}
function servicoVinculadoOrdem($codigo_servico) {
  $conexao = conecta_db();
  $query = "SELECT COUNT(*) AS total FROM ordem WHERE cod_servico = '$codigo_servico'";
  $resultado = mysqli_query($conexao, $query);
  $dados = mysqli_fetch_array($resultado);
  return $dados['total'] > 0;
}
?>