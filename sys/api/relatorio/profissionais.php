<?php
include '../../conexao.php';

justLog($__EMAIL__, $__TYPE__, 3);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=relatorio_aluno.csv');

$resultado = fopen("php://output", 'w');

$cabecalho = ['id', 'Nome', 'Titularidade', 'E-mail','CPF','Nascimento', 'Turmas'];

fputcsv($resultado, $cabecalho, ';');

$query = mysqli_query($__CONEXAO__, "select id, nome, email, cpf, nascimento, titularidade from users where typeC='2'");

// $arr = array();

while($dados = mysqli_fetch_array($query)){
    $id         = $dados["id"];
    $nome       = decrypt($dados["nome"]);
    $email      = $dados["email"];
    $cpf        = decrypt($dados["cpf"]);
    $nascimento = date('d/m/Y', (decrypt($dados["nascimento"])+ 86400));
    
    $turmas = "";
    
    $getTurmas = mysqli_query($__CONEXAO__, "select nome from turmas where id in (select turma from alunos where email='$email')");
    
    while($t = mysqli_fetch_array($getTurmas)){
        $nm = decrypt($t["nome"]);
        if($turmas == ""){
             $turmas .= $nm;
        } else {
            $turmas .= ", $nm";
        }
    }
    
    $cpf = "c-$cpf";

    $content = array(
        $id,
        $nome,
        decrypt($email),
        $cpf,
        $nascimento,
        $turmas
    );

    // array_push($arr, $content);
    fputcsv($resultado, $content, ';');

}

// echo "<pre>";
// var_dump($arr);
// echo "</pre>";
