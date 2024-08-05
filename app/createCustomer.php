<?php
class CreateCustomer {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($firstName, $lastName, $phone, $email, $street, $city, $state, $zipcode) {
        $sql = "INSERT INTO Customer (firstName, lastName, phone, email, street, city, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bindParam(1, $firstName);
            $stmt->bindParam(2, $lastName);
            $stmt->bindParam(3, $phone);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $street);
            $stmt->bindParam(6, $city);
            $stmt->bindParam(7, $state);
            $stmt->bindParam(8, $zipcode);

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
                return false;
            }
        }

        return false;
    }
}
?>
