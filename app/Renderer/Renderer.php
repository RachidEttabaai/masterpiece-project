<?php

namespace App\Renderer;

class Renderer
{
    const NAMESPACE_BYDEFAULT = "__MAIN";

    private $paths = [];

    public function addPath(string $namespace,?string $path = null): void
    {
        if(is_null($path)){
            $this->paths[self::NAMESPACE_BYDEFAULT] = $namespace;
        }else{
            $this->paths[$namespace] = $path;
        }
    }

    public function render(string $view): string
    {
        $path = $this->paths[$view] . DIRECTORY_SEPARATOR . $view . ".php";

        ob_start();
        require($path);
        return ob_get_clean();
    }
}
