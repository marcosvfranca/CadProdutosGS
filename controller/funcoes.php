<?php

function soNumeros($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

function validarData($data) {
    $vetor = explode("-", $data);
    if (count($vetor) == 3) {
        $dia = $vetor[2];
        $mes = $vetor[1];
        $ano = $vetor[0];
        return checkdate($mes, $dia, $ano);
    } else {
        return false;
    }
}

function converterData($data) {

    $vetor = explode("/", $data);
    if (count($vetor) == 3) {
        $dia = $vetor[0];
        $mes = $vetor[1];
        $ano = $vetor[2];
        return "$ano-$mes-$dia";
    } else {
        return null;
    }
}

function converterDataFace($data) {

    $vetor = explode("/", $data);
    if (count($vetor) == 3) {
        $dia = $vetor[1];
        $mes = $vetor[0];
        $ano = $vetor[2];
        return "$ano-$mes-$dia";
    } else {
        return null;
    }
}

function converterBancoToData($data) {
    return date('d/m/Y', strtotime($data));
}

function mask($val, $mask) {
    $masks = [
        "CNPJ" => "##.###.###/####-##",
        "CPF" => "###.###.###-##"
    ];
    $mask = (isset($masks[$mask])) ? $masks[$mask] : $mask;
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k]))
                $maskared .= $val[$k++];
        } else {
            if (isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

function coalesce($str, $retorno) {
    return (empty($str)) ? $retorno : $str;
}

function retornaUrlImagem($file) {
    $arquivo = __DIR__ . "/../img/$file";
    if (is_file($arquivo))
        return /*(isset($GLOBALS['serverPath'])) ? "{$GLOBALS['serverPath']}img/$file" : null .*/ "../img/$file";
    else
        return null;
}

function salvaImagem($arquivoTmp, $nome, $diretorio, $nomeImagem = null) {
    $newNomeImagem = (empty($nomeImagem)) ? md5(uniqid(rand(), true) . time()) : $nomeImagem;
    $extensao = "." . strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $novoNome = $newNomeImagem . $extensao;
// Concatena a pasta com o nome
    $destino = __DIR__ . "/../img/$diretorio";
    if (!is_dir($destino))
        mkdir($destino, 0755, true);
// tenta mover o arquivo para o destino
    if (move_uploaded_file($arquivoTmp, "$destino/$novoNome")) {
        return "$diretorio/$novoNome";
    } else {
        return false;
    }
}

function salvaImagemBase64($data, $nome, $diretorio, $nomeImagem = null) {
    $newNomeImagem = (empty($nomeImagem)) ? md5(uniqid(rand(), true) . time()) : $nomeImagem;
    $extensao = "." . strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $novoNome = $newNomeImagem . $extensao;
// Concatena a pasta com o nome
    $destino = __DIR__ . "/../img/$diretorio";
    if (!is_dir($destino))
        mkdir($destino, 0755, true);

    list($type, $data) = explode(';', $data);
    list(, $data) = explode(',', $data);
    $data = base64_decode($data);

// tenta mover o arquivo para o destino
    if (file_put_contents("$destino/$novoNome", $data)) {
        return "$diretorio/$novoNome";
    } else {
        return false;
    }
}

function salvaImagemGD($original, $nome, $thumb_w, $thumb_h, $diretorio, $nomeImagem = null) {
    $newNomeImagem = (empty($nomeImagem)) ? md5(uniqid(rand(), true) . time()) : $nomeImagem;
    $extensao = "." . strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $novoNome = $newNomeImagem . $extensao;
// Concatena a pasta com o nome
    $destino = __DIR__ . "/../img/$diretorio";
    if (!is_dir($destino))
        mkdir($destino, 0755, true);

    $original_info = getimagesize($original);
    $original_w = $original_info[0];
    $original_h = $original_info[1];
    $original_img = imagecreatefrompng($original);
    $thumb_img = imagecreatetruecolor($thumb_w, $thumb_h);
    imagecopyresampled($thumb_img, $original_img, 0, 0, 0, 0, $thumb_w, $thumb_h, $original_w, $original_h);
    $retorno = (imagepng($thumb_img, "$destino/$novoNome")) ? true : false;
    imagedestroy($thumb_img);
    imagedestroy($original_img);

// tenta mover o arquivo para o destino
    if ($retorno)
        return "$diretorio/$novoNome";
    else
        return false;
}

function deletaImagem($caminhoImagem) {
    $caminhoFinal = __DIR__ . "/../img/$caminhoImagem";
    if (is_file($caminhoFinal))
        return unlink($caminhoFinal);
    else
        return true;
}

function escreveAttrHtml($array, $nomeTabela, $prefixo = 'data') {
//escreve os atributos de uma tag para alteração exclusao etc se existir o id ele substitui por token, e retorna o md5
//      se existir chave estrangeira mantem o nome e troca o id por token para mascarar
    $retorno = " ";

    foreach ($array as $chave => $valor) {
        $valor = str_replace(['"', "'"], ["&quot;", "&apos;"], $valor);
        if (substr($chave, 0, 2) == 'id' && strlen($chave) == 2) {
            $retorno .= "$prefixo-token$nomeTabela='" . md5($valor) . "' ";
        } else if (substr($chave, 0, 2) == 'id') {
            $retorno .= "$prefixo-token" . substr($chave, 2, strlen($chave)) . "='" . md5($valor) . "' ";
        } else if (substr($chave, 0, 2) == 'vl') {
            $retorno .= "$prefixo-$chave='" . number_format($valor, 2, ',', '.') . "' ";
        } else {
            $retorno .= "$prefixo-$chave='$valor' ";
        }
    }

    return $retorno;
}
