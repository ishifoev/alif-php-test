class Reservation {
    private $id;
    private $officeId;
    private $startTime;
    private $endTime;
    private $reservedByName;
    private $reservedByEmail;
    private $reservedByPhone;

    public function __construct($id, $officeId, $startTime, $endTime, $reservedByName, $reservedByEmail, $reservedByPhone) {
        $this->id = $id;
        $this->officeId = $officeId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->reservedByName = $reservedByName;
        $this->reservedByEmail = $reservedByEmail;
        $this->reservedByPhone = $reservedByPhone;
    }

    public function save() {
        $database = new Database();
        $database->reserveOffice($this->officeId, $this->startTime, $this->endTime, $this->reservedByName, $this->reservedByEmail, $this->reservedByPhone);
        $this->sendEmailNotification();
        $this->sendSMSNotification();
    }

    public function sendEmailNotification() {
        $notificationService = new NotificationService();
        $emailSubject = 'Кабинет успешно забронирован';
        $emailMessage = 'Ваш кабинет успешно забронирован. Детали бронирования: ...';
        $notificationService->sendEmailNotification($this->reservedByEmail, $emailSubject, $emailMessage);
    }

    public function sendSMSNotification() {
        $notificationService = new NotificationService();
        $smsMessage = 'Ваш кабинет успешно забронирован. Детали бронирования: ...';
        $notificationService->sendSMSNotification($this->reservedByPhone, $smsMessage);
    }
}
