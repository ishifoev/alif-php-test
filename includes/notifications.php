<?php
// Функция для отправки уведомления по электронной почте
function sendEmailNotification($to, $subject, $message) {
    // Используйте библиотеку для отправки электронных писем, например, PHPMailer
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.example.com'; // Укажите SMTP-сервер и настройте параметры
    $mail->SMTPAuth = true;
    $mail->Username = 'your_username';
    $mail->Password = 'your_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('from@example.com', 'Your Name');
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

// Функция для отправки SMS-уведомления
function sendSMSNotification($phoneNumber, $message) {
    // Используйте библиотеку или сервис для отправки SMS
    // Например, Twilio, Nexmo или другие
}
?>
