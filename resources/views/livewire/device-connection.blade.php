<div class="p-6 space-y-4">
    <h2 class="text-xl font-bold">Connect Your Android Device via WiFi</h2>

    <div class="space-y-2">
        <p>📶 Steps to connect via Wi-Fi:</p>
        <ul class="text-sm list-decimal list-inside space-y-1">
            <li>Ensure both devices are on the same Wi-Fi</li>
            <li>Go to Developer options</li>
            <li>Enable Wireless Debugging</li>
            <li>Find your phone’s IP on the Wireless Debugging page</li>
        </ul>

        <input type="text" wire:model="deviceIp" placeholder="Enter device IP e.g. 192.168.1.100"
            class="border p-2 rounded w-full">

        <button wire:click="connectWifi" class="bg-green-600 text-white px-4 py-2 rounded">
            Connect
        </button>

        @if (session('connection'))
        <p class="mt-2 text-sm text-green-400">{{ session('connection') }}</p>
        @endif
    </div>
    <div wire:loading>
        <x-loader />
    </div>
</div>
