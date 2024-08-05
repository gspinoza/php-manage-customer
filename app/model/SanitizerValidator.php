<?php

class SanitizerValidator {
    
    // sanitize input
    public function sanitize($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    public function validateName($name) {
        return preg_match("/^[a-zA-Z\s'-]+$/", $name);
    }

    public function validatePhone($phone) {
        return preg_match("/^\+?[0-9]{1,4}?[0-9]{7,15}$/", $phone);
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function validateStreet($street) {
        // street names can contain letters, numbers, spaces, and common punctuation
        return preg_match("/^[a-zA-Z0-9\s,.'-]+$/", $street);
    }

    public function validateCity($city) {
        return preg_match("/^[a-zA-Z\s'-]+$/", $city);
    }

    public function validateState($state) {
        return preg_match("/^[A-Z]{2}$/", $state);
    }

    public function validateZipcode($zipcode) {
        return preg_match("/^\d{5}(-\d{4})?$/", $zipcode);
    }

    // General method to validate input fields
    public function validate($field, $value) {
        switch ($field) {
            case 'firstname':
            case 'lastname':
                return $this->validateName($value);
            case 'phone':
                return $this->validatePhone($value);
            case 'email':
                return $this->validateEmail($value);
            case 'street':
                return $this->validateStreet($value);
            case 'city':
                return $this->validateCity($value);
            case 'state':
                return $this->validateState($value);
            case 'zipcode':
                return $this->validateZipcode($value);
            default:
                return false;
        }
    }

    // sanitize and validate all fields
    public function sanitizeAndValidate($data) {
        $sanitizedData = [];
        foreach ($data as $field => $value) {
            $sanitizedValue = $this->sanitize($value);
            if ($this->validate($field, $sanitizedValue)) {
                $sanitizedData[$field] = $sanitizedValue;
            } else {
                throw new Exception("Invalid value for $field");
            }
        }
        return $sanitizedData;
    }
}

?>
