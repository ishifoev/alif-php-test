<?php

class Office {
    private $id;
    private $name;
    private $isAvailable;

    public function __construct($id, $name, $isAvailable) {
        $this->id = $id;
        $this->name = $name;
        $this->isAvailable = $isAvailable;
    }

    public function isAvailable($start_time, $end_time) {
        $database = new Database();
        return $database->checkOfficeAvailability($this->id, $start_time, $end_time);
    }

    public function reserve($start_time, $end_time, $reserved_by_name, $reserved_by_email, $reserved_by_phone) {
        $reservation = new Reservation(null, $this->id, $start_time, $end_time, $reserved_by_name, $reserved_by_email, $reserved_by_phone);
        $reservation->save();
    }
}
