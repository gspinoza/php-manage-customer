<?php
class UpdateCustomer {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function update($cid, $firstName, $lastName, $phone, $email, $street, $city, $state, $zipcode) {
        $sql = "UPDATE Customer 
                SET firstName = ?, 
                    lastName = ?, 
                    phone = ?, 
                    email = ?, 
                    street = ?, 
                    city = ?, 
                    state = ?, 
                    zipcode = ? 
                WHERE cid = ?";
        
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bindParam(1, $firstName);
            $stmt->bindParam(2, $lastName);
            $stmt->bindParam(3, $phone);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $street);
            $stmt->bindParam(6, $city);
            $stmt->bindParam(7, $state);
            $stmt->bindParam(8, $zipcode);
            $stmt->bindParam(9, $cid, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                print_r($stmt->errorInfo());
                return false;
            }
        }

        return false;
    }
}
?>
