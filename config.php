<?php
// config.php - Database and SMTP settings

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'traders_swift');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');

define('SMTP_HOST', getenv('SMTP_HOST') ?: '');
define('SMTP_PORT', getenv('SMTP_PORT') ?: '587');
define('SMTP_USER', getenv('SMTP_USER') ?: '');
define('SMTP_PASS', getenv('SMTP_PASS') ?: '');
define('SMTP_FROM', getenv('SMTP_FROM') ?: 'noreply@traders-swift.ch');
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: 'Traders-Swift');

/**
 * Connect to the database
 */
function getDbConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}

/**
 * Send a confirmation email
 * Note: This is a placeholder for SMTP logic. 
 * On a real server, use PHPMailer for reliable SMTP delivery.
 */
function sendConfirmationEmail($to, $firstname) {
    $subject = "Willkommen bei Traders-Swift Premium";
    $message = "Hallo $firstname,\n\nvielen Dank für Ihre Registrierung bei Traders-Swift Premium.\n\n" .
               "Ihr Zugang wird nach erfolgreicher Zahlung freigeschaltet.\n\n" .
               "Beste Grüße,\nIhr Traders-Swift Team";
    
    $headers = "From: " . SMTP_FROM_NAME . " <" . SMTP_FROM . ">\r\n" .
               "Reply-To: " . SMTP_FROM . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // In a real environment with SMTP configured in php.ini, this works.
    // Otherwise, use a library like PHPMailer.
    return mail($to, $subject, $message, $headers);
}
?>
