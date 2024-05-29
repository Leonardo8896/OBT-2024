<?php
use Obt\Iss\{Render, Project, SearchProject};
use Obt\Iss\Exceptions\ProjectException;

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $render = new Render('home');
        $render->renderView();
        break;
    case 'project':
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && $_GET['for'] == 'get-project') {
            http_response_code(200);
            $json = Project::searchJSON($_GET['id']);
            echo json_encode($json);
            exit;
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['for'] == 'save') {
            $teste = json_decode(file_get_contents('php://input'), true);
            $project = new Project($teste['name'], $teste['description'],$teste['country'], $teste['state'], $teste['steps']);
            try {
                $result = $project->save();
                http_response_code(200);
                echo var_export($result, true);
                exit;
            } catch (ProjectException $e) {
                http_response_code(400);
                echo $e->getJSON();
                exit;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['for'] == 'get-projects') {
            http_response_code(200);
            echo json_encode(file_get_contents(DATA_BASE));
            exit;
        } else {
            $render = new Render('project');
            $render->renderView();
        }
        break;
}