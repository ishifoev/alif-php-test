CREATE TABLE offices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    is_available BOOLEAN DEFAULT 1
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    office_id INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    reserved_by_name VARCHAR(255) NOT NULL,
    reserved_by_email VARCHAR(255) NOT NULL,
    reserved_by_phone VARCHAR(15) NOT NULL,
    FOREIGN KEY (office_id) REFERENCES offices(id)
);
