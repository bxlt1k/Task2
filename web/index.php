<?php

include 'database/connect.php';
require_once 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$url = rtrim($_SERVER['REQUEST_URI'], '/');
$urls = explode('/', $url);

$router = explode('?', $urls[1]);
$users = $router[0];
$urlData = array_slice($urls, 2);
$id = $urlData[0];

$data = file_get_contents('php://input');
$data = json_decode($data, true);

if ($users !== 'users') {
    jsonResponse('Request is incorrect',404);
    return;
}

switch ($method) {
    case 'GET':
        if (isset($id)) {
            getUser($db, $id);
        } else {
            getUsers($db, $_GET);
        }
        break;
    case 'POST':
        if (!isset($id)) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            addUser($db, $data);
        } else {
            http_response_code(404);
        }
        break;
    case 'DELETE':
        if (isset($id)) {
            deleteUser($db, $id);
        } else {
            http_response_code(404);
        }
        break;
    case 'PUT':
        if (isset($id)) {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            updateUser($db, $id, $data);
        } else {
            http_response_code(404);
        }
        break;
}