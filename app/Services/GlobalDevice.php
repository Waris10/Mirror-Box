<?php

namespace App\Services;

class GlobalDevice
{

    const SESSION_KEY = 'selected_device';
    const DEVICE_ID_KEY = 'device_id';

    public static function set(string $device, string $deviceId)
    {
        session()->put([
            self::SESSION_KEY => $device,
            self::DEVICE_ID_KEY => $deviceId,
        ]);
    }

    public static function getSelectedDevice()
    {
        return session()->get(self::SESSION_KEY);
    }

    public static function getDeviceId()
    {
        return session()->get(self::DEVICE_ID_KEY);
    }

    public static function clear()
    {
        session()->forget([
            self::SESSION_KEY,
            self::DEVICE_ID_KEY,
        ]);
    }
}
