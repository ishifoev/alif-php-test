<?php
// Параметры подключения к базе данных
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'php-test';

// Создание подключения к базе данных
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Функция для получения доступных кабинетов
function getAvailableOffices() {
    global $conn;
    $sql = "SELECT * FROM offices WHERE is_available = 1";
    $result = $conn->query($sql);
    $offices = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $offices[] = $row;
        }
    }

    return $offices;
}
?>
