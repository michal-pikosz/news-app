<?php

use PHPUnit\Framework\TestCase;
use src\framework\Validation;

class ValidationTest extends TestCase
{
    private $validate;

    public function __construct()
    {
        $this->validate = new Validation();
    }

    public function testThatInputStringIsCorrectlyFromated()
    {
        self::assertEquals("alert(&quot;Hello! I am an alert box!!&quot;);", Validation::cleanInput('alert("Hello! I am an alert box!!");'));
    }
}