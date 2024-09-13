<?php

namespace Core;

class ConfigDataSet
{
    private static $data = false;

    /**
     * @return PDO
     */
    public static function get(string $pathName): array|bool
    {
        if (!self::$data) {
            if (file_exists($pathName)) {
                self::$data = json_decode(
                    file_get_contents($pathName),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );
            }
        }

        return self::$data;
    }
}