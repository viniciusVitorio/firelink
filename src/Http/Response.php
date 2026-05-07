<?php

namespace Firelink\Http;

class Response
{
    public function make(string $content = '', int $status = 200): void
    {
        http_response_code($status);

        echo $content;
    }

    public function json(array $data, int $status = 200): string
    {
        http_response_code($status);

        header('Content-Type: application/json');

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function redirect(string $url): void
    {
        header("Location: {$url}");

        exit;
    }
}