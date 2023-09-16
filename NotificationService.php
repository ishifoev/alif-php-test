<?php

class NotificationService {
    // Реализация отправки уведомлений по электронной почте и SMS.
    public function sendEmailNotification($email, $subject, $message) {
        // Здесь реализуется отправка уведомления по электронной почте.
        // Можно использовать стороннюю библиотеку или сервис для отправки электронных писем.
        // Пример использования PHPMailer:

        require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
        require 'vendor/phpmailer/phpmailer/src/SMTP.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your_email@example.com';
        $mail->Password = 'your_email_password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            echo 'Email sent successfully.';
        } else {
            echo 'Email could not be sent.';
        }
    }

    public function sendSMSNotification($phoneNumber, $message) {
        // Здесь реализуется отправка SMS-уведомления.
        // Можно использовать сторонний сервис для отправки SMS.
        // Пример использования Twilio:

        require 'vendor/twilio/sdk/Services/Twilio.php';

        $accountSid = 'your_account_sid';
        $authToken = 'your_auth_token';
        $client = new Services_Twilio($accountSid, $authToken);
        
        $sms = $client->account->messages->create(
            $phoneNumber,
            array(
                'from' => 'your_twilio_phone_number',
                'body' => $message
            )
        );

        echo 'SMS sent successfully.';
    }
}
