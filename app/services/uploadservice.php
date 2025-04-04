<?php
namespace App\Services;

class UploadService {
    public function uploadImage() {
        // Ensure the request contains a file
        if (!isset($_FILES['upload']) || $_FILES['upload']['error'] !== 0) {
            header('Content-Type: application/json');
            echo json_encode(['uploaded' => 0, 'error' => ['message' => 'No file uploaded or an error occurred']]);
            return;
        }

        // Set Upload Directory & URL Path
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/images-logos/uploads/';
        $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/images-logos/uploads/';

        // Ensure directory exists
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
            header('Content-Type: application/json');
            echo json_encode(['uploaded' => 0, 'error' => ['message' => 'Failed to create upload directory']]);
            return;
        }

        $fileName = time() . '_' . preg_replace("/[^a-zA-Z0-9\._-]/", "", basename($_FILES['upload']['name']));
        $uploadPath = $uploadDir . $fileName;

        // Attempt to move the uploaded file
        if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadPath)) {
            header('Content-Type: application/json');
            echo json_encode([
                'uploaded' => 1,
                'fileName' => $fileName,
                'url' => $baseUrl . $fileName
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['uploaded' => 0, 'error' => ['message' => 'File upload failed']]);
        }
    }
}
?>
