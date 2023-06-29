<?php

namespace Acme\classes;

use Dotenv\Dotenv;
use PDO;

class User
{
    private $name;
    private $role;
    private $password;
    private $database;

    public function __construct($name, $role, $user_id)
    {
        $this->name = $name;
        $this->role = $role;
        $this->user_id = $user_id;
        $this->database = $this->connectToDatabase();
    }

    private function connectToDatabase()
    {
        $envPath = '../.env';

        // Load environment variables from .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Get database connection details from environment variables
        $connection = getenv("DB_CONNECTION");
        $host = getenv("DB_HOST");
        $port = getenv("DB_PORT");
        $dbname = getenv("DB_DATABASE");
        $username = getenv("DB_USERNAME");
        $password = getenv("DB_PASSWORD");

        // Create a PDO instance for database connection
        $dsn = "$connection:host=$host;port=$port;dbname=$dbname;charset=utf8";
        $database = new PDO($dsn, $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $database;
    }

    public function hashPassword()
    {
        // Hash the password using the default password hashing algorithm
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function saveToDatabase()
    {
        // Make a connection to the database using the $database property
        $conn = $this->database;

        // Prepare the SQL query with parameter bindings
        $stmt = $conn->prepare("INSERT INTO users (name, role, password) VALUES (:name, :role, :password)");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':password', $this->password);

        // Execute the query with the bound values
        $stmt->execute();
    }
}
