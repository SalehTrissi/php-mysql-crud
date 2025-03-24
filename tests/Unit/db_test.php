<?php
/**
 * Minimal Database Connection Test (CLI Version)
 */

// Find the project root directory
$projectRoot = dirname(dirname(dirname(__FILE__)));

// Load Composer autoloader
require_once $projectRoot . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable($projectRoot);
$dotenv->load();

try {
    // Attempt database connection
    $conn = new mysqli(
        $_ENV['DB_HOST'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'] ?? '',
        $_ENV['DB_NAME'],
        $_ENV['DB_PORT'] ?? 3306
    );
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception($conn->connect_error);
    }
    
    // Connection successful
    echo "✅ Connection Successful\n";
    echo "Connected to: {$_ENV['DB_HOST']} (MySQL version: {$conn->server_info})\n";
    
    // Close connection
    $conn->close();
    
} catch (Exception $e) {
    // Connection failed
    echo "❌ Connection Failed\n";
    echo "Error: " . $e->getMessage() . "\n";
}
?>