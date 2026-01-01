<div class="p-2 border rounded bg-gray-50">
    <h3 class="text-lg font-bold text-gray-800">{{ $model }}</h3>
    <p class="text-sm text-gray-600">Serial: {{ $deviceId }}</p>
    <p class="text-sm text-gray-600">Product: {{ $product }}</p>
    <p class="text-sm text-gray-600">Device: {{ $device }}</p>
    <div class="mt-4">
        <button wire:click="selectDevice"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-2 rounded-md shadow transition duration-200">
            Select Device
        </button>
    </div>
</div>