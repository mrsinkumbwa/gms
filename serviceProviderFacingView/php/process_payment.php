// File: db_config.php
// Description: Database configuration

$host = 'localhost';
$dbname = 'gms';
$username = 'mbanga';
$password = 'bite@00427';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
