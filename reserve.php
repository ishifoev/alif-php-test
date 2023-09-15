<?php
require_once('includes/database.php');
require_once('includes/notifications.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $office_id = $_POST['office_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $reserved_by_name = $_POST['reserved_by_name'];
    $reserved_by_email = $_POST['reserved_by_email'];
    $reserved_by_phone = $_POST['reserved_by_phone'];

    // Check if the office with the specified ID exists
    $office = getOfficeById($office_id);

    if ($office && $office['is_available']) {
        // The office exists and is available, proceed with reservation
        reserveOffice($office_id, $start_time, $end_time, $reserved_by_name, $reserved_by_email, $reserved_by_phone);

        // Send email and SMS notifications

        echo "Кабинет успешно забронирован!";
    } else {
        // Office doesn't exist or is not available
        echo "Кабинет занят или не существует.";
    }
}

?>
