<?php
// register_api.php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    // Fallback for standard form data
    $data = $_POST;
}

$firstname = $data['firstname'] ?? '';
$lastname = $data['lastname'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Alle Felder sind erforderlich']);
    exit;
}

$db = getDbConnection();
if (!$db) {
    echo json_encode(['success' => false, 'message' => 'Datenbankverbindung fehlgeschlagen']);
    exit;
}

try {
    // Check if user already exists
    $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Diese E-Mail Adresse ist bereits registriert']);
        exit;
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $db->prepare("INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$firstname, $lastname, $email, $hashedPassword]);

    // Send email
    sendConfirmationEmail($email, $firstname);

    // Start session
    session_start();
    $_SESSION['user_id'] = $db->lastInsertId();
    $_SESSION['firstname'] = $firstname;
    $_SESSION['is_premium'] = false;

    echo json_encode(['success' => true, 'message' => 'Registrierung erfolgreich']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Ein Fehler ist aufgetreten: ' . $e->getMessage()]);
}
?>
