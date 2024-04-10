<?php
include '../../../conexao.php';

justLog($__EMAIL__, $__TYPE__, 1);

$complemento = '';

if($__TYPE__ == 3){
    $_query_ = mysqli_query($__CONEXAO__, "select * from eventos");
} else {
    $table = $__TYPE__ == 2 ? 'professores' : 'alunos';
    $_query_ = mysqli_query($__CONEXAO__, "select e.* from eventos e join $table t on e.turmas like '%,' + t.turma + ',%' where t.email='$__EMAIL__'");
}

$array = array();

while($dados = mysqli_fetch_array($_query_)){
    $nome       = decrypt($dados["nome"]);
    $data       = $dados["data"];
    $status     = $dados["active"]; 
    $status     = $status == '1' ? "active" : "inactive";

    $arr = array(
        "id"        => $dados["id"], 
        "nome"      => $nome,
        "data"      => $data,
        "status"    => $status,
        "_name"     => "eventos"
    );
    array_push($array, $arr);
}

endCode($array, true);