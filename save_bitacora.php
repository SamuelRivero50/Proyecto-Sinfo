<?php
require_once 'config/database.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data
        $estado = $_POST['estado'] ?? '';
        $temperatura = $_POST['temperatura'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $valor = $_POST['valor'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $oportunidad = $_POST['oportunidad'] ?? '';
        $tarea = $_POST['tarea'] ?? '';
        $agregarTarea = isset($_POST['agregarTarea']) ? 1 : 0;
        $proximaAccion = $_POST['proximaAccion'] ?? null;
        $hora = $_POST['hora'] ?? null;
        $contacto = $_POST['contacto'] ?? '';

        // Handle file upload if exists
        $adjunto = '';
        if (isset($_FILES['adjuntoFile']) && $_FILES['adjuntoFile']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = time() . '_' . basename($_FILES['adjuntoFile']['name']);
            $uploadFile = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['adjuntoFile']['tmp_name'], $uploadFile)) {
                $adjunto = $fileName;
            }
        }

        // Prepare SQL statement
        $sql = "INSERT INTO bitacora (
            estado, temperatura, nombre, valor, descripcion, 
            adjunto, oportunidad, tarea, agregar_tarea, 
            proxima_accion, hora, contacto, fecha_creacion, fecha_actualizacion
        ) VALUES (
            :estado, :temperatura, :nombre, :valor, :descripcion,
            :adjunto, :oportunidad, :tarea, :agregar_tarea,
            :proxima_accion, :hora, :contacto, NOW(), NOW()
        )";

        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':temperatura', $temperatura);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':adjunto', $adjunto);
        $stmt->bindParam(':oportunidad', $oportunidad);
        $stmt->bindParam(':tarea', $tarea);
        $stmt->bindParam(':agregar_tarea', $agregarTarea);
        $stmt->bindParam(':proxima_accion', $proximaAccion);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':contacto', $contacto);

        // Execute the statement
        $stmt->execute();

        echo json_encode(['success' => true, 'message' => 'Bitácora guardada exitosamente']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error al guardar: ' . $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?> 