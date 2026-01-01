@props(['heading'])
<div {{ $attributes->merge(['class' => 'relative bg-white p-4 rounded shadow']) }}>
    <h2 class="text-lg font-semibold mb-3">{{ $heading }}</h2>
    {{ $slot }}

</div>