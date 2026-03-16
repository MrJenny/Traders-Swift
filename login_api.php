<?php
// login_api.php
require_once 'config.php';

session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    $data = $_POST;
}

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'E-Mail und Passwort sind erforderlich']);
    exit;
}

$db = getDbConnection();
if (!$db) {
    echo json_encode(['success' => false, 'message' => 'Datenbankverbindung fehlgeschlagen']);
    exit;
}

try {
    $stmt = $db->prepare("SELECT id, firstname, lastname, password, is_premium FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['is_premium'] = $user['is_premium'];

        echo json_encode([
            'success' => true,
            'message' => 'Login erfolgreich',
            'user' => [
                'firstname' => $user['firstname'],
                'is_premium' => $user['is_premium']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Ungültige E-Mail oder Passwort']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Ein Fehler ist aufgetreten: ' . $e->getMessage()]);
}
?>
