<?php
session_start(); // Certifique-se de iniciar a sessão
require_once('bd/conecta_db.php'); // Ajuste o caminho conforme sua estrutura de diretórios

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nova_senha = md5($_POST['nova_senha']); // Criptografa a nova senha

    // Verifica se o e-mail existe nas tabelas usuario, cliente e terceirizado
    $tabelas = ['usuario', 'cliente', 'terceirizado'];
    $usuario_encontrado = false;
    $conexao = conecta_db(); // Chama a função para conectar ao banco

    foreach ($tabelas as $tabela) {
        $query = "SELECT * FROM $tabela WHERE email = '$email'";
        $result = mysqli_query($conexao, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $update_query = "UPDATE $tabela SET senha = '$nova_senha' WHERE email = '$email'";
            if (mysqli_query($conexao, $update_query)) {
                $_SESSION['msg_sucesso'] = "Senha atualizada com sucesso.";
            } else {
                $_SESSION['msg_erro'] = "Erro ao atualizar a senha. Tente novamente.";
            }
            $usuario_encontrado = true;
            break;
        }
    }

    if (!$usuario_encontrado) {
        $_SESSION['msg_erro'] = "E-mail não encontrado.";
    }

    header('Location: esqueci_senha.php');
    exit();
}
?>
