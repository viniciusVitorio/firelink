<?php

namespace Firelink\View\Compilers;

class EmberCompiler
{
    public function compile(string $content): string
    {
        $content = $this->compileSection($content);
        $content = $this->compileYield($content);
        $content = $this->compileEcho($content);
        $content = $this->compileIf($content);
        $content = $this->compileForeach($content);
        $content = $this->compileExtends($content);

        return $content;
    }
    private function compileEcho(string $content): string
    {
        return preg_replace_callback(
            '/{{\s*(.+?)\s*}}/',
            function ($matches) {
                $expression = trim($matches[1]);

                if (! str_starts_with($expression, '$')) {
                    $expression = '$' . $expression;
                }

                return '<?= htmlspecialchars(' . $expression . ', ENT_QUOTES, "UTF-8") ?>';
            },
            $content
        );
    }

    private function compileIf(string $content)
    {
        $content = preg_replace(
            '/@if\s*\((.*?)\)/',
            '<?php if ($1): ?>',
            $content
        );

        $content = str_replace('@else', '<?php else: ?>', $content);
        $content = str_replace('@endif', '<?php endif; ?>', $content);

        return $content;
    }

    private function compileForeach(string $content): string
    {
        $content = preg_replace(
            '/@foreach\s*\((.*?)\)/',
            '<?php foreach ($1): ?>',
            $content
        );

        $content = str_replace('@endforeach', '<?php endforeach; ?>', $content);

        return $content;
    }

    private function compileExtends(string $content): string
    {
        if (preg_match('/@extends\([\'"](.*?)[\'"]\)/', $content, $matches)) {
            $layout = $matches[1];

            $content = preg_replace('/@extends\([\'"](.*?)[\'"]\)/', '', $content);

            return "<?php echo emberLayout('{$layout}', function() use (\$name) { ?>{$content}<?php }); ?>";
        }

        return $content;
    }

    private function compileSection(string $content): string
    {
        $content = preg_replace(
            '/@section\([\'"](.*?)[\'"]\)/',
            '<?php global $__sections; $__sectionName = "$1"; ob_start(); ?>',
            $content
        );

        $content = str_replace(
            '@endsection',
            '<?php $__sections[$__sectionName] = ob_get_clean(); ?>',
            $content
        );

        return $content;
    }

    private function compileYield(string $content): string
    {
        return preg_replace(
            '/@yield\([\'"](.*?)[\'"]\)/',
            '<?php global $__sections; echo $__sections["$1"] ?? ""; ?>',
            $content
        );
    }
}