<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\GlobalDevice;
use Illuminate\Support\Facades\Process;

class ScrcpyControl extends Component
{

    public bool $hasDevice = false;
    public $selectedResolution = '';
    public $selectedBitrate = '';


    protected $deviceId = '';

    public function startScrcpy()
    {
        if (!$this->hasDevice) return;

        $cmd = [
            $this->getAdbPath(),
            '--serial',
            GlobalDevice::getDeviceId()
        ];

        if ($this->selectedResolution) {
            $cmd[] = '--max-size';
            $cmd[] = $this->selectedResolution;
        }

        if ($this->selectedBitrate) {
            $cmd[] = '--video-bit-rate';
            $cmd[] = $this->selectedBitrate;
        }

        try {
            Process::start($cmd);
            session()->flash('success', 'scrcpy started successfully');
        } catch (\Throwable $e) {
            session()->flash('error', 'Failed to start scrcpy: ' . $e->getMessage());
        }
    }



    public function stopScrcpy()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            shell_exec('TASKKILL /F /IM scrcpy.exe');
        } else {
            shell_exec('pkill scrcpy');
        }
    }


    #[On('device-selected')]
    public function checkIfDeviceIsConnected()
    {
        $this->hasDevice = session()->has('selected_device');
    }

    #[On('device-disconnected')]
    public function checkIfDeviceIsDisconnected()
    {
        $this->hasDevice = session()->has('selected_device');
    }
    private function getAdbPath()
    {
        return base_path('scrcpy/scrcpy');
    }
    public function render()
    {
        return view('livewire.scrcpy-control');
    }
}
