<?php
include '../../../conexao.php';

justLog($__EMAIL__, $__TYPE__, 1);

header('Content-Type: application/json; charset=utf-8');

$request    = file_get_contents('php://input');
$json       = json_decode($request);

$type       = scapeString($__CONEXAO__, $json->type);

$type       = setString($type);

checkMissing(
    array(
        $type
    )
);

$type = decrypt($type);

$pode = array("users", "turmas", "categorias", "eventos");

if($type == "usersprofessor"){
    $type = "users";
    $adicional = "where typeC='1'";
}

if($type == "usersalunos"){
    $type = "users";
    $adicional = "where typeC='0'";
}

if(!in_array($type, $pode)){
    endCode("Pesquisa inválida.", false);
}

$query = mysqli_query($__CONEXAO__, "select active from $type $adicional") or die("erro");
// asdsdasdasd
$active = 0;
$inactive = 0;

while($dados = mysqli_fetch_array($query)){
    $act = $dados['active'];
    
    if($act == '1'){
        $active++;
    } else {
        $inactive++;
    }
}

endCode(array("active"=>$active, "inactive"=>$inactive), true);