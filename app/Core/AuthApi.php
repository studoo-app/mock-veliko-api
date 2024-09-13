<?php

namespace Core;

use Studoo\EduFramework\Core\Controller\Request;

class AuthApi
{
    private static array $token = [];

    public static function checkToken(Request $request): bool
    {
        if (count(self::$token) === 0) {
            if (ConfigDataSet::get(__DIR__ . '/../../var/configDataset.json') !== false) {
                $config = ConfigDataSet::get(__DIR__ . '/../../var/configDataset.json');
                foreach ($config["token"] as $idAuth => $tokenValue) {
                    self::$token[$idAuth] = $tokenValue;
                }
            }
        }

        if (array_key_exists('Authorization', $request->getHearder()) === true) {
            if (in_array($request->getHearder()['Authorization'], self::$token, true)) {
                return true;
            }
        }

        return false;
    }
}