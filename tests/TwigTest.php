<?php

use PHPUnit\Framework\TestCase;
use src\framework\ViewController;

class TwigTest extends TestCase
{
    /**
     * Test if you can create a view based on an HTML
     * file if it doesn't work twig will throw an exception otherwise it will return HTML.
     */
    public function testThatTwigWorks(): void
    {
        $viewController = new ViewController(__DIR__ . "/../templates/front/");
        $this->assertIsString($viewController->returnView('index.html', []));
    }
}