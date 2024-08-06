<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/Customer.php';

class CustomerFactory {
    private static $customer = null;

    public static function getCustomer() {
        if (self::$customer === null) {
            $database = new Database();
            $db = $database->getConnection();
            self::$customer = new Customer($db);
        }
        return self::$customer;
    }
}
?>
