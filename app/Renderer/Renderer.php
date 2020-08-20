<?php

namespace App\Renderer;

class Renderer
{

    public function render(string $view): string
    {
        $path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $view . ".php";
        ob_start();
        require($path);
        return ob_get_clean();
    }
}
