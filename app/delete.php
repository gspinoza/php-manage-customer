<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/customerFactory.php';
$customer = customerFactory::getCustomer();

$cid = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cid = trim($_POST["cid"]);

    if (!empty($cid)) {
        if ($customer->delete($cid)) {
            header("location: index.php");
            exit();
        } else {
            echo "Something went wrong. could not load page.";
        }
    } else {
        echo "Please provide a valid customer ID.";
    }
}
?>
