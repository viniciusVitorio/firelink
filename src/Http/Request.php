<?php

namespace Firelink\Http;

class Request
{
    protected $method;

    public function getMethod(): string
    {
        if ($this->method !== null) {
            return $this->method;
        }

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = $_POST['_method'];
        }
    
        return $this->method = strtoupper($method);
    }

    public function input(?string $key = null, $default = null)
    {

        $data = array_merge($_GET, $_POST, $this->json());

        if ($key === null) {
            return $data;
        }

        return $data[$key] ?? $default;
    }

    public function query(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_GET;
        }

        return $_GET[$key] ?? $default;
    }

    public function post(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_POST;
        }

        return $_POST[$key] ?? $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->input());
    }

    public function filled(string $key): bool
    {
        $value = $this->input($key);

        return $value !== null && $value !== '';
    }

    public function all(): array
    {
        return $this->input();
    }

    public function method(): string
    {
        return $this->getMethod();
    }

    public function json($key = null, $default = null)
    {
        if ($this->json === null) {
            $content = file_get_contents('php://input');

            $this->json = json_decode($content, true) ?? [];
        }

        if ($key === null) {
            return $this->json;
        }

        return $this->json[$key] ?? $default;
    }
}