<?php
function validateForm($data) {
    $errors = [];

    // Name validation
    if (empty($data['name']) || strlen($data['name']) < 3) {
        $errors['name'] = "Name must be at least 3 characters long";
    } elseif (!preg_match("/^[A-Za-z ]+$/", $data['name'])) {
        $errors['name'] = "Name must contain only letters and spaces";
    }

    // Email validation
    if (empty($data['email'])) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Mobile validation
    if (empty($data['mobile']) || strlen($data['mobile']) != 10) {
        $errors['mobile'] = "Contact number must be 10 digits long";
    } elseif (!preg_match("/^[0-9]+$/", $data['mobile'])) {
        $errors['mobile'] = "Contact number must contain only numbers";
    }

    // Password validation
    if (empty($data['password']) || strlen($data['password']) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/", $data['password'])) {
        $errors['password'] = "Password must contain at least one lowercase, one uppercase, one number, and one special character";
    }

    return $errors;
}
?>
