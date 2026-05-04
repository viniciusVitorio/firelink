<?php

use Firelink\View\Compilers\EmberCompiler;

function ember(string $view, array $data = []): void
{
    $viewPath = BASE_PATH . "/resources/views/{$view}.ember.php";
    $compiledPath = BASE_PATH . "/storage/framework/views/" . md5($viewPath) . ".php";

    if (! file_exists($compiledPath) || filemtime($viewPath) > filemtime($compiledPath)) {
        $compiler = new EmberCompiler();

        $content = file_get_contents($viewPath);
        $compiled = $compiler->compile($content);

        file_put_contents($compiledPath, $compiled);
    }

    extract($data);

    require $compiledPath;
}

function emberLayout(string $layout, callable $content): void
{
    global $__sections;

    $__sections = [];

    $content();

    $viewPath = BASE_PATH . "/resources/views/{$layout}.ember.php";
    $compiledPath = BASE_PATH . "/storage/framework/views/" . md5($viewPath) . ".php";

    if (! file_exists($compiledPath) || filemtime($viewPath) > filemtime($compiledPath)) {
        $compiler = new EmberCompiler();

        $raw = file_get_contents($viewPath);
        $compiled = $compiler->compile($raw);

        file_put_contents($compiledPath, $compiled);
    }

    require $compiledPath;
}