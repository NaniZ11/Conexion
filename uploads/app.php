<?php 
require "../vendor/autoload.php";
$router =  new \Bramus\Router\Router();

$router->get("/camper", function(){
    // SELECT *FROM tb_camper;
    $cox = new \App\connect();
    $res = $cox->con->prepare("SELECT * FROM tb_camper");
    $res->execute();
    $res = $res->fetchAll(\PDO::FETCH_ASSOC);
    echo json_encode($res);
});
$router->put("/camper", function(){
    $_DATA = json_decode(file_get_contents('php://input'), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("UPDATE tb_camper SET nombre = :NOMBRE WHERE ID=:CEDULA");
    $res->bindValue("NOMBRE", $_DATA["nom"]);
    $res->bindValue("CEDULA", $_DATA["id"]);
    $res->execute();
    $res= $res->rowCount();
    echo json_encode($res);
});
$router->delete("/camper", function(){
    $_DATA = json_decode(file_get_contents('php://input'), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("DELETE FROM  tb_camper WHERE id=:ID");
    $res->bindValue("ID", $_DATA["id"]);
    $res->execute();
    $res= $res->rowCount();
    echo json_encode($res);
});
$router->post("/camper", function(){
    $_DATA = json_decode(file_get_contents('php://input'), true);
    $cox = new \App\connect();
    $res = $cox->con->prepare("INSERT INTO tb_camper (nombre,edad) VALUES (:nom, :edad");
    $res->bindValue("nom", $_DATA["nom"]);
    $res->bindValue("edad", $_DATA["edad"]);
    $res->execute();
    $res= $res->rowCount();
    echo json_encode($res);
});

$router->run();

?>