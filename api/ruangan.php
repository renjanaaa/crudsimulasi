<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once "../classes/ruangan.php";

$method = $_SERVER['REQUEST_METHOD'];
$ruangan = new Ruangan();

try {
    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $ruangan->getById($id);
            if ($result) {
                echo json_encode(['success' => true, 'data' => $result]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Ruangan not found']);
            }
        } else {
            $results = $ruangan->read();
            echo json_encode(['success' => true, 'data' => $results]);
        }
    } 
    elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['nama_ruangan']) || !isset($input['kapasitas']) || !isset($input['lokasi'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }
        $result = $ruangan->create($input['nama_ruangan'], intval($input['kapasitas']), $input['lokasi']);
        if ($result) {
            http_response_code(201);
            echo json_encode(['success' => true, 'message' => 'Ruangan created successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to create ruangan']);
        }
    } 
    elseif ($method === 'PUT') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['id_ruangan']) || !isset($input['nama_ruangan']) || !isset($input['kapasitas']) || !isset($input['lokasi'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }
        $result = $ruangan->update(intval($input['id_ruangan']), $input['nama_ruangan'], intval($input['kapasitas']), $input['lokasi']);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Ruangan updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update ruangan']);
        }
    } 
    elseif ($method === 'DELETE') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['id_ruangan'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing id_ruangan']);
            exit;
        }
        $result = $ruangan->delete(intval($input['id_ruangan']));
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Ruangan deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to delete ruangan']);
        }
    } 
    else {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
