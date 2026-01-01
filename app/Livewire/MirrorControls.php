<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GlobalDevice;
use Livewire\Attributes\Title;
use Native\Laravel\Facades\Window;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class MirrorControls extends Component
{
    #[Title('Mirror Controls')]

    public array $devices = [];



    public function mount()
    {
        $this->getConnectedDevices();
    }

    public function getConnectedDevices()
    {
        $process = Process::run($this->getAdbPath() . ' devices ' . '-l');
        if (!$process->successful()) {
            Log::error('ADB command failed: ' . $process->errorOutput());
            $this->devices = [];
            return;
        }
        $output = str_replace("\r\n", "\n", $process->output()); // Normalize
        $lines = explode("\n", trim($output));
        $parsedDevices = [];

        foreach ($lines as $line) {
            if (str_contains($line, 'device') && !str_starts_with($line, 'List')) {
                preg_match('/^(\S+)\s+device(?:\s+product:(\S+))?(?:\s+model:(\S+))?(?:\s+device:(\S+))?/', $line, $matches);

                $parsedDevices[] = [
                    'serial'  => $matches[1] ?? '',
                    'product' => $matches[2] ?? '',
                    'model'   => $matches[3] ?? '',
                    'device'  => $matches[4] ?? '',
                ];
            }
        }
        $this->devices = $parsedDevices;
    }

    public function disconnectDevice()
    {
        $process = Process::run($this->getAdbPath() . ' disconnect');
        if (!$process->successful()) {
            Log::error('ADB command failed: ' . $process->errorOutput());
            return;
        }
        $output = str_replace("\r\n", "\n", $process->output()); // Normalize
        GlobalDevice::clear();

        $this->dispatch('device-disconnected');
        return session()->flash('disStatus', $output);
    }


    public function hasActiveDevice()
    {
        return GlobalDevice::getSelectedDevice() !== null;
    }

    public function addDeviceThroughWiFi()
    {
        Window::open('addWifi')
            ->width(500)
            ->height(500)
            ->title('Add Device through WiFi')
            ->route('addDeviceThroughWiFi')
            ->showDevTools(false)
            ->hideMenu();
    }


    private function getAdbPath()
    {
        return base_path('scrcpy/adb');
    }
}
