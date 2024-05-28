<?php
use Obt\Iss\{Render, Project};

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
            $project = new Project($teste['name'], $teste['description'], $teste['country'], $teste['state'], $teste['steps']);
            $result = $project->save();
            http_response_code(200);
            echo var_export($result, true);
            exit;
        }
        $render = new Render('project');
        $render->renderView();
        break;
}