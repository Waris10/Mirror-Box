<div class="flex h-screen overflow-hidden bg-gray-100">
    <aside class="w-50 bg-white shadow-md p-4 space-y-6">
        <h1 class="text-2xl font-bold text-blue-600">Mirror Box</h1>
        <nav class="space-y-2">
            <x-nav-item label="Connected Devices" />
            <x-nav-item label="Device Info" />
            <x-nav-item label="Mirror Control" />
            <x-nav-item label="APK Installer" />
            <x-nav-item label="Screenshot / Record" />
            <x-nav-item label="File Manager" />
            <x-nav-item label="Shell Access" />
            <x-nav-item label="Power Controls" />
        </nav>
    </aside>
    <main class="flex-1 overflow-y-auto p-6 space-y-6">
        <x-card heading="Connected Devices">
            <p class="text-sm text-green-600 mb-4">
                Active Device: {{ session('selected_device', 'None Selected') }}
            </p>
            <div class="flex flex-col space-y-4" wire:poll.500ms="getConnectedDevices">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($devices as $device )
                    <livewire:device-card :deviceId="$device['serial']" :model="$device['model']"
                        :product="$device['product']" :device="$device['device']" :key="$device['serial']" />
                    @endforeach
                </div>
                <div class="flex justify-end space-x-2">
                    @if ($devices)
                    <button wire:click="disconnectDevice"
                        class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-2 rounded-md shadow transition duration-200">
                        Disconnect
                    </button>
                    @endif
                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded-md shadow transition duration-200"
                        type="button" wire:click='addDeviceThroughWiFi'>
                        Add Device
                    </button>
                </div>
                @if (session('disStatus'))
                <p class="mt-2 text-sm text-red-400">{{ session('disStatus') }}</p>
                @endif
            </div>
        </x-card>

        <x-card heading="Device Info">
            <livewire:device-info />
        </x-card>




        {{-- Mirror Control --}}
        <x-card heading="Mirror Control">
            <livewire:scrcpy-control />
        </x-card>

        {{-- APK Installer --}}
        <x-card heading="APK Installer">
            <input type="file" class="form-input">
            <button class=" mt-2">Install APK</button>
        </x-card>

        {{-- Screenshot / Record --}}
        <x-card heading="Screenshot / Recording">
            <input type="text" placeholder="screenshot.png" class="form-input mb-2">
            <button class="">Take Screenshot</button>
            <input type="text" placeholder="record.mp4" class="form-input my-2">
            <button class="">Start Recording</button>
        </x-card>

        {{-- File Manager --}}
        <x-card heading="File Manager">
            <div class="grid grid-cols-3 gap-4">
                <input type="text" placeholder="/sdcard/file.txt" class="form-input col-span-2">
                <button class="">Pull</button>
                <input type="text" placeholder="Upload to /sdcard" class="form-input col-span-2">
                <button class="">Push</button>
                <input type="text" placeholder="File to delete" class="form-input col-span-2">
                <button class="btn-danger">Delete</button>
            </div>
        </x-card>

        {{-- Shell Access --}}
        <x-card heading="Shell Access">
            <input type="text" placeholder="adb shell command" class="form-input w-full mb-2">
            <button class="">Run Command</button>
            <pre class="bg-gray-100 p-2 rounded mt-2 text-sm text-gray-800">Command output will show here...</pre>
        </x-card>

        {{-- Power Controls --}}
        <x-card heading="Power Controls">
            <div class="flex gap-4">
                <button class="btn-danger">Reboot</button>
                <button class="btn-danger">Shutdown</button>
                <button class="btn-warning">Soft Reboot</button>
            </div>
        </x-card>
    </main>
</div>
