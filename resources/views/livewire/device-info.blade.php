<div>

    <ul class=" text-sm text-gray-700 space-y-1">
        <li><strong>Model:</strong> {{$model}}</li>
        <li><strong>Battery:</strong> {{$manufacturer}}</li>
        <li><strong>Manufacturer:</strong> {{$androidVersion}}</li>
        <li><strong>Build Number:</strong> {{$build_number}}</li>
        <li><strong>CPU:</strong> {{$cpu_abi}}</li>
        <li><strong>Battery:</strong> {{$battery}}</li>
        <li><strong>Screen Size:</strong> {{$screen_size}}</li>
    </ul>
    <div wire:loading>
        <x-loader />
    </div>
</div>
