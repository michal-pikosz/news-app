<?php


namespace src\framework;


use Throwable;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewController
{
    protected Environment $twig;

    /**
     * HomeController constructor.
     * @param String $path
     */
    public function __construct($path)
    {
        $twigLoader = new FilesystemLoader($path);
        $this->twig = new Environment($twigLoader);
    }

    /**
     * Returns page 405 and writes the error to a file
     * @param string $e
     */
    public function error500($e): void
    {
        header("HTTP/1.0 405 Method Not Allowed");
        Log::error("TWIG DIED", ["message" => $e]);
    }

    /**
     * Returns the twig view with the parameters given
     * @param $view
     * @param $params
     * @return string
     */
    public function returnView($view, $params): string
    {
        try {
            return $this->twig->render($view, $params);
        } catch (Throwable $e) {
            $this->error500($e->getMessage());
        }
        exit();
    }

    /**
     * Redirects the user to the selected page
     * @param string $path
     */
    public function redirectPage(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }

    /**
     * Redirects the user to page 404
     */
    public function redirect404(): void
    {
        header("HTTP/1.0 404 Not Found");
        exit();
    }
}