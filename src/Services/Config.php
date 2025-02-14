<?php

namespace App\Services;

class Config
{
    private static array $config = [];

    public static function loadEnv(string $filePath): void {
        if (!file_exists($filePath)) {
            throw new \Exception("Configuration file not found: $filePath");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // Ignore les commentaires
            }

            [$key, $value] = explode('=', $line, 2);
            self::$config[trim($key)] = trim($value);
        }
    }

    public static function get(string $key, $default = null) {
        return self::$config[$key] ?? $default;
    }
}
