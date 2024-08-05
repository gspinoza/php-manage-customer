<?php
require_once 'AbstractModel.php';

class Customer extends AbstractModel {

    public function create($firstName, $lastName, $phone, $email, $street, $city, $state, $zipcode) {
        $sql = "INSERT INTO Customer (firstName, lastName, phone, email, street, city, state, zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->executeQuery($sql, [$firstName, $lastName, $phone, $email, $street, $city, $state, $zipcode]);
    }

    public function getAllCustomers() {
        $sql = "SELECT cid, firstName, lastName, phone, email, street, city, state, zipcode FROM Customer";
        return $this->executeQuery($sql, [], true);
    }

    public function read($cid) {
        $sql = "SELECT cid, firstName, lastName, phone, email, street, city, state, zipcode FROM Customer WHERE cid = ?";
        $result = $this->executeQuery($sql, [$cid], true);
        return $result ? $result[0] : false;
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
        return $this->executeQuery($sql, [$firstName, $lastName, $phone, $email, $street, $city, $state, $zipcode, $cid]);
    }

    public function delete($cid) {
        $sql = "DELETE FROM Customer WHERE cid = ?";
        return $this->executeQuery($sql, [$cid]);
    }
}
?>
