<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once "../classes/lab.php";

$method = $_SERVER['REQUEST_METHOD'];
$lab = new Lab();

try {
    if ($method === 'GET') {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = $lab->getById($id);
            if ($result) {
                echo json_encode(['success' => true, 'data' => $result]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Lab not found']);
            }
        } else {
            $results = $lab->read();
            echo json_encode(['success' => true, 'data' => $results]);
        }
    } 
    elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['nama_lab']) || !isset($input['kapasitas']) || !isset($input['lokasi'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }
        $result = $lab->create($input['nama_lab'], intval($input['kapasitas']), $input['lokasi']);
        if ($result) {
            http_response_code(201);
            echo json_encode(['success' => true, 'message' => 'Lab created successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to create lab']);
        }
    } 
    elseif ($method === 'PUT') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['id_lab']) || !isset($input['nama_lab']) || !isset($input['kapasitas']) || !isset($input['lokasi'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing required fields']);
            exit;
        }
        $result = $lab->update(intval($input['id_lab']), $input['nama_lab'], intval($input['kapasitas']), $input['lokasi']);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Lab updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to update lab']);
        }
    } 
    elseif ($method === 'DELETE') {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['id_lab'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Missing id_lab']);
            exit;
        }
        $result = $lab->delete(intval($input['id_lab']));
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Lab deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Failed to delete lab']);
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
