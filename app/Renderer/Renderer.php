<?php

namespace App\Renderer;

class Renderer implements RendererInterface
{
    const NAMESPACE_BYDEFAULT = "__MAIN";

    private $paths = [];

    public function __construct(?string $defaultPath = null)
    {
       if(!is_null($defaultPath)){
            $this->addPath($defaultPath);
       }
       
    }

    public function addPath(string $namespace,?string $path = null): void
    {
        if(is_null($path)){
            $this->paths[self::NAMESPACE_BYDEFAULT] = $namespace;
        }else{
            $this->paths[$namespace] = $path;
        }
    }

    public function render(string $view,array $params = []): string
    {
        $path = $this->paths[$view] . DIRECTORY_SEPARATOR . $view . ".php";

        ob_start();
        require($path);
        return ob_get_clean();
    }
}
