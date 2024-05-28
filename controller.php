<?php
use Obt\Iss\Render;

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $render = new Render('home');
        $render->renderView();
        break;
    case 'project':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['for'] == 'save') {
//            header('Content-type: application/json');
            $teste = json_decode(file_get_contents('php://input'), true);
            http_response_code(200);
            echo var_export($teste, true);
            exit;
        }
        $render = new Render('project');
        $render->renderView();
        break;
}