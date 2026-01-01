<?php

namespace App\Livewire;

use App\Services\GlobalDevice;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class DeviceCard extends Component
{
    public string $deviceId;
    public string $model;
    public string $product;
    public string $device;


    public function selectDevice()
    {
        GlobalDevice::set($this->device, $this->deviceId);

        $this->dispatch(
            'device-selected',
            serial_number: session('device_id'),
        );
    }

    public function render()
    {
        return view('livewire.device-card');
    }
}
