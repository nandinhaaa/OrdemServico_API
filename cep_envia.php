<?php

// Inicialize as variáveis antes de verificar a requisição à API
$logradouro = $bairro = $cidade = $estado = '';

if (isset($_POST['cep'])) {
    $cep = $_POST['cep'];
    $url = "http://viacep.com.br/ws/{$cep}/json/";

    // Obtém os cabeçalhos da resposta HTTP
    $headers = get_headers($url);

    // Verifica se o status da resposta é 200 (OK)
    if ($headers && strpos($headers[0], '200') !== false) {
        $address = file_get_contents($url);

        // Verifica se a decodificação do JSON foi bem-sucedida antes de acessar as propriedades
        $addressData = json_decode($address);

        if ($addressData !== null) {
            $logradouro = $addressData->logradouro ?? '';
            $bairro = $addressData->bairro ?? '';
            $cidade = $addressData->localidade ?? '';
            $estado = $addressData->uf ?? '';
        } else {
            // Tratamento para falha na decodificação do JSON
            $logradouro = $bairro = $cidade = $estado = '';
        }
    } else {
        echo "<p>Não foi possível acessar a API. Verifique se o link está correto.</p>";
        // Tratamento para falha na requisição à API
        $logradouro = $bairro = $cidade = $estado = '';
    }
}