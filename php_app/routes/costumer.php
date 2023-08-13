<?php

use \App\Http\Response;
use \App\Controller\Pages\Read;
use \App\Controller\Pages\Create;

//ROTA COSTUMER
//LISTAGEM
$obRouter->get('/costumer', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Read\Costumer::getCostumer($request));
    }
]);

//REGISTRO
$obRouter->get('/registerCostumer', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, Create\registerCostumer::getRegisterCostumer());
    }
]);

$obRouter->post('/registerCostumer', [
    function ($request) {

        return new Response(200, Create\registerCostumer::setRegisterCostumer($request));
    }
]);

//UPDATE
$obRouter->get('/updateCostumer/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request,$id) {
        return new Response(200, Read\Costumer::getUpdateCostumer($request,$id));
    }
]);

$obRouter->post('/updateCostumer/{id}/edit', [
    function ($request,$id) {
        return new Response(200, Read\Costumer::setUpdateCostumer($request,$id));
    }
]);
