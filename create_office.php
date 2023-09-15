<?php
require_once('includes/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $officeName = $_POST['office_name'];

    // Проверка наличия имени кабинета
    if (empty($officeName)) {
        echo "Пожалуйста, введите название кабинета.";
    } else {
        // Добавляем офис в базу данных
        if (createOffice($officeName)) {
            echo "Кабинет успешно добавлен.";
        } else {
            echo "Произошла ошибка при добавлении кабинет.";
        }
    }
}

function createOffice($name) {
    global $conn;
    $sql = "INSERT INTO offices (name) VALUES ('$name')";
    return $conn->query($sql);
}
?>
