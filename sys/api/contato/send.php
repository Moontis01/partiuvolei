<?php
include '../../conexao.php';

// justLog($__EMAIL__, $__TYPE__, 2);

header('Content-Type: application/json; charset=utf-8');

$request = file_get_contents('php://input');
$json = json_decode($request);

$nome       = scapeString($__CONEXAO__, $json->nome);
$email      = scapeString($__CONEXAO__, $json->email);
$telefone   = scapeString($__CONEXAO__, $json->telefone);

$nome       = setString($nome);
$email       = setString($email);
$telefone   = setNum($telefone);

checkMissing(
    array(
        $nome,
        $email,
        $telefone
    )
);

$check = mysqli_query($__CONEXAO__, "select id from contatos where telefone='$telefone' or email='$email'")
