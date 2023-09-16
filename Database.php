<?php

class Database {
    // Предположим, у вас есть настройки соединения с базой данных, например, через PDO.
    private $dbHost = 'localhost';
    private $dbUser = 'your_db_user';
    private $dbPass = 'your_db_password';
    private $dbName = 'your_db_name';

    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function checkOfficeAvailability($officeId, $start_time, $end_time) {
        // Реализуем проверку доступности кабинета в базе данных.
        $sql = "SELECT COUNT(*) FROM reservations WHERE office_id = :office_id AND ((start_time <= :start_time AND end_time >= :start_time) OR (start_time <= :end_time AND end_time >= :end_time))";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':office_id', $officeId, PDO::PARAM_INT);
        $stmt->bindParam(':start_time', $start_time);
        $stmt->bindParam(':end_time', $end_time);
        $stmt->execute();
        $result = $stmt->fetchColumn();

        return $result === '0'; // Вернем true, если кабинет доступен, и false в противном случае.
    }

    public function reserveOffice($officeId, $start_time, $end_time, $reserved_by_name, $reserved_by_email, $reserved_by_phone) {
        // Реализуем сохранение информации о бронировании в базе данных.
        $sql = "INSERT INTO reservations (office_id, start_time, end_time, reserved_by_name, reserved_by_email, reserved_by_phone) VALUES (:office_id, :start_time, :end_time, :reserved_by_name, :reserved_by_email, :reserved_by_phone)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':office_id', $officeId, PDO::PARAM_INT);
        $stmt->bindParam(':start_time', $start_time);
        $stmt->bindParam(':end_time', $end_time);
        $stmt->bindParam(':reserved_by_name', $reserved_by_name);
        $stmt->bindParam(':reserved_by_email', $reserved_by_email);
        $stmt->bindParam(':reserved_by_phone', $reserved_by_phone);
        $stmt->execute();
    }
}
