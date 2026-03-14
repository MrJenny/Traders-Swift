<?php
// register_api.php
require_once 'config.php';

header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method: ' . $_SERVER['REQUEST_METHOD']]);
    exit;
}

// Get POST data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    // Fallback for standard form data
    $data = $_POST;
}

// Debug log input
error_log("Registration attempt: " . print_r($data, true));

$firstname = $data['firstname'] ?? '';
$lastname = $data['lastname'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    echo json_encode([
        'success' => false, 
        'message' => 'Alle Felder sind erforderlich',
        'debug' => [
            'received' => array_keys($data),
            'empty_fields' => array_filter(['firstname', 'lastname', 'email', 'password'], function($f) use ($data) { return empty($data[$f]); })
        ]
    ]);
    exit;
}

$db = getDbConnection();
if (!$db) {
    echo json_encode(['success' => false, 'message' => 'Datenbankverbindung fehlgeschlagen. Bitte prüfen Sie die config.php.']);
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
    $result = $stmt->execute([$firstname, $lastname, $email, $hashedPassword]);

    if (!$result) {
        throw new Exception("Fehler beim Speichern in der Datenbank");
    }

    // Send email
    $mailSent = sendConfirmationEmail($email, $firstname);
    
    error_log("Email sent status: " . ($mailSent ? 'success' : 'failed'));

    echo json_encode([
        'success' => true, 
        'message' => 'Registrierung erfolgreich',
        'mail_sent' => $mailSent
    ]);
} catch (Exception $e) {
    error_log("Registration Error: " . $e->getMessage());
    echo json_encode([
        'success' => false, 
        'message' => 'Ein technischer Fehler ist aufgetreten',
        'debug_error' => $e->getMessage()
    ]);
}
?>
