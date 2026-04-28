<?php
header("Acess-control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Acess-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTION");

echo json_encode(array("Mensagem" => "Olá! Bem vindo á Juca Pizzas!"));

