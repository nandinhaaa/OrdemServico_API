<?php 

require_once("conecta_db.php");

function checaUsuario($email,$senha){
    $conexao = conecta_db();
    $senhaMD5 = md5($senha);
    $query = "SELECT * 
              FROM usuario 
              WHERE email='$email' and 
                senha='$senhaMD5'";

    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaUsuarios(){
  $conexao = conecta_db();
  $usuarios = array();
  $query = "SELECT * 
            FROM  usuario
            ORDER by nome";

  $resultado = mysqli_query($conexao,$query);
  while($dados = mysqli_fetch_array($resultado)) {
    array_push($usuarios,$dados);
  }

  return $usuarios;
}

function buscaUsuario($email){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM usuario
            WHERE email='$email'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  return $dados;
}

function cadastraUsuario($nome,$email,$telefone,$senha,$cep,$endereco,$numero,$bairro,$cidade,$estado,$status,$perfil,$data){
  $conexao = conecta_db();
  $query = "INSERT INTO usuario(nome,email,telefone,senha,cep,endereco,numero,bairro,cidade,estado,status,perfil,data) 
            VALUES ('$nome','$email','$telefone','$senha','$cep','$endereco','$numero','$bairro','$cidade','$estado','$status','$perfil','$data')";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_affected_rows($conexao);

  return $dados;
}

function buscaUsuarioeditar($codigo){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM usuario 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_fetch_array($resultado);

  return $dados;
}

function editarPerfilUsuario($codigo,$nome,$email,$telefone,$cep,$endereco,$numero,$bairro,$cidade,$estado,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM usuario 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  usuario
              SET nome = '$nome', email = '$email', telefone = '$telefone', cep = '$cep', endereco = '$endereco', 
                      numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function editarSenhaUsuario($codigo,$senha){
  
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM usuario
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE usuario
              SET senha = '$senha'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function editarUsuario($codigo,$status,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM usuario 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  usuario
              SET status = '$status' ,data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function removeUsuario($codigo){
  $conexao = conecta_db();
    $query = "delete from usuario where cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;

}
?>