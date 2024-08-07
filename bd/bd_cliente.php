<?php 

require_once("conecta_db.php");

function checaCliente($email,$senha){
    $conexao = conecta_db();
    $senhaMD5 = md5($senha);
    $query = "SELECT * 
              FROM cliente 
              WHERE email='$email' and 
                senha='$senhaMD5'";

    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaClientes(){
  $conexao = conecta_db();
  $usuarios = array();
  $query = "SELECT * 
            FROM  cliente
            ORDER by nome";

  $resultado = mysqli_query($conexao,$query);
  while($dados = mysqli_fetch_array($resultado)) {
    array_push($usuarios,$dados);
  }

  return $usuarios;
}

function buscaCliente($email){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM cliente
            WHERE email='$email'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  return $dados;
}

function cadastraCliente($nome,$email,$telefone,$senha,$cep,$endereco,$numero,$bairro,$cidade,$estado,$status,$perfil,$data){
  $conexao = conecta_db();
  $query = "INSERT INTO cliente(nome,email,telefone,senha,cep,endereco,numero,bairro,cidade,estado,status,perfil,data) 
            VALUES ('$nome','$email','$telefone','$senha','$cep','$endereco','$numero','$bairro','$cidade','$estado','$status','$perfil','$data')";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_affected_rows($conexao);

  return $dados;
}

function buscaClienteeditar($codigo){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM cliente 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_fetch_array($resultado);

  return $dados;
}

function editarPerfilCliente($codigo,$nome,$email,$telefone,$cep,$endereco,$numero,$bairro,$cidade,$estado,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM cliente 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  cliente
              SET nome = '$nome', email = '$email', telefone = '$telefone', cep = '$cep', endereco = '$endereco', 
                      numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function editarSenhaCliente($codigo,$senha){
  
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM cliente
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  cliente
              SET senha = '$senha'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function editarCliente($codigo,$status,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM cliente 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  cliente
              SET status = '$status' ,data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function removeCliente($codigo){
  $conexao = conecta_db();
    $query = "delete from cliente where cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;

}
function clienteVinculadoOrdem($codigo_cliente) {
  $conexao = conecta_db();
  $query = "SELECT COUNT(*) AS total FROM ordem WHERE cod_cliente = '$codigo_cliente'";
  $resultado = mysqli_query($conexao, $query);
  $dados = mysqli_fetch_array($resultado);
  return $dados['total'] > 0;
}
?>