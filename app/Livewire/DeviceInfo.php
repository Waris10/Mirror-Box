<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Process\Pool;
use Illuminate\Support\Facades\Process;


class DeviceInfo extends Component
{
    public string $model;
    public string $manufacturer;
    public string $androidVersion;
    public string $build_number;
    public string $cpu_abi;
    public string $screen_size;
    public string $battery;

    #[On('device-selected')]
    public function getDeviceInfo($serial_number)
    {
        $path = base_path('scrcpy/adb');

        [$model, $manufacturer, $androidVersion, $buildNumber, $cpuAbi, $battery, $screenSize] = Process::concurrently(function (Pool $pool) use ($path, $serial_number) {
            $pool->command($this->getProp() . ' ro.product.model');
            $pool->command($this->getProp() . ' ro.product.manufacturer');
            $pool->command($this->getProp() . ' ro.build.version.release');
            $pool->command($this->getProp() . ' ro.build.display.id');
            $pool->command($this->getProp() . ' ro.product.cpu.abi');
            $pool->command($path . ' -s ' . $serial_number . ' shell ' . 'dumpsys' . ' battery');
            $pool->command($path . ' -s ' . $serial_number . ' shell ' . 'wm' . ' size');
        });

        $this->model = trim($model->output());
        $this->manufacturer = trim($manufacturer->output());
        $this->androidVersion = trim($androidVersion->output());
        $this->build_number = trim($buildNumber->output());
        $this->cpu_abi = trim($cpuAbi->output());

        //Battery level
        $this->battery = preg_match('/level: (\d+)/', $battery->output(), $matches) ? $matches[1] . '%' : 'Unknown';

        //Screen size
        $this->screen_size = preg_match('/Physical size: (\d+x\d+)/', $screenSize->output(), $matches) ? $matches[1] :  'Unknown';
    }

    private function getProp(): string
    {
        $path = base_path('scrcpy/adb');

        return $path . ' -s ' . session('device_id') . ' shell ' . ' getprop';
    }

    #[On('device-disconnected')]
    public function clearDeviceInfo()
    {
        $this->reset([
            'model',
            'manufacturer',
            'androidVersion',
            'build_number',
            'cpu_abi',
            'battery',
            'screen_size'
        ]);
    }
}