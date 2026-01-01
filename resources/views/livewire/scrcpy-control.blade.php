<div>
    <div class="flex gap-4 flex-wrap">
        <button wire:click="startScrcpy" class="{{ $hasDevice ? '' : 'opacity-50 cursor-not-allowed' }}"
            @disabled(!$hasDevice)>Start scrcpy</button>

        <button wire:click="stopScrcpy" class="btn-danger {{ $hasDevice ? '' : 'opacity-50 cursor-not-allowed' }}"
            @disabled(!$hasDevice)>
            Stop Mirror
        </button>

        <select wire:model="selectedResolution" class="form-select">
            <option value="">Default Resolution</option>
            {{-- <option value="256">256p</option> --}}
            <option value="512">512p</option>
            <option value="720">720p</option>
            <option value="1024">1024p</option>
        </select>

        <select wire:model="selectedBitrate" class="form-select">
            <option value="">Default Bitrate</option>
            <option value="2M">2M</option>
            <option value="8M">8M</option>
            <option value="16M">16M</option>
            <option value="32M">32M</option>
        </select>
    </div>

    <div wire:loading>
        <x-loader />
    </div>
</div>