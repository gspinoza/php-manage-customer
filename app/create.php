<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/CustomerFactory.php';
$customer = CustomerFactory::getCustomer();

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/model/SanitizerValidator.php';

$firstName = $lastName = $phone = $email = $street = $city = $state = $zipcode = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_firstName = trim($_POST["firstName"]);
    $input_lastName = trim($_POST["lastName"]);
    $input_phone = trim($_POST["phone"]);
    $input_email = trim($_POST["email"]);
    $input_street = trim($_POST["street"]);
    $input_city = trim($_POST["city"]);
    $input_state = trim($_POST["state"]);
    $input_zipcode = trim($_POST["zipcode"]);


    $data = [
        'firstname' => $input_firstName,
        'lastname'  => $input_lastName,
        'phone'     => $input_phone,
        'email'     => $input_email,
        'street'    => $input_street,
        'city'      => $input_city,
        'state'     => $input_state,
        'zipcode'   => $input_zipcode,
    ];


    try {
        $sanitizerValidator = new SanitizerValidator();
        $sanitizedData = $sanitizerValidator->sanitizeAndValidate($data);
        $firstName = $sanitizedData['firstname'];
        $lastName = $sanitizedData['lastname'];
        $phone = $sanitizedData['phone'];
        $email = $sanitizedData['email'];
        $street = $sanitizedData['street'];
        $city = $sanitizedData['city'];
        $state = $sanitizedData['state'];
        $zipcode = $sanitizedData['zipcode'];
        
        if ($customer->create($firstName, $lastName, $phone, $email, $street, $city, $state, $zipcode)) {
            header("location: index.php");
            exit();
        } else {
            echo "Could not create record";
        }

    } catch (Exception $e) {
        header('location:index.php?message=input not valid!');
        echo 'Error: ' . $e->getMessage();
    }

}
?>
