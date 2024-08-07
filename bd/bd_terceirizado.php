<?php 

require_once("conecta_db.php");

function checaTerceirizado($email,$senha){
    $conexao = conecta_db();
    $senhaMD5 = md5($senha);
    $query = "SELECT * 
              FROM terceirizado 
              WHERE email='$email' and 
                senha='$senhaMD5'";

    $resultado = mysqli_query($conexao,$query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function listaTerceirizados(){
  $conexao = conecta_db();
  $usuarios = array();
  $query = "SELECT * 
            FROM  terceirizado
            ORDER by nome";

  $resultado = mysqli_query($conexao,$query);
  while($dados = mysqli_fetch_array($resultado)) {
    array_push($usuarios,$dados);
  }

  return $usuarios;
}

function buscaTerceirizado($email){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM terceirizado
            WHERE email='$email'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  return $dados;
}

function cadastraTerceirizado($nome,$email,$telefone,$senha,$cep,$endereco,$numero,$bairro,$cidade,$estado,$status,$perfil,$data){
  $conexao = conecta_db();
  $query = "INSERT INTO terceirizado(nome,email,telefone,senha,cep,endereco,numero,bairro,cidade,estado,status,perfil,data) 
            VALUES ('$nome','$email','$telefone','$senha','$cep','$endereco','$numero','$bairro','$cidade','$estado','$status','$perfil','$data')";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_affected_rows($conexao);

  return $dados;
}

function buscaTerceirizadoeditar($codigo){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM terceirizado 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_fetch_array($resultado);

  return $dados;
}

function editarPerfilTerceirizado($codigo,$nome,$email,$telefone,$cep,$endereco,$numero,$bairro,$cidade,$estado,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM terceirizado 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  terceirizado
              SET nome = '$nome', email = '$email', telefone = '$telefone', cep = '$cep', endereco = '$endereco', 
                      numero = '$numero', bairro = '$bairro', cidade = '$cidade', estado = '$estado', data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function editarSenhaTerceirizado($codigo,$senha){
  
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM terceirizado
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  terceirizado
              SET senha = '$senha'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function editarTerceirizado($codigo,$status,$data){
  $conexao = conecta_db();
  $query = "SELECT * 
            FROM terceirizado 
            WHERE cod='$codigo'";

  $resultado = mysqli_query($conexao,$query);
  $dados = mysqli_num_rows($resultado);

  if($dados == 1){
    $query = "UPDATE  terceirizado
              SET status = '$status' ,data ='$data'
              WHERE cod = '$codigo'";
     $resultado = mysqli_query($conexao,$query);
     $dados = mysqli_affected_rows($conexao);
     return $dados;
  }
}

function removeTerceirizado($codigo){
  $conexao = conecta_db();
    $query = "delete from terceirizado where cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;

}
function terceirizadoVinculadoOrdem($codigo_terceirizado) {
  $conexao = conecta_db();
  $query = "SELECT COUNT(*) AS total FROM ordem WHERE cod_terceirizado = '$codigo_terceirizado'";
  $resultado = mysqli_query($conexao, $query);
  $dados = mysqli_fetch_array($resultado);
  return $dados['total'] > 0;
}
?>