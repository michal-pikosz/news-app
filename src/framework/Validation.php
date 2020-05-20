<?php


namespace src\framework;

/**
 * Class Validation
 * @package src\framework
 *
 * A simple class that checks the correctness of input data
 */

class Validation
{
    /**
     * Validation constructor.
     */
    public function __construct()
    {
        $_SESSION['error'] = [];
    }

    /**
     * Clears input from unwanted characters
     * @param $data
     * @return string
     */
    public static function cleanInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Checks whether the field meets the required field condition
     * @param $field
     * @param $value
     */
    public function isRequired($field, $value): void
    {
        if (empty($value) || trim($value) === ''){
            $_SESSION["error"] = "" . $field . " is required";
        }
    }

    /**
     * Checks if the field is an email
     * @param $field
     * @param $value
     */
    public function isEmail($field, $value): void
    {
        if (!filter_var( $value, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["error"] = "" . $field . " must be valid email";
        }
    }
}