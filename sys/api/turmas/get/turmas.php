<?php
include '../../../conexao.php';

justLog($__EMAIL__, $__TYPE__, 0);

$complemento = '';

if($__TYPE__ == 2){
    $_query_ = mysqli_query($__CONEXAO__, "select * from turmas");
} else {
    $table = 'alunos';
    if($__TYPE__ == 1){
        $table = 'professores';
    }
    $query = mysqli_query($__CONEXAO__, "select * from $table where email='$__EMAIL__'");
    $turmas = '';
    while($getQuery = mysqli_fetch_array($query)){
        $value = $getQuery['turma'];
        $valuedec = decrypt($value);
        $turmas .= $valuedec . ' , ';
    }
    $turmas = substr($turmas, 0, -3);
    $_query_ = mysqli_query($__CONEXAO__, "select * from turmas where id in ($turmas)");
}

$array = array();

while($dados = mysqli_fetch_array($_query_)){
    $nome = decrypt($dados["nome"]);
    $categoria = decrypt($dados["categoria"]);

    $status = $dados["active"];

    $status = $status == '1' ? "active" : "inactive";

    $idC = encrypt($dados["id"]);

    $query = mysqli_query($__CONEXAO__, "select id from alunos where turma='$idC'");
    $query2 = mysqli_query($__CONEXAO__, "select id from professores where turma='$idC'");

    $arr = array(
        "id"            => $dados["id"], 
        "nome"          => $nome, 
        "categoria"     => $categoria,
        "alunos"        => mysqli_num_rows($query),
        "profissionais" => mysqli_num_rows($query2),
        "status"        => $status
    );
    array_push($array, $arr);
}

endCode($array, true);