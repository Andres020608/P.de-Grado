@props(['value', 'info' => null])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if($info)
        <x-form-info :message="$info" />
    @endif
</label>
