<?php


namespace src\framework;


class Session
{
    /**
     * Resets form errors
     * @return mixed
     */
    public static function resetErrors()
    {
        $error = $_SESSION['error'];
        $_SESSION['error'] = [];
        return $error;
    }
}