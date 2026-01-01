<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class DeviceConnection extends Component
{
    public string $status = '';
    public string $deviceIp = '';


    public function connectWifi()
    {
        if (!$this->deviceIp) {
            $this->status = 'Please enter your device IP address';
            return;
        }
        shell_exec("adb connect {$this->deviceIp}");

        $output = shell_exec('adb devices');
        if (Str::contains($output, "{$this->deviceIp}")) {
            session()->flash('connection', 'Wi-Fi connection successful ✅');
        } else {
            session()->flash('connection', 'Failed to connect to device over Wi-Fi ❌');
        }
        $this->dispatch('device-connected', message: 'Device connected!');
    }
}